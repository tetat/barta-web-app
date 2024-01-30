<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UpdateUser extends Controller
{
    public function updateUserByUsername(Request $req) {

        if (!session('username')) {
            return redirect('/guest');
        }

        if (!$req->first_name && !$req->last_name && !$req->email && !$req->password && !$req->bio) {
            return dd("Empty request! pleae provide data for edit.");
        }

        $user = ['initial' => 'muri'];

        if ($req->first_name || $req->last_name) {
            $name = '';
            if ($req->first_name) $name = $req->first_name . ' ';
            if ($req->last_name) $name = $name . $req->last_name;
            $user['name'] = $name;
        }
        if ($req->email) $user['email'] = $req->email;
        if ($req->password) $user['password'] = Hash::make($req->password);
        if ($req->bio) $user['bio'] = $req->bio;

        unset($user['initial']);

        $res = DB::table('users')->where('username', $req->username)->update($user);
        
        if (!$res) return dd("Update failed!");

        return redirect('/');
    }
}
