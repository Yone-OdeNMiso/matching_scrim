<?php namespace Yone\Matchscrim\Components;

use Cms\Classes\ComponentBase;
use Flash;
use Illuminate\Support\Facades\App;
use Redirect;
use Yone\Matchscrim\Models\Team;
use Auth;

class EditTeam extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'チーム編集',
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
        } else {
            App::abort(404);
        }
    }

    public function onUpdateTeam()
    {
        /*自分のチームのページかどうか確認*/
        $nicename = $this->property('nicename');
        if ($user = Auth::getUser()) {
            $this->page['user'] = $user;
        }
        if ($team = $user->teams()->where('nicename', $nicename)->get()->first()) {
            $this->page['team'] = $team;
        } else {
            throw new \ApplicationException('正しいチームではありません');
        }
        $data = post();

        $team->name = $data['name'];
        $team->save();

        Flash::success('チームを更新しました');
        return Redirect::to(url('/'));
    }
}
