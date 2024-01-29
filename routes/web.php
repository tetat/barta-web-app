<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('app');
});

Route::get('/guest', function () {
    return view('guest');
});

Route::get('/sign_in', function () {
    return view('login');
});

Route::post('/login', [LoginController::class, 'login']);

Route::get('/sign_up', function () {
    return view('register');
});

Route::post('/register', [RegisterController::class, 'register']);