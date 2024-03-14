<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::resource('users', 'UserController');
Route::resource('posts', 'PostController');
Route::resource('comments', 'CommentController');