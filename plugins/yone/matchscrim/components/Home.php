<?php namespace Yone\Matchscrim\Components;

use Auth;
use Cms\Classes\ComponentBase;

class Home extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'TOP',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [

        ];
    }

    public function onRun()
    {
        if ($user = Auth::getUser()) {
            $this->page['user'] = $user;
            if ($user->teams) {
                $this->page['teams'] = $user->teams;
            }
        }
    }
}
