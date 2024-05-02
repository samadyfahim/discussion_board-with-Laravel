<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\User;
use App\Models\Post;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        $post = Post::first();

        Comment::factory()->count(20)->create();

        $post = Post::factory()->create();
        $comment = Comment::factory()->create([
            'post_id' => $post->id,
        ]);
    }
}
