<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GetUser;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UpdateUser;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/* Post section */
// Get posts feed
Route::get('/', [PostController::class, 'getPosts']);

// Get post
Route::get('/post/{post_unique_id}', [PostController::class, 'getPost']);

// Create post
Route::post('/post_store', [PostController::class, 'postStore'])->name('post_store');

// Delete post
Route::get('/drop_post/{post_unique_id}', function (Request $req) {
    return view('drop_post')->with('post_unique_id', $req->post_unique_id);
});
Route::delete('/drop_post/{post_unique_id}', [PostController::class, 'drop']);

// Update post
Route::get('/edit_post/{post_unique_id}', function (Request $req) {
    $post = DB::table('posts')->where('post_unique_id', '=', $req->post_unique_id)->select('description')->get()[0];
    $post->post_unique_id = $req->post_unique_id;
    
    return view('edit_post')->with('post', $post);
});
Route::patch('/edit_post/{post_unique_id}', [PostController::class, 'edit']);

/* Unregistered users or visitors */
Route::get('/guest', function () {
    return view('guest');
})->name('guest');

/* Users section */
// Auth section
Route::get('/sign_in', [AuthController::class, 'login'])->name('sign_in');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login');

Route::get('/sign_out', [AuthController::class, 'logout'])->name('sign_out');

Route::get('/sign_up', [AuthController::class, 'registration'])->name('sign_up');
Route::post('/register', [AuthController::class, 'registrationPost'])->name('register');

// Get single user
Route::get('/user/{username}', [UserController::class, 'getUserByUsername']);

// Update user
Route::get('/update', function () {
    return view('edit_user');
});
Route::patch('/edit/{username}', [UserController::class, 'updateUserByUsername']);

// Update profile picture
Route::get('/user/{username}/profile_picture', function (Request $req) {
    $user = DB::table('users')->where('username', '=', $req->username)->select(['profile_picture'])->get()[0];
    $user->username = $req->username;

    return view('edit_profile_picture')->with('user', $user);
});
Route::patch('/user/{username}/profile_picture', [UserController::class, 'editProfilePicture']);