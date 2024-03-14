<?php

namespace App\Http\Controllers;

abstract class UserController
{
     
    public function index()
    {
        $users = User::latest()->paginate(5);
        return view('users.index', compact('users'));
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
