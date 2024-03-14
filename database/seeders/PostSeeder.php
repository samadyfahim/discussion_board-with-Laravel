<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();

        $post = $user->posts()->create([
            'title' => 'descuss Post',
            'content' => 'hi everyone.',
            'published_at' => now(),
        ]);
    }
}
