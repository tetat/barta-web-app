<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function registration() {
        if (Auth::user()) return redirect('/');

        return view('register');
    }

    public function registrationPost(UserStoreRequest $req) {
        if (Auth::user()) return redirect('/');

        $data = $req->validated();

        $user = new User();

        $user['name'] = $data['name'];
        $user['username'] = $data['username'];
        $user['email'] = $data['email'];
        $user['password'] = Hash::make($data['password']);
        $user['created_at'] = now();
        $user['updated_at'] = now();

        $res = $user->save();

        if (!$res) {
            return back()->with('error', 'Registration failed!')->withInput();
        }

        return redirect(route('sign_in'))->with('success', 'Registration success, Please login.');
    }

    public function login() {
        if (Auth::user()) return redirect('/');

        return view('login');
    }

    public function loginPost(UserLoginRequest $req) {
        if (Auth::user()) return redirect('/');

        $data = $req->validated();

        if (Auth::attempt($data)) {
            $req->session()->regenerate();
 
            return redirect()->intended('/');
        }

        return redirect(route('login'))->with('error', 'Login details are not valid!')->withInput();
    }

    public function logout() {
        if (!Auth::user()) return redirect(route('guest'));
        
        Session::flush();
        Auth::logout();
        return redirect(route('guest'));
    }
}
