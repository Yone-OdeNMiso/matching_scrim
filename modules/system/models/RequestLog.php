<?php namespace System\Models;

use App;
use Model;
use Request;

/**
 * Model for logging 404 errors
 *
 * @package october\system
 * @author Alexey Bobkov, Samuel Georges
 * @property int $id
 * @property int|null $status_code
 * @property string|null $url
 * @property string|null $referer
 * @property int $count
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \October\Rain\Database\Collection|static[] all($columns = ['*'])
 * @method static \October\Rain\Database\Collection|static[] get($columns = ['*'])
 * @method static \October\Rain\Database\Builder|RequestLog newModelQuery()
 * @method static \October\Rain\Database\Builder|RequestLog newQuery()
 * @method static \October\Rain\Database\Builder|RequestLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|RequestLog whereCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestLog whereReferer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestLog whereStatusCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestLog whereUrl($value)
 * @mixin \Eloquent
 */
class RequestLog extends Model
{
    /**
     * @var string The database table used by the model.
     */
    protected $table = 'system_request_logs';

    /**
     * @var array The attributes that aren't mass assignable.
     */
    protected $guarded = [];

    /**
     * @var array List of attribute names which are json encoded and decoded from the database.
     */
    protected $jsonable = ['referer'];

    /**
     * Creates a log record
     * @return self
     */
    public static function add($statusCode = 404)
    {
        if (!App::hasDatabase()) {
            return;
        }

        if (!LogSetting::get('log_requests')) {
            return;
        }

        $record = static::firstOrNew([
            'url' => substr(Request::fullUrl(), 0, 191),
            'status_code' => $statusCode,
        ]);

        if ($referer = Request::header('referer')) {
            $referers = (array) $record->referer ?: [];
            $referers[] = $referer;
            $record->referer = $referers;
        }

        if (!$record->exists) {
            $record->count = 1;
            $record->save();
        }
        else {
            $record->increment('count');
        }

        return $record;
    }
}
