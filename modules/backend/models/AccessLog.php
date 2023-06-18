<?php namespace Backend\Models;

use Model;
use Request;

/**
 * Model for logging access to the back-end
 *
 * @package october\backend
 * @author Alexey Bobkov, Samuel Georges
 * @property int $id
 * @property int $user_id
 * @property string|null $ip_address
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \October\Rain\Database\Collection|static[] all($columns = ['*'])
 * @method static \October\Rain\Database\Collection|static[] get($columns = ['*'])
 * @method static \October\Rain\Database\Builder|AccessLog newModelQuery()
 * @method static \October\Rain\Database\Builder|AccessLog newQuery()
 * @method static \October\Rain\Database\Builder|AccessLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccessLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccessLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccessLog whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccessLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccessLog whereUserId($value)
 * @mixin \Eloquent
 */
class AccessLog extends Model
{
    /**
     * @var string The database table used by the model.
     */
    protected $table = 'backend_access_log';

    /**
     * @var array Relations
     */
    public $belongsTo = [
        'user' => User::class
    ];

    /**
     * Creates a log record
     * @param Backend\Models\User $user Admin user
     * @return self
     */
    public static function add($user)
    {
        $record = new static;
        $record->user = $user;
        $record->ip_address = Request::getClientIp();
        $record->save();

        return $record;
    }

    /**
     * Returns a recent entry, latest entry is not considered recent
     * if the creation day is the same as today.
     * @return self
     */
    public static function getRecent($user)
    {
        $records = static::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->limit(2)
            ->get();

        if (!count($records)) {
            return null;
        }

        $first = $records->first();

        return !$first->created_at->isToday() ? $first : $records->pop();
    }
}
