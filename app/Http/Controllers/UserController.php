<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function getUserPosts($userId)
    {
        $user = User::findOrFail($userId);
        $posts = $user->posts()->get();
        return view('posts.index', compact('posts'));
    }

    public function getUserComments($userId)
    {
        $user = User::findOrFail($userId);
        $comments = $user->comments()->get();
        return view('comments.index', compact('comments'));
    }


    public function create()
    {
        return view('users.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        User::create($request->all());

        return redirect()->route('users.index')
            ->with('success', 'User has been created successfully.');
    }
}
