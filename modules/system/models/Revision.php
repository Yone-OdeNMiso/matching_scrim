<?php namespace System\Models;

use October\Rain\Database\Models\Revision as RevisionBase;

/**
 * Revision history model
 *
 * @package october\system
 * @author Alexey Bobkov, Samuel Georges
 * @property int $id
 * @property int|null $user_id
 * @property string|null $field
 * @property string|null $cast
 * @property mixed $old_value
 * @property mixed $new_value
 * @property string $revisionable_type
 * @property int $revisionable_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \October\Rain\Database\Collection|static[] all($columns = ['*'])
 * @method static \October\Rain\Database\Collection|static[] get($columns = ['*'])
 * @method static \October\Rain\Database\Builder|Revision newModelQuery()
 * @method static \October\Rain\Database\Builder|Revision newQuery()
 * @method static \October\Rain\Database\Builder|Revision query()
 * @method static \Illuminate\Database\Eloquent\Builder|Revision whereCast($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Revision whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Revision whereField($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Revision whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Revision whereNewValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Revision whereOldValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Revision whereRevisionableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Revision whereRevisionableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Revision whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Revision whereUserId($value)
 * @mixin \Eloquent
 */
class Revision extends RevisionBase
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'system_revisions';
}
