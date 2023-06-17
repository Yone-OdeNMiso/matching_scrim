<?php namespace Yone\Matchscrim\Models;

use Model;
use RainLab\User\Models\User;

/**
 * Model
 */
class Team extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'yone_matchscrim_team_teams';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'name' => 'required'
    ];
    public $messages = [
        'name.required' => '名前は必須です。'
    ];

    public $belongsToMany =[
        'members' => [
            User::class,
            'table' => 'yone_matchscrim_team_membership',
            'key' => 'team_id',
            'otherKey' => 'user_id'
        ],
    ];

    public $hasMany = [
        'recruitingScrims' =>[
            Scrim::class,
            'key' => 'recruiting_team_id'
        ]
    ];
}
