<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;


class PostController
{
    public function viewPosts()
    {
        $posts = Post::with('user')->paginate(10);
        return view('dashboard', ['posts' => $posts]);
    }
}
