<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
 */
// theme configuration can be use app.themes.default for default while app.themes.admin for admin
Route::get('/', function (Request $request) {
    return redirect()->route('login');
});

Route::get('/account/activate/{token}', 'AccountController@activate');

Auth::routes();

Route::group(
    [
        'middleware' => [
            'active',
            'auth',
        ],
    ], function () {
        Route::group(['prefix' => 'api'], function () {
            \App\Routes\API\Scrapper::routes();
        });
        Route::get('dashboard', 'HomeController@index');
        \App\Routes\Article::routes();
        \App\Routes\Dictionary::routes();

        // Administrator, Trainer and Facilitator only
        Route::group(['middleware' => ['role:administrator']], function () {
            Route::resource('users', 'UsersController');
        });
    });

// Handle Socialite Redirection & Callback
Route::get('auth/facebook', 'Auth\AuthController@redirectToProvider');
Route::get('auth/facebook/callback', 'Auth\AuthController@handleProviderCallback');
