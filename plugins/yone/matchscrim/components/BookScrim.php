<?php namespace Yone\Matchscrim\Components;

use ApplicationException;
use Cms\Classes\ComponentBase;
use Composer\Console\Application;
use Flash;
use Redirect;
use Yone\Matchscrim\Models\Scrim;
use Yone\Matchscrim\Models\Team;
use Auth;

class BookScrim extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Scrimを予約する',
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

    public function onBookScrim()
    {
        if (!$user = Auth::getUser()) {
            throw new ApplicationException('ログインしてください');
        }
        $scrim = Scrim::find(post('scrim_id'));
        if (!$scrim) {
            throw new ApplicationException('正しいScrimが見つかりませんでした');
        }
        $myTeam = $user->teams()->find(post('my_team_id'));
        if (!$myTeam) {
            throw new ApplicationException('正しいチームが見つかりませんでした');
        }

        /*TODO 後々即予約ではなくDiscord使って相手に通知、相手が許可して初めて予約成立みたいなフローを組み込みたい*/
        $scrim->applied_team_id = $myTeam->id;
        $scrim->save();

        /*同じ時間に募集していた場合削除*/
        /*TODO 試合時間が微妙にズレていた場合消えない。Scrimにかかる時間を考慮して幅をもたせる？*/
        /*TODO 決まり次第の募集*/
        if ($myScrim = $myTeam->recruitingScrims()->where('start_at', $scrim->start_at)->get()->first()) {
            $myScrim->delete();
        }

        Flash::success('予約に成功しました');
        return Redirect::refresh();
    }

    public function onDeleteScrim()
    {
        $nicename = $this->property('nicename');
        if (!$user = Auth::getUser()) {
            throw new ApplicationException('ログインしてください');
        }
        $scrim = Scrim::find(post('scrim_id'));
        if (!$scrim) {
            throw new ApplicationException('正しいScrimが見つかりませんでした');
        }
        $team = Team::where('nicename', $nicename)->get()->first();
        $myTeam = $user->teams()->find($team->id);
        if (!$myTeam) {
            throw new ApplicationException('正しいチームが見つかりませんでした');
        }

        /*自チームが募集していた場合、Scrimを削除*/
        /*TODO 同じ時間に相手が募集していて相手から応募があった場合、削除すると相手の募集も消えてしまう。*/
        if ($scrim->recruiting_team_id === $myTeam->id) {
            $scrim->delete();

        /*別チームへ応募した場合、Scrimはそのままに募集している状態に戻す*/
        } elseif ($scrim->applied_team_id === $myTeam->id) {
            $scrim->applied_team_id = null;
            $scrim->save();
        } else {
            throw new ApplicationException('正しいScrimが見つかりませんでした');
        }

        Flash::success('削除に成功しました');
        return Redirect::refresh();
    }
}
