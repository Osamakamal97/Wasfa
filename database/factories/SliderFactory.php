<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Slider;
use Faker\Generator as Faker;

$factory->define(Slider::class, function (Faker $faker) {
    $index = $faker->numberBetween(1, 100);
    return [
        'title' => 'Title ' . $index,
        'image' => 'image' . $index . '.jpg',
        'status' => random_int(0, 1)
    ];
});
