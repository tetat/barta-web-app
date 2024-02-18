<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function getUserByUsername(Request $req) {
        if (!Auth::user()) return redirect(route('guest'));

        $user = DB::table('users')->select(
            ['name', 'username', 'bio', 'email', 'profile_picture']
            )->where(
                'username', trim($req->username)
                )->get();
        
        if (!sizeof($user)) {
            Session::flush();
            Auth::logout();
            return redirect(route('guest'));
        }

        // if (File::exists(public_path() . '/images')) {
        //     return dd('images exits');
        // }

        return view('/profile')->with(['user' => $user]);
    }

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

    public function editProfilePicture(Request $req) {
        if (!Auth::user()) return redirect(route('guest'));

        $validated = Validator::make($req->all(), [
            'image' => 'required|image|mimes:jpeg,jpg,png|max:1024'
        ])->validate();

        $img = $validated['image'];

        // foreach ($image as $img) {
            $imageName = time() . '_' . $req->username . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('images/' . $req->username . '/'), $imageName);

            DB::table('users')->where('username', '=', $req->username)->update(['profile_picture' => 'images/' . $req->username . '/' . $imageName]);
        // }

        Auth::user()->profile_picture = 'images/' . $req->username . '/' . $imageName;

        return redirect('/user/' . $req->username);
    }
}
