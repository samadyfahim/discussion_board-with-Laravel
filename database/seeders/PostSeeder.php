<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Comment;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $post = new Post();
        $post->title = "My post";
        $post->content = "this is the content.";
        $post->published_at = now();
        $post->save();

        Post::factory()->count(10)->create();
        Post::factory()
            ->count(10)
            ->has(Comment::factory()->count(3))
            ->create();
    }
}
