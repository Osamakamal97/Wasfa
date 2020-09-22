<?php

namespace Database\Factories;

use App\Models\Favorite;
use App\Models\Recipe;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FavoriteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Favorite::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, User::count()),
            'recipe_id' => $this->faker->numberBetween(1, Recipe::count())
        ];
    }
}
