<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

if (env('APP_ENV') === 'production')
    URL::forceScheme('https');

// define('INDEX_IMAGE_WIDTH', '200px');
// define('INDEX_IMAGE_HEIGH', '100px');

Route::get('login', 'AuthController@loginForm')->name('loginForm');
Route::post('login/check', 'AuthController@login')->name('admin.login');
Route::get('logout', 'AuthController@logout')->name('admin.logout');
Route::group(['middleware' => ['checkIfAdmin']], function () {
    Route::get('dashboard', 'MainController@index')->name('admin.dashboard');
    Route::resources([
        'category' => 'CategoryController',
        'recipe' => 'RecipeController',
        'user' => 'UserController',
        'news' => 'NewsController',
        'slider' => 'SliderController',
    ]);
    Route::get('settings', 'MainController@settings')->name('settings.index');
});
