<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $req) {

        $user = DB::table('users')->select(['id', 'name', 'password'])->where('email', trim($req->email))->get();

        if (!sizeof($user)) return dd("You are not registered.");

        if (!Hash::check(trim($req->password), $user[0]->password)) {
            return dd("Incorrect password.");
        }

        return redirect('/');
    }
}
