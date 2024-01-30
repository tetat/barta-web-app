<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GetUser extends Controller
{
    public function getUserByUsername(Request $req) {
        if (!session('username')) {
            return redirect('/guest');
        }

        $user = DB::table('users')->select(
            ['name', 'username', 'email']
            )->where(
                'username', trim($req->username)
                )->get();
        
        if (!sizeof($user)) return dd("You are not registered.");

        return view('/profile')->with(['user' => $user]);
    }
}
