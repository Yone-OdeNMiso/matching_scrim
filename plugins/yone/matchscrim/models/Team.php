<?php namespace Yone\Matchscrim\Models;

use Model;
use RainLab\User\Models\User;

/**
 * Model
 *
 * @property int $id
 * @property string $name
 * @property int $discriminator
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $nicename
 * @method static \October\Rain\Database\Collection|static[] all($columns = ['*'])
 * @method static \October\Rain\Database\Collection|static[] get($columns = ['*'])
 * @method static \October\Rain\Database\Builder|Team newModelQuery()
 * @method static \October\Rain\Database\Builder|Team newQuery()
 * @method static \October\Rain\Database\Builder|Team query()
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereDiscriminator($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereNicename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereUpdatedAt($value)
 * @mixin \Eloquent
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

    public $belongsToMany = [
        'members' => [
            User::class,
            'table' => 'yone_matchscrim_team_membership',
            'key' => 'team_id',
            'otherKey' => 'user_id'
        ],
    ];

    public $fillable = [
        'name'
    ];

    public $hasMany = [
        'recruitingScrims' => [
            Scrim::class,
            'key' => 'recruiting_team_id'
        ],
        'appliedScrims' => [
            Scrim::class,
            'key' => 'applied_team_id'
        ]
    ];
}
