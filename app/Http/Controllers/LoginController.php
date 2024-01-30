<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $req) {

        if (session('username')) {
            return redirect('/');
        }

        $user = DB::table('users')->select(
            ['username', 'name', 'password']
            )->where(
                'email', trim($req->email)
                )->get();

        if (!sizeof($user)) return dd("You are not registered.");

        if (!Hash::check(trim($req->password), $user[0]->password)) {
            return dd("Incorrect password.");
        }

        session([
            'username' => $user[0]->username,
            'name' => $user[0]->name
        ]);

        return redirect('/');
    }
}
