<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(UserStoreRequest $req) {

        if (session('username')) {
            return redirect('/');
        }

        $user = $req->validated();

        $res = DB::table('users')->insertGetId([
            'name' => $user['name'],
            'username' => $user['username'],
            'email' => $user['email'],
            'password' => Hash::make($user['password']),
            'profile_picture' => 'images/poultry.png',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        session([
            'id' => $res,
            'username' => $user['username'],
            'name' => $user['name'],
            'profile_picture' => 'images/poultry.png'
        ]);

        return redirect('/');
    }
}
