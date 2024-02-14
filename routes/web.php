<?php

use App\Http\Controllers\GetUser;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UpdateUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/', [PostController::class, 'getPosts']);

Route::get('/guest', function () {
    if (session('username')) return redirect('/');
    return view('guest');
});

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

Route::get('/update', function () {
    if (!session('username')) return redirect('/guest');
    return view('edit_user');
});

Route::patch('/edit/{username}', [UpdateUser::class, 'updateUserByUsername']);

Route::post('/post_store', [PostController::class, 'postStore']);

Route::get('/drop_post/{post_unique_id}', function (Request $req) {
    if (!session('username')) return redirect('/guest');
    return view('drop_post')->with('post_unique_id', $req->post_unique_id);
});
Route::delete('/drop_post/{post_unique_id}', [PostController::class, 'drop']);