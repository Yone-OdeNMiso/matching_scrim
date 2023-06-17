<?php namespace Yone\Matchscrim\Models;

use Model;

/**
 * Model
 */
class Scrim extends Model
{
    use \October\Rain\Database\Traits\Validation;


    /**
     * @var string The database table used by the model.
     */
    public $table = 'yone_matchscrim_scrims';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    public $belongsTo = [
        'recruitingTeam' => [Team::class, 'key' => 'recruiting_team_id'],
        'appliedTeam' => [Team::class, 'key' => 'applied_team_id']
    ];
}
