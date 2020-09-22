<?php

namespace Database\Factories;

use App\Models\Slider;
use Illuminate\Database\Eloquent\Factories\Factory;

class SliderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Slider::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $index = $this->faker->numberBetween(1, 100);
        return [
            'title' => 'Title ' . $index,
            'image' => 'image' . $index . '.jpg',
            'status' => random_int(0, 1)
        ];
    }
}
