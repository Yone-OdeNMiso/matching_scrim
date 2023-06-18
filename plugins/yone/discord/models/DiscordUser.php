<?php namespace Yone\Discord\Models;

use Model;
use RainLab\User\Models\User;

/**
 * Model
 *
 * @property int $id
 * @property int $user_id
 * @property string $username
 * @property string|null $discriminator
 * @property string|null $locale
 * @property string|null $access_token
 * @property string|null $refresh_token
 * @property string|null $expires_in
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \October\Rain\Database\Collection|static[] all($columns = ['*'])
 * @method static \October\Rain\Database\Collection|static[] get($columns = ['*'])
 * @method static \October\Rain\Database\Builder|DiscordUser newModelQuery()
 * @method static \October\Rain\Database\Builder|DiscordUser newQuery()
 * @method static \October\Rain\Database\Builder|DiscordUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|DiscordUser whereAccessToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiscordUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiscordUser whereDiscriminator($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiscordUser whereExpiresIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiscordUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiscordUser whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiscordUser whereRefreshToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiscordUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiscordUser whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiscordUser whereUsername($value)
 * @mixin \Eloquent
 */
class DiscordUser extends Model
{
    use \October\Rain\Database\Traits\Validation;


    /**
     * @var string The database table used by the model.
     */
    public $table = 'yone_discord_users';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    public $belongsTo = [
        'user' => [User::Class, 'key' => 'user_id']
    ];
}
