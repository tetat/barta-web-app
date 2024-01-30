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

        $name = $req->first_name ? $req->first_name . ' ' : '';
        if ($req->last_name) $name = $name . $req->last_name;

        if ($name === '') $name = null;

        $user = [
            'name' => [$name, 'name'],
            'email' => [$req->email, 'email'],
            'password' => [
                $req->password ? Hash::make($req->password) : null,
                'password'
            ],
            'bio' => [$req->bio, 'bio']
        ];

        foreach ($user as $field) {
            if ($field[0] === null) continue;
            DB::table('users')->where('username', $req->username)->update([$field[1] => $field[0]]);
        }
        
        // if (!$user) return dd("Couldn't update.");

        return redirect('/');
    }
}
