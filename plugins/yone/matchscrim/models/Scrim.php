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
}
