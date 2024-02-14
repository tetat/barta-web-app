<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(UserLoginRequest $req) {

        if (session('username')) {
            return redirect('/');
        }

        $reqUser = $req->validated();

        $user = DB::table('users')->select(
            ['id', 'username', 'name', 'password', 'profile_picture']
            )->where(
                'email', $reqUser['email']
                )->get();

        if (!sizeof($user)) return back()->withErrors('Incorrect email.')->withInput();

        if (!Hash::check($reqUser['password'], $user[0]->password)) {
            return back()->withErrors('Incorrect password.')->withInput();
        }

        session([
            'id' => $user[0]->id,
            'username' => $user[0]->username,
            'name' => $user[0]->name,
            'profile_picture' => $user[0]->profile_picture
        ]);

        return redirect('/');
    }
}
