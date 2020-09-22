<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('test','Admin\MainController@test');
Route::get('test2','Admin\MainController@test2');

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Route::get('login', 'AuthController@loginForm')->name('loginForm');
// Route::get('register', 'AuthController@registrationForm')->name('registrationForm');
// Route::post('admin/login', 'AuthController@login')->name('login');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::get('livewire','HomeController@livewire');
