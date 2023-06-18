<?php namespace Yone\Matchscrim\Components;

use Carbon\Carbon;
use Cms\Classes\ComponentBase;
use Yone\Matchscrim\Models\Scrim;
use Auth;

class SearchScrim extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Scrim検索',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onRun()
    {
        /*TODO チームの検索、日程の検索を実装したい*/
        if ($user = Auth::getUser()) {
            $this->page['user'] = $user;
            if ($myTeams = $user->teams) {
                $this->page['myTeams'] = $myTeams;
            }
        }

        /*一旦、Scrimすべてのリストを表示*/
        $now = Carbon::now();
        $now = Carbon::parse($now)->timezone('JST');
        $scrims = Scrim::whereNull('applied_team_id')->where('expire_in', '>=', $now)->where('start_at', '>=', $now)->get();
        $this->page['scrims'] = $scrims;
    }
}
