<?php

namespace Database\Factories;

use App\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = News::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $index = $this->faker->numberBetween(1, 50);
        return [
            'title' => 'This is title for ' . $index . ' news.',
            'content' => 'This is content for news ' . $index . ': ' . $this->faker->text(150)
        ];
    }
}
