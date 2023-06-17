<?php namespace Yone\Discord\Components;

use Yone\Discord\Models\Settings;
use Cms\Classes\ComponentBase;
use Auth;
use Session;
use RainLab\User\Models\User;

class OAuth extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Discord連携',
            'description' => /*User management form.*/
                ''
        ];
    }

    public function defineProperties()
    {
        return [
        ];
    }


    public function onRender()
    {
    }

    public function onRun()
    {
        $user = Auth::getUser();
        if ($user) {
            $this->page['user'] = $user;
        }
    }

    /** Discord連携ページへのリダイレクト */
    public function onStartDiscordAuth()
    {
        $clientId = Settings::get('clientId');
        $clientSecret = Settings::get('clientSecret');
        $publicKey = Settings::get('publicKey');

        $redirectUrl = urlencode(url('/oauth2/discord/callback'));

        Session::put('discordAuthCallbackUrl', url()->current());
        $url = 'https://discord.com/api/oauth2/authorize?client_id=' . $clientId . '&redirect_uri=' . $redirectUrl . '&response_type=code&scope=email%20identify';
        return \Redirect::to($url);
    }

    public function onDestoryDiscordAuth()
    {
        $user = Auth::getUser();
        $user->discord()->delete();
        \Flash::success('Discord連携を解除しました');
        return \Redirect::refresh();
    }
}
