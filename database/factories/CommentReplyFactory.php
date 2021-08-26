<?php

namespace Database\Factories;

use App\Models\CommentReply;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentReplyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CommentReply::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'comment_id' => $this->faker->numberBetween(1, 10),
            'is_active' => $this->faker->numberBetween(0, 1),
            'author' => $this->faker->randomElement(['Salim Hasan', 'Shihab Ahamed', 'Shoukhin Khan']),
            'photo'  => $this->faker->imageUrl(400, 200, 'cats'),
            'email'  => $this->faker->randomElement(['salim@gmail.com', 'shihab@gmail.com', 'shoukhin@gmail.com']),
            'body'   => $this->faker->paragraph(20, 25)
        ];
    }
}
