<?php namespace Yone\Discord\Controllers;

use Carbon\Carbon;
use RainLab\User\Classes\AuthManager;
use RainLab\User\Models\User;
use Yone\Discord\Models\DiscordUser;
use Yone\Discord\Models\Settings;
use GuzzleHttp\Client;
use Auth;
use Redirect;
use Flash;
use Session;

class Callback
{
    /** Discord連携ページからのコールバック */
    public static function index()
    {
        $tokenURL = 'https://discord.com/api/oauth2/token';
        $clientId = Settings::get('clientId');
        $clientSecret = Settings::get('clientSecret');
        $publicKey = Settings::get('publicKey');

        $redirectUrl = url('/oauth2/discord/callback');
        $code = get('code');
        $callbackUrl = Session::get('discordAuthCallbackUrl');

        if (get('error')) {
            Flash::error('Discord連携に失敗しました');
            return Redirect::to(url($callbackUrl));
        }

        /*DiscordAPIへリクエストしてアクセストークン取得*/
        $client = new Client([]);
        $response = $client->request('post', $tokenURL, [
            "form_params" => [
                "grant_type" => "authorization_code",
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
                'redirect_uri' => $redirectUrl,
                'code' => $code,
                'scope' => 'identify'
            ],
            "headers" => [
                "Content-Type" => "application/x-www-form-urlencoded"
            ]
        ]);
        $tokenResponse = json_decode($response->getBody()->getContents(), true);

        $accessToken = $tokenResponse['access_token'];
        $expiresIn = $tokenResponse['expires_in'];
        $refreshToken = $tokenResponse['refresh_token'];

        /*アクセストークンを用いてDiscordAPIからユーザーの情報を取得*/
        $meUrl = 'https://discord.com/api/users/@me';
        $response = $client->request('get', $meUrl, [
            "headers" => [
                "Authorization" => 'Bearer ' . $accessToken,
                "Accept" => "application/json",
            ]
        ]);
        $meResponse = json_decode($response->getBody()->getContents(), true);

        /*DiscordUserがDBにある場合*/
        if ($discordUser = DiscordUser::find($meResponse['id'])) {
            /*Userがある場合、ログインしてDiscordUserの情報を最新化*/
            if ($user = $discordUser->user) {
                AuthManager::instance()->login($user, true);
                $discordUser->id = $meResponse['id'];
                $discordUser->access_token = $accessToken;
                $discordUser->expires_in = Carbon::now()->addSeconds($expiresIn);
                $discordUser->refresh_token = $refreshToken;
                $discordUser->username = $meResponse['username'];
                $discordUser->user_id = $user->id;
                $discordUser->discriminator = $meResponse['discriminator'];
                $discordUser->locale = $meResponse['locale'];
                $discordUser->save();

            /*Userがない場合、新しく作成*/
            } else {
                $username = substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, 24);
                /*Discordでのみログイン可なのでパスワードはランダム文字列*/
                $password = substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, 24);

                $user = Auth::register(
                    [
                        'name' => $meResponse['username'],
                        'email' => $meResponse['email'],
                        'password' => $password,
                        'password_confirmation' => $password,
                        'username' => $username,
                    ],
                    true
                );
                $discordUser->id = $meResponse['id'];
                $discordUser->access_token = $accessToken;
                $discordUser->expires_in = Carbon::now()->addSeconds($expiresIn);
                $discordUser->refresh_token = $refreshToken;
                $discordUser->username = $meResponse['username'];
                $discordUser->user_id = $user->id;
                $discordUser->discriminator = $meResponse['discriminator'];
                $discordUser->locale = $meResponse['locale'];
                $discordUser->save();
            }
        /*DiscordUserがない場合*/
        } else {
            /*メールアドレスからUserを探して、該当するUserがある場合ログインする*/
            if ($user = User::where('email', $meResponse['email'])->get()->first()) {
                AuthManager::instance()->login($user, true);
            /*Userがない場合は作成*/
            } else {
                $username = substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, 24);
                $password = substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, 24);

                $user = Auth::register(
                    [
                        'name' => $meResponse['username'],
                        'email' => $meResponse['email'],
                        'password' => $password,
                        'password_confirmation' => $password,
                        'username' => $username,
                    ],
                    true
                );
            }

            /*DiscordUserの作成*/
            $discordUser = new DiscordUser();
            $discordUser->id = $meResponse['id'];
            $discordUser->access_token = $accessToken;
            $discordUser->expires_in = Carbon::now()->addSeconds($expiresIn);
            $discordUser->refresh_token = $refreshToken;
            $discordUser->username = $meResponse['username'];
            $discordUser->user_id = $user->id;
            $discordUser->discriminator = $meResponse['discriminator'];
            $discordUser->locale = $meResponse['locale'];
            $discordUser->save();
        }

        return Redirect::to(url($callbackUrl . '?t=dc'));
    }
}
