<?php

use App\Http\Controllers\GetUser;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UpdateUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/* Post section */
// Get posts feed
Route::get('/', [PostController::class, 'getPosts']);

// Get post
Route::get('/post/{post_unique_id}', [PostController::class, 'getPost']);

// Create post
Route::post('/post_store', [PostController::class, 'postStore']);

// Delete post
Route::get('/drop_post/{post_unique_id}', function (Request $req) {
    if (!session('username')) return redirect('/guest');
    return view('drop_post')->with('post_unique_id', $req->post_unique_id);
});
Route::delete('/drop_post/{post_unique_id}', [PostController::class, 'drop']);

// Update post
Route::get('/edit_post/{post_unique_id}', function (Request $req) {
    if (!session('username')) return redirect('/guest');
    $post = DB::table('posts')->where('post_unique_id', '=', $req->post_unique_id)->select('description')->get()[0];
    $post->post_unique_id = $req->post_unique_id;
    
    return view('edit_post')->with('post', $post);
});
Route::patch('/edit_post/{post_unique_id}', [PostController::class, 'edit']);

/* Unregistered users or visitors */
Route::get('/guest', function () {
    if (session('username')) return redirect('/');
    return view('guest');
});

/* Users section */
Route::get('/sign_in', function () {
    if (session('username')) return redirect('/');
    return view('login');
});

Route::post('/login', [LoginController::class, 'login']);

Route::get('/sign_out', function () {
    if (session('username')) session()->flush();
    return redirect('/guest');
});

Route::get('/sign_up', function () {
    if (session('username')) return redirect('/');
    return view('register');
});

Route::post('/register', [RegisterController::class, 'register']);

Route::get('/user/{username}', [GetUser::class, 'getUserByUsername']);

// Update user
Route::get('/update', function () {
    if (!session('username')) return redirect('/guest');
    return view('edit_user');
});
Route::patch('/edit/{username}', [UpdateUser::class, 'updateUserByUsername']);

// Update profile picture
Route::get('/user/{username}/profile_picture', function (Request $req) {
    if (!session('username')) return redirect('/guest');

    $user = DB::table('users')->where('username', '=', $req->username)->select(['profile_picture'])->get()[0];
    $user->username = $req->username;

    return view('edit_profile_picture')->with('user', $user);
});