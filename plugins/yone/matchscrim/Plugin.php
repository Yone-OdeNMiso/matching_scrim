<?php namespace Yone\Matchscrim;

use System\Classes\PluginBase;
use Yone\Matchscrim\Components\CreateTeam;
use Yone\Matchscrim\Components\Home;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            Home::class => 'matchScrimHome',
            CreateTeam::class => 'createTeam'
        ];
    }

    public function registerSettings()
    {
    }
}
