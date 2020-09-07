<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use App\Models\Recipe;
use Faker\Generator as Faker;

$factory->define(Recipe::class, function (Faker $faker) {
    $index = $faker->numberBetween(1, 1000);
    return [
        'title' => 'Recipe Title' . $index,
        'content' => 'Content fo recipe' . $index . ': ' . $faker->text(150),
        'image' => 'recipe' . $index . '.jpg',
        'components' => 'components',
        'category_id' => $faker->numberBetween(1, Category::count()),
        // 'likes' => $faker->numberBetween(1, 1000)
    ];
});
