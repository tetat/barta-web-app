<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UpdateUser extends Controller
{
    public function updateUserByUsername(UpdateUserRequest $req) {
        if (!Auth::user()) return redirect(route('guest'));

        $user = $req->validated();

        if (!$user['first_name']) unset($user['first_name']);
        if (!$user['last_name']) unset($user['last_name']);
        if (!$user['email']) unset($user['email']);
        if (!$user['password']) unset($user['password']);
        if (!$user['bio']) unset($user['bio']);

        if (!$user) return back()->withErrors('Please provide data you want to update.');

        if (isset($user['first_name']) || isset($user['last_name'])) {
            $name = '';
            if (isset($user['first_name'])) {
                $name = $user['first_name'] . ' ';
                unset($user['first_name']);
            }
            if (isset($user['last_name'])) {
                $name = $name . $user['last_name'];
                unset($user['last_name']);
            }

            $user['name'] = $name;
        }
        
        if (isset($user['password'])) $user['password'] = Hash::make($user['password']);

        $res = DB::table('users')->where('username', $req->username)->update($user);
        
        if (!$res) return back()->withErrors('Failed to update.')->withInput();

        return redirect('/');
    }
}
