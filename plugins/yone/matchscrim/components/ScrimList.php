<?php namespace Yone\Matchscrim\Components;

use Carbon\Carbon;
use Cms\Classes\ComponentBase;
use Auth;
use Illuminate\Support\Facades\App;
use Yone\Matchscrim\Models\Scrim;
use Yone\Matchscrim\Models\Team;

class ScrimList extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Scrim一覧',
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

    public function onRun()
    {
        $nicename = $this->property('nicename');
        if ($user = Auth::getUser()) {
            $this->page['user'] = $user;
        }
        if ($team = Team::where('nicename', $nicename)->get()->first()) {
            $this->page['team'] = $team;
        } else {
            App::abort(404);
        }
        $now = Carbon::now();
        $now = Carbon::parse($now)->timezone('JST');
        $recruitingScrims = $team->recruitingScrims()->whereNull('applied_team_id')->where('expire_in', '>=', $now)->where('start_at', '>=', $now)->get();
        $this->page['recruitingScrims'] = $recruitingScrims;

        $bookedScrims = $team->recruitingScrims()->whereNotNull('applied_team_id')->where('start_at', '>=', $now)->get();
        $this->page['bookedScrims'] = $bookedScrims;

    }
}
