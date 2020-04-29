<?php

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

if (App::environment() === 'testing') {
    Route::get('__testing__/create/{model}', function ($model) {
        return factory("App\\{$model}")->create(request()->all());
    });

    Route::get('__testing__/login', function () {
        $user = factory("App\User")->create(request()->all());
        auth()->login($user);
        return $user;
    });
}

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/tweets', 'TweetsController@index')->name('home');
    Route::post('/tweets', 'TweetsController@store')->name('tweets');
    Route::post('/profiles/{user:username}/follow', 'FollowsController@store');
    Route::get('/profiles/{user:username}/edit', 'ProfileController@edit')->middleware('can:edit,user');
    Route::patch('/profiles/{user:username}', 'ProfileController@update');
});

Route::get('/profiles/{user:username}', 'ProfileController@show')->name('profile');

Auth::routes();
