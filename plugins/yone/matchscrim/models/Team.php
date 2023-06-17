<?php namespace Yone\Matchscrim\Models;

use Model;
use RainLab\User\Models\User;

/**
 * Model
 */
class Team extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;


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
        ]
    ];
}
