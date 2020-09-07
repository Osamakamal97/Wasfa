<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Like;
use App\Models\Recipe;
use App\User;
use Faker\Generator as Faker;

$factory->define(Like::class, function (Faker $faker) {
    return [
        'recipe_id' => $faker->numberBetween(1, Recipe::count()),
        'user_id' => $faker->numberBetween(1, User::count())
    ];
});
