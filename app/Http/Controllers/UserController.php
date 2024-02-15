<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function editProfilePicture(Request $req) {
        $validated = Validator::make($req->all(), [
            'image' => 'required|image|mimes:jpeg,jpg,png|max:1024'
        ])->validate();

        $img = $validated['image'];

        // foreach ($image as $img) {
            $imageName = time() . '_' . $req->username . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('images/' . $req->username . '/'), $imageName);

            DB::table('users')->where('username', '=', $req->username)->update(['profile_picture' => 'images/' . $req->username . '/' . $imageName]);
        // }

        session()->put('profile_picture', 'images/' . $req->username . '/' . $imageName);

        return redirect('/user/' . $req->username);
    }
}
