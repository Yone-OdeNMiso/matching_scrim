<?php namespace Yone\Discord\Models;

use Model;

/**
 * Cg\Discord\Models\Settings
 *
 * @property int $id
 * @property string|null $item
 * @property string|null $value
 * @method static \October\Rain\Database\Collection|static[] all($columns = ['*'])
 * @method static \October\Rain\Database\Collection|static[] get($columns = ['*'])
 * @method static \October\Rain\Database\Builder|Settings newModelQuery()
 * @method static \October\Rain\Database\Builder|Settings newQuery()
 * @method static \October\Rain\Database\Builder|Settings query()
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereItem($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereValue($value)
 * @mixin \Eloquent
 */
class Settings extends Model
{

    public $implement = ['System.Behaviors.SettingsModel'];

    public $settingsCode = 'cg_discord_settings';
    public $settingsFields = 'fields.yaml';

}
