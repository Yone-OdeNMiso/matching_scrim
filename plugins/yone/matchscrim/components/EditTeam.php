<?php namespace Yone\Matchscrim\Components;

use Cms\Classes\ComponentBase;

class EditTeam extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'チーム編集',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [
            'nicename' => [
                'title' => 'nicename',
                'description' => '',
                'default' => '{{:nicename}}',
                'type' => 'string'
            ],
        ];
    }
}
