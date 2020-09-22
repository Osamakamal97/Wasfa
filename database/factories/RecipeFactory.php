<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Recipe;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecipeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Recipe::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $index = $this->faker->numberBetween(1, 1000);
        return [
            'title' => 'Recipe Title' . $index,
            'content' => 'Content fo recipe' . $index . ': ' . $this->faker->text(150),
            'image' => 'recipe' . $index . '.jpg',
            'components' => 'components',
            'category_id' => $this->faker->numberBetween(1, Category::count()),
        ];
    }
}
