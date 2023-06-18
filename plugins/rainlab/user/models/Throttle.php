<?php namespace RainLab\User\Models;

use October\Rain\Auth\Models\Throttle as ThrottleBase;

/**
 * RainLab\User\Models\Throttle
 *
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
 * @method static \October\Rain\Database\Builder|Throttle newModelQuery()
 * @method static \October\Rain\Database\Builder|Throttle newQuery()
 * @method static \October\Rain\Database\Builder|Throttle query()
 * @method static \Illuminate\Database\Eloquent\Builder|Throttle whereAttempts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Throttle whereBannedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Throttle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Throttle whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Throttle whereIsBanned($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Throttle whereIsSuspended($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Throttle whereLastAttemptAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Throttle whereSuspendedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Throttle whereUserId($value)
 * @mixin \Eloquent
 */
class Throttle extends ThrottleBase
{
    /**
     * @var string The database table used by the model.
     */
    protected $table = 'user_throttle';

    /**
     * @var array Relations
     */
    public $belongsTo = [
        'user' => User::class
    ];
}
