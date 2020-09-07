<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\News;
use Faker\Generator as Faker;

$factory->define(News::class, function (Faker $faker) {
    $index = $faker->numberBetween(1, 50);
    return [
        'title' => 'This is title for ' . $index . ' news.',
        'content' => 'This is content for news ' . $index . ': ' . $faker->text(150)
    ];
});
