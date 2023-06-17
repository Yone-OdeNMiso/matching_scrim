<?php namespace Yone\Matchscrim\Components;

use Auth;
use Cms\Classes\ComponentBase;
use Flash;
use ValidationException;
use Validator;
use Yone\Matchscrim\Models\Team;
use Yone\Matchscrim\Models\TeamMember;

class CreateTeam extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'CreateTeam Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    /** チーム作成 */
    public function onCreateTeam()
    {
        if (!$user = Auth::getUser()) {
            throw new \ApplicationException('ログインしてください');
        }
        $data = post();
        $team = new Team();

        /*チームの要素のバリデーション*/
        $validator = Validator::make($data, $team->rules, $team->messages);
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        /*チーム作成*/
        $team->name = $data['name'];
        $team->discriminator = rand(1, 10000);
        $team->nicename = substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, 24);
        $team->save();
        $team->members()->attach($user);

        Flash::success('チームを作成しました');
        return \Redirect::to(url('/'));
    }
}
