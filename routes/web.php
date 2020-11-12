<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

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

if (env('APP_ENV') === 'production')
    URL::forceScheme('https');

Route::get('/', 'Admin\AuthController@loginForm')->name('loginForm');

Route::get('seed',function(){
    return Artisan::call('migrate:fresh --seed');
});

Route::get('/home', 'HomeController@index')->name('home');
