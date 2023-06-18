<?php namespace System\Models;

use App;
use Str;
use Model;
use Exception;

/**
 * Model for logging system errors and debug trace messages
 *
 * @package october\system
 * @author Alexey Bobkov, Samuel Georges
 * @property int $id
 * @property string $level
 * @property string|null $message
 * @property string|null $details
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $summary
 * @method static \October\Rain\Database\Collection|static[] all($columns = ['*'])
 * @method static \October\Rain\Database\Collection|static[] get($columns = ['*'])
 * @method static \October\Rain\Database\Builder|EventLog newModelQuery()
 * @method static \October\Rain\Database\Builder|EventLog newQuery()
 * @method static \October\Rain\Database\Builder|EventLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|EventLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventLog whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventLog whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventLog whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventLog whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class EventLog extends Model
{
    /**
     * @var string The database table used by the model.
     */
    protected $table = 'system_event_logs';

    /**
     * @var array List of attribute names which are json encoded and decoded from the database.
     */
    protected $jsonable = ['details'];

    /**
     * Returns true if this logger should be used.
     * @return bool
     */
    public static function useLogging()
    {
        return (
            class_exists('Model') &&
            Model::getConnectionResolver() &&
            App::hasDatabase() &&
            !defined('OCTOBER_NO_EVENT_LOGGING') &&
            LogSetting::get('log_events')
        );
    }

    /**
     * Creates a log record
     * @param string $message Specifies the message text
     * @param string $level Specifies the logging level
     * @param string $details Specifies the error details string
     * @return self
     */
    public static function add($message, $level = 'info', $details = null)
    {
        $record = new static;
        $record->message = $message;
        $record->level = $level;

        if ($details !== null) {
            $record->details = (array) $details;
        }

        try {
            $record->save();
        }
        catch (Exception $ex) {
        }

        return $record;
    }

    /**
     * Beautify level value.
     * @param  string $level
     * @return string
     */
    public function getLevelAttribute($level)
    {
        return ucfirst($level);
    }

    /**
     * Creates a shorter version of the message attribute,
     * extracts the exception message or limits by 100 characters.
     * @return string
     */
    public function getSummaryAttribute()
    {
        if (preg_match("/with message '(.+)' in/", $this->message, $match)) {
            return $match[1];
        }

        // Get first line of message
        preg_match('/^([^\n\r]+)/m', $this->message, $matches);

        return Str::limit($matches[1] ?? '', 500);
    }
}
