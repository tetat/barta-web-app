<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->middleware('guest');

Route::get('/dashboard', [PostController::class, 'index'])->middleware('auth')->name('dashboard');

// profiles section
Route::group(['middleware' => 'auth', 'prefix' => 'profile'], function () {
    Route::get('/{username}', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/user/search', [ProfileController::class, 'search'])->name('profile.search');
    Route::get('/{username}/edit', [ProfileController::class, 'edit'])->middleware('OwnContent')->name('profile.edit');
    Route::patch('/{username}/update', [ProfileController::class, 'update'])->middleware('OwnContent')->name('profile.update');
    Route::delete('/{username}/destroy', [ProfileController::class, 'destroy'])->middleware('OwnContent')->name('profile.destroy');
});
// posts section
Route::group(['middleware' => 'auth', 'prefix' => 'post'], function () {
    Route::post('/store', [PostController::class, 'store'])->name('post.store');
    Route::get('/{post_unique_id}', [PostController::class, 'show'])->name('post.show');
    Route::patch('/{post_unique_id}/update', [PostController::class, 'update'])->middleware('OwnContent')->name('post.update');
    Route::delete('/{post_unique_id}/destroy', [PostController::class, 'destroy'])->middleware('OwnContent')->name('post.destroy');
});
// comments section
Route::group(['middleware' => 'auth', 'prefix' => 'comment'], function () {
    Route::post('/{post_id}/store', [CommentController::class, 'store'])->name('comment.store');
    Route::patch('/{comment_id}/update', [CommentController::class, 'update'])->middleware('OwnContent')->name('comment.update');
    Route::delete('/{comment_id}/destroy', [CommentController::class, 'destroy'])->middleware('OwnContent')->name('comment.destroy');
});

require __DIR__.'/auth.php';
