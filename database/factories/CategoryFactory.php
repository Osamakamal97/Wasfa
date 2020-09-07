<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
// use Faker\Generator;

$factory->define(Category::class, function (Faker\Generator $faker) {
    return [
        'name' => 'Category' . $faker->numberBetween(1, 100)
    ];
});
