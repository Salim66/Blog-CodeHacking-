<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1,  10),
            'category_id' => $this->faker->numberBetween(1, 10),
            'photo_id'  => $this->faker->numberBetween(1, 10),
            'title' => $this->faker->sentence(10, 15),
            'body' => $this->faker->paragraph(20, 15)
        ];
    }
}
