<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $req) {

        if (session('username')) {
            return redirect('/');
        }

        $res = DB::table('users')->insert([
            'name' => trim($req->name),
            'username' => trim($req->username),
            'email' => trim($req->email),
            'password' => Hash::make($req->password),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        session([
            'username' => $req->username,
            'name' => $req->name
        ]);

        return redirect('/');
    }
}
