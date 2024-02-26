<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile.
     */
    public function getUserByUsername(Request $request): View
    {
        $user = DB::table('users')->where('username', '=', $request->username)->get()->first();

        $posts = DB::table('posts')->orderBy('created_at', 'desc')->where('posts.user_id', '=', $user->id)->get();

        $user->total_posts = $posts->count();
        $user->total_comments = DB::table('comments')->where('user_id', '=', $user->id)->count();

        foreach ($posts as &$post) {
            $images = DB::table('images')->where('post_id', '=', $post->id)->select(['image', 'post_id'])->get();
            $comments = DB::table('comments')->where('post_id', '=', $post->id)->select('comment_description')->get();
            
            $post->images = $images;
            $post->comments = $comments;
        }

        return view('profile.me', [
            'user' => $user,
            'posts' => $posts,
        ]);
    }
    /**
     * Display the user's profile image form.
     */
    public function editProfilePicture(Request $request): View
    {
        return view('profile.update-image', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile picture.
     */
    public function updateProfilePicture(Request $request): RedirectResponse
    {
        if (!Auth::user()) return redirect(route('guest'));

        $validated = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,jpg,png|max:1024'
        ])->validate();

        $img = $validated['image'];

        $imageName = time() . '_' . Auth::user()->username . '.' . $img->getClientOriginalExtension();
        $img->move(public_path('images/' . Auth::user()->username . '/'), $imageName);

        DB::table('users')->where('username', '=', Auth::user()->username)->update(['profile_picture' => 'images/' . Auth::user()->username . '/' . $imageName]);

        Auth::user()->profile_picture = 'images/' . Auth::user()->username . '/' . $imageName;
        
        return Redirect::route('image.edit')->with('success', 'image-updated');
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        // return dd($request);
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->validated();

        if (!$user['name']) unset($user['name']);
        if (!$user['email']) unset($user['email']);
        if (!$user['bio']) unset($user['bio']);

        if (!$user) return back()->withErrors('Please provide data you want to update.');

        $user['updated_at'] = now();

        $res = DB::table('users')->where('username', Auth::user()->username)->update($user);
        
        if (!$res) return back()->withErrors('Failed to update.')->withInput();

        return Redirect::route('profile.edit')->with('success', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
