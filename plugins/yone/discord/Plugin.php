<?php namespace Yone\Discord;

use Yone\Discord\Components\OAuth;
use Yone\Discord\Models\Settings;
use System\Classes\PluginBase;
use System\Classes\SettingsManager;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            OAuth::class => 'discordOAuth'
        ];
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label' => 'Discordプラグイン設定',
                'description' => 'desc',
                'category' => SettingsManager::CATEGORY_SOCIAL,
                'icon' => 'icon-cog',
                'class' => Settings::class,
                'order' => 500,
            ]
        ];
    }
}
