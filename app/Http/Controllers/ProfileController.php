<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the specific user profile.
     */
    public function show(Request $request): View
    {
        $user = User::where('username', $request->username)->with(['posts' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }])->first();

        $user->total_posts = $user->posts->count();
        $user->total_comments = Comment::where('user_id', $user->id)->count();

        foreach ($user->posts as &$post) {
            $post->comments = Comment::where('post_id', $post->id)->select('comment_description')->get();
        }

        return view('profiles.me', [
            'user' => $user,
        ]);
    }

    /**
     * Display the user's profile edit form.
     */
    public function edit(Request $request): View
    {
        return view('profiles.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = User::where('username', $request->username)->first();

        if ($request->name) $user->name = $request->name;
        if ($request->email) $user->email = $request->email;
        if ($request->bio) $user->bio = $request->bio;

        $user->save();

        if ($request->hasFile('avatar')) {
            $user
                ->addMediaFromRequest('avatar')
                ->toMediaCollection('avatar');
        }

        return Redirect::route('profile.edit', $user->username)->with('success', 'profile-updated');
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
