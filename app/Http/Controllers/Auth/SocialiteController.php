<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController
{
    /**
     * Redirect to the oAuth provider for authorization.
     * 
     * @return void
     */
    public function redirectToProvider()
    {
        return Socialite::with('hail')->redirect();
    }

    /**
     * Handle the authorization callback.
     * 
     * @return void
     */
    public function handleCallback()
    {
        $oAuthUser = Socialite::driver('hail')->user();

        // Rough: find or create a new local user
        $user = User::updateOrCreate([
            'email' => $oAuthUser->email,
        ], [
            'first_name' => $oAuthUser->first_name,
            'last_name' => $oAuthUser->last_name,
            'avatar_url' => $oAuthUser->avatar_url,
        ]);

        // Rough: update the user's oauth providers
        $provider = $user->providers()->firstOrNew([
            'provider_user_id' => $oAuthUser->user['id'],
            'name' => 'hail',
        ]);

        $provider->access_token = $oAuthUser->token;
        $provider->refresh_token = $oAuthUser->refreshToken;

        $provider->save();
        
        // log the user in
        Auth::login($user);

        return redirect('/');
    }
}