<?php namespace Yone\Matchscrim\Components;

use Carbon\Carbon;
use Cms\Classes\ComponentBase;
use Auth;
use Flash;
use Redirect;
use Yone\Matchscrim\Models\Scrim;

class CreateRecruit extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => '募集作成',
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
        /*自分のチームのページかどうか確認*/
        $nicename = $this->property('nicename');
        if ($user = Auth::getUser()) {
            $this->page['user'] = $user;
        }
        if ($team = $user->teams()->where('nicename', $nicename)->get()->first()) {
            $this->page['team'] = $team;
        }
    }

    public function onCreateScrim()
    {
        /*自分のチームのページかどうか確認*/
        $nicename = $this->property('nicename');
        if ($user = Auth::getUser()) {
            $this->page['user'] = $user;
        }
        if ($team = $user->teams()->where('nicename', $nicename)->get()->first()) {
            $this->page['team'] = $team;
        }

        $post = post();
        $data = [
            'start_at' => new Carbon($post['start_at_date'] . $post['start_at_time'] . 'JST'),
            'expire_in' => new Carbon($post['expire_in_date'] . $post['expire_in_time'] . 'JST')
        ];

        /*Scrimを作成*/
        $scrim = new Scrim();
        $scrim->start_at = $data['start_at'];
        $scrim->expire_in = $data['expire_in'];
        $scrim->recruiting_team_id = $team->id;
        $scrim->is_asap = empty($post['start_at_time']);
        $scrim->save();

        Flash::success('Scrim募集を作成しました');
        return Redirect::to(url('/'));
    }
}
