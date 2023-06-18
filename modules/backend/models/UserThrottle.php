<?php namespace Backend\Models;

use Config;
use October\Rain\Auth\Models\Throttle as ThrottleBase;

/**
 * Administrator throttling model
 *
 * @package october\backend
 * @author Alexey Bobkov, Samuel Georges
 * @property int $id
 * @property int|null $user_id
 * @property string|null $ip_address
 * @property int $attempts
 * @property \Illuminate\Support\Carbon|null $last_attempt_at
 * @property bool $is_suspended
 * @property \Illuminate\Support\Carbon|null $suspended_at
 * @property bool $is_banned
 * @property \Illuminate\Support\Carbon|null $banned_at
 * @method static \October\Rain\Database\Collection|static[] all($columns = ['*'])
 * @method static \October\Rain\Database\Collection|static[] get($columns = ['*'])
 * @method static \October\Rain\Database\Builder|UserThrottle newModelQuery()
 * @method static \October\Rain\Database\Builder|UserThrottle newQuery()
 * @method static \October\Rain\Database\Builder|UserThrottle query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserThrottle whereAttempts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserThrottle whereBannedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserThrottle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserThrottle whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserThrottle whereIsBanned($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserThrottle whereIsSuspended($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserThrottle whereLastAttemptAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserThrottle whereSuspendedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserThrottle whereUserId($value)
 * @mixin \Eloquent
 */
class UserThrottle extends ThrottleBase
{
    /**
     * @var string The database table used by the model.
     */
    protected $table = 'backend_user_throttle';

    /**
     * @var array Relations
     */
    public $belongsTo = [
        'user' => User::class
    ];

    public function __construct()
    {
        parent::__construct();

        static::$attemptLimit = Config::get('auth.throttle.attemptLimit', 5);
        static::$suspensionTime = Config::get('auth.throttle.suspensionTime', 15);
    }
}
