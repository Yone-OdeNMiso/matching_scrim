<?php namespace Yone\Matchscrim;

use System\Classes\PluginBase;
use Yone\Matchscrim\Components\BookScrim;
use Yone\Matchscrim\Components\CreateRecruit;
use Yone\Matchscrim\Components\CreateTeam;
use Yone\Matchscrim\Components\EditTeam;
use Yone\Matchscrim\Components\Home;
use Yone\Matchscrim\Components\ScrimList;
use Yone\Matchscrim\Components\SearchScrim;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            Home::class => 'matchScrimHome',
            CreateTeam::class => 'createTeam',
            EditTeam::class => 'editTeam',
            CreateRecruit::class => 'createRecruit',
            ScrimList::class => 'scrimList',
            SearchScrim::class => 'searchScrim',
            BookScrim::class => 'bookScrim',
        ];
    }

    public function registerSettings()
    {
    }
}
