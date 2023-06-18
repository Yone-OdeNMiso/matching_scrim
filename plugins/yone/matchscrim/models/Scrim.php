<?php namespace Yone\Matchscrim\Models;

use Model;

/**
 * Model
 *
 * @property int $id
 * @property string $start_at
 * @property int $recruiting_team_id
 * @property int|null $applied_team_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $expire_in
 * @property int $is_asap
 * @method static \October\Rain\Database\Collection|static[] all($columns = ['*'])
 * @method static \October\Rain\Database\Collection|static[] get($columns = ['*'])
 * @method static \October\Rain\Database\Builder|Scrim newModelQuery()
 * @method static \October\Rain\Database\Builder|Scrim newQuery()
 * @method static \October\Rain\Database\Builder|Scrim query()
 * @method static \Illuminate\Database\Eloquent\Builder|Scrim whereAppliedTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Scrim whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Scrim whereExpireIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Scrim whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Scrim whereIsAsap($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Scrim whereRecruitingTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Scrim whereStartAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Scrim whereUpdatedAt($value)
 * @mixin \Eloquent
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
