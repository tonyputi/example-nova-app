<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fn (array $attributes) => User::factory()->create()->id,
            'type' => $this->faker->randomElement(['article', 'tutorial', 'news', 'review']),
            'title' => $this->faker->sentence(),
            'excerpt' => $this->faker->text(100),
            'content' => $this->faker->text(300),
        ];
    }
}
