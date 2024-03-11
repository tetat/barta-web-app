<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->middleware('guest');

Route::get('/dashboard', [PostController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // profiles section
    Route::get('/profile/{username}', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/{username}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/{username}/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/{username}/destroy', [ProfileController::class, 'destroy'])->name('profile.destrooy');

    // posts section
    Route::post('/post/store', [PostController::class, 'store'])->name('post.store');
    Route::get('/post/{post_unique_id}', [PostController::class, 'show'])->name('post.show');
    Route::get('/post/{post_unique_id}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::patch('/post/{post_unique_id}/update', [PostController::class, 'update'])->name('post.update');
    Route::get('/post/{post_unique_id}/drop', [PostController::class, 'drop'])->name('post.drop');
    Route::delete('/post/{post_unique_id}/destroy', [PostController::class, 'destroy'])->name('post.destroy');

    // comments section
    Route::post('/comment/{post_id}/store', [CommentController::class, 'store'])->name('comment.store');
});

require __DIR__.'/auth.php';
