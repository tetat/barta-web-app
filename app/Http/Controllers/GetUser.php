<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class GetUser extends Controller
{
    public function getUserByUsername(Request $req) {
        if (!session('username')) {
            return redirect('/guest');
        }

        $user = DB::table('users')->select(
            ['name', 'username', 'email', 'profile_picture']
            )->where(
                'username', trim($req->username)
                )->get();
        
        if (!sizeof($user)) {
            if (session('username')) {
                session()->flush();
            }
            return Redirect('/guest');
        }

        // if (File::exists(public_path() . '/images')) {
        //     return dd('images exits');
        // }

        return view('/profile')->with(['user' => $user]);
    }
}
