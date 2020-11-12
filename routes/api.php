<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['middleware' => ['api', 'checkPassword', 'checkLanguage'], 'namespace' => 'API'], function () {
    // Authentication
    Route::post('login', 'AuthController@login');
    Route::post('registration', 'AuthController@registration');
    // Main screen
    Route::get('get-main-screen-data', 'MainController@getMainScreenData');
    // Categories
    Route::get('get-all-categories', 'CategoryController@getAll');
    Route::get('get-recipes-by-category-id', 'CategoryController@getRecipesByCategoryId');
    // Recipes
    Route::get('get-recipe-by-id', 'RecipeController@getRecipeById'); // show
    Route::get('get-recipe-comments', 'RecipeController@getRecipeComments');
    Route::post('add-new-recipe', 'RecipeController@addNewRecipe'); //store
    Route::post('search-recipe', 'RecipeController@search');

    Route::group(['middleware' => 'checkUserToken'], function () {
        // Favorite
        Route::get('get-favorites-for-user', 'RecipeController@getFavoritesForUser');
        Route::post('add-to-favorite', 'RecipeController@addToFavorite');
        Route::post('remove-from-favorite', 'RecipeController@removeFromFavorite');
        // Like/Dislike
        Route::post('like-recipe', 'RecipeController@like');
        Route::post('dislike-recipe', 'RecipeController@dislike');
    });
    // News
    Route::get('get-news-details', 'NewsController@getNewsDetails');
});
