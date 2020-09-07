<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Favorite;
use App\Models\Recipe;
use App\User;
use Faker\Generator as Faker;

$factory->define(Favorite::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, User::count()),
        'recipe_id' => $faker->numberBetween(1, Recipe::count())
    ];
});
