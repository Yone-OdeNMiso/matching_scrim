<?php

Route::group(['middleware' => ['web']], function () {
    Route::get('/oauth2/discord/callback', function (\Illuminate\Http\Request $request) {
        return \Yone\Discord\Controllers\Callback::index();
    });
});
