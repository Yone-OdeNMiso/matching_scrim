<?php namespace System\Models;

use Model;

/**
 * System log settings
 *
 * @package october\system
 * @author Alexey Bobkov, Samuel Georges
 * @property int $id
 * @property string|null $item
 * @property string|null $value
 * @method static \October\Rain\Database\Collection|static[] all($columns = ['*'])
 * @method static \October\Rain\Database\Collection|static[] get($columns = ['*'])
 * @method static \October\Rain\Database\Builder|LogSetting newModelQuery()
 * @method static \October\Rain\Database\Builder|LogSetting newQuery()
 * @method static \October\Rain\Database\Builder|LogSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder|LogSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogSetting whereItem($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogSetting whereValue($value)
 * @mixin \Eloquent
 */
class LogSetting extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var array Behaviors implemented by this model.
     */
    public $implement = [
        \System\Behaviors\SettingsModel::class
    ];

    /**
     * @var string Unique code
     */
    public $settingsCode = 'system_log_settings';

    /**
     * @var mixed Settings form field defitions
     */
    public $settingsFields = 'fields.yaml';

    /**
     * Validation rules
     */
    public $rules = [];

    public static function filterSettingItems($manager)
    {
        if (!self::isConfigured()) {
            $manager->removeSettingItem('October.System', 'request_logs');
            $manager->removeSettingItem('October.Cms', 'theme_logs');
            return;
        }

        if (!self::get('log_events')) {
            $manager->removeSettingItem('October.System', 'event_logs');
        }

        if (!self::get('log_requests')) {
            $manager->removeSettingItem('October.System', 'request_logs');
        }

        if (!self::get('log_theme')) {
            $manager->removeSettingItem('October.Cms', 'theme_logs');
        }
    }

    /**
     * Initialize the seed data for this model. This only executes when the
     * model is first created or reset to default.
     * @return void
     */
    public function initSettingsData()
    {
        $this->log_events = true;
        $this->log_requests = false;
        $this->log_theme = false;
    }
}
