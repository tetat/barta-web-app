<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->middleware('guest');

Route::get('/dashboard', [PostController::class, 'getPosts'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // get profile
    Route::get('/u/{username}', [ProfileController::class, 'getUserByUsername']);
    // edit profile picture
    Route::get('/image', [ProfileController::class, 'editProfilePicture'])->name('image.edit');
    Route::patch('/image', [ProfileController::class, 'updateProfilePicture'])->name('image.update');
    // edit profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // delete account
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    // Get post
    Route::get('/post/{post_unique_id}', [PostController::class, 'getPost']);

    // Create post
    Route::post('/post_store', [PostController::class, 'postStore'])->name('post_store');

    // Update post
    Route::get('/edit/{post_unique_id}', [PostController::class, 'edit']);
    Route::patch('/update/{post_unique_id}', [PostController::class, 'update']);
    
    // Delete post
    Route::get('/drop/{post_unique_id}', [PostController::class, 'drop']);
    Route::delete('/destroy/{post_unique_id}', [PostController::class, 'destroy']);
});

Route::middleware('auth')->group(function () {
    Route::post('/comment/{post_unique_id}/store', [CommentController::class, 'commentStore']);
});

require __DIR__.'/auth.php';
