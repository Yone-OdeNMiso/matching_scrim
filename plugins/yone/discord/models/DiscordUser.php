<?php namespace Yone\Discord\Models;

use Model;
use RainLab\User\Models\User;

/**
 * Model
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
