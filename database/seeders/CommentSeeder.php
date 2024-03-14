<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        $post = Post::first();

        $comment = $post->comments()->create([
            'user_id' => $user->id,
            'content' => 'my comment.',
        ]);
    }
}
