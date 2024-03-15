<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),       // this generate users by factory. it can be use                       
            'post_id' => Post::factory(),         //all()->random->id to get form existing data
            'content' => fake()->paragraph(),
        ];
    }
}
