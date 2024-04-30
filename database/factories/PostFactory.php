<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),  //all()->random->id to get form existing data
            'title' => fake()->sentence,
            'content' => fake()->paragraph,
            'published_at' => fake()->dateTimeBetween('-3 year', 'now'),
            'user_id' => User::factory()->create()->id,
        ];
    }
}
