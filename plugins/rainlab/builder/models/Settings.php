<?php namespace RainLab\Builder\Models;

use October\Rain\Database\Model;

/**
 * Builder settings model
 *
 * @package rainlab\builder
 * @author Alexey Bobkov, Samuel Georges
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
    use \October\Rain\Database\Traits\Validation;

    public $implement = ['System.Behaviors.SettingsModel'];

    public $settingsCode = 'rainlab_builder_settings';

    public $settingsFields = 'fields.yaml';

    /**
     * Validation rules
     */
    public $rules = [
        'author_name' => 'required',
        'author_namespace' => ['required', 'regex:/^[a-z]+[a-z0-9]+$/i', 'reserved']
    ];
}
