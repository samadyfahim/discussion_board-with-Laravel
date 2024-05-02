<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Models\User;
use App\Livewire\Profile;
use App\Livewire\AddPostForm;
use App\Livewire\Dashboard;
use App\Livewire\Notification;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/guest', function () {
    return view('dashboard');
})->name('guest');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/dashboard', [PostController::class, 'viewPosts'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/profile/{id}', Profile::class)
    ->middleware(['auth', 'verified'])
    ->name('profile');

Route::get('/addPost', AddPostForm::class)
    ->middleware(['auth', 'verified'])
    ->name('addPost');

Route::get('/notification', Notification::class)
    ->middleware(['auth', 'verified'])
    ->name('notification');


require __DIR__ . '/auth.php';
