<?php

use App\Hail\Guzzle;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('test', function () {
    $userId = Auth::user()->getHailProvider()->provider_user_id;
    dd(Guzzle::get('users/' . $userId . '/organisations'));
});

Route::get('/', 'HomeController')->name('home');

Route::get('login', 'Auth\SocialiteController@redirectToProvider')->name('login');
Route::get('login/callback', 'Auth\SocialiteController@handleCallback');