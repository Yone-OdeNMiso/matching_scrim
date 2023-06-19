<?php namespace Yone\Matchscrim\Components;

use Cms\Classes\ComponentBase;
use Flash;
use Illuminate\Support\Facades\App;
use Redirect;
use Yone\Matchscrim\Models\Team;
use Auth;
use ValidationException;
use Validator;

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

    /*チーム情報要素の更新(現状チーム名のみ)*/
    public function onUpdateTeam()
    {
        /*自分のチームのページかどうか確認*/
        $nicename = $this->property('nicename');
        if ($user = Auth::getUser()) {
            $this->page['user'] = $user;
        }
        /** @var Team $team */
        if ($team = $user->teams()->where('nicename', $nicename)->get()->first()) {
            $this->page['team'] = $team;
        } else {
            throw new \ApplicationException('正しいチームではありません');
        }
        $data = post();

        /*チーム要素のバリデーション*/
        $validator = Validator::make($data, $team->rules, $team->messages);
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $team->fill($data);
        $team->save();

        Flash::success('チームを更新しました');
        return Redirect::to(url('/'));
    }
}
