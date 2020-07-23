<?php

namespace App\Http\Controllers;

use App\Hail\Guzzle;
use Illuminate\Support\Facades\Auth;

class HomeController
{   
    /**
     * Single action controller using __invoke.
     * 
     * @return Illuminate\Http\Response
     */
    public function __invoke()
    {
        if (!Auth::check()) {
            return view('home');
        }

        $provider = Auth::user()->getHailProvider();

        $organisations = Guzzle::get("users/{$provider->provider_user_id}/organisations");
        $organisation = collect($organisations)->last();

        $filters = http_build_query([
            'limit' => 10,
            'order' => 'created_date|desc'
        ]);

        $images = Guzzle::get("organisations/{$organisation->id}/images?{$filters}");
        $images = collect($images);

        return view('home', compact('organisation', 'images'));
    }
}