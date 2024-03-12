<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Http\Requests\PostRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Store a post.
     */
    public function store(PostRequest $request): RedirectResponse {
        $post = Post::create([
            'post_description' => $request->post_description,
            'post_unique_id' => Str::uuid(),
            'user_id' => Auth::user()->id,
        ]);

        if ($request->hasFile('image')) {
            $post->addMediaFromRequest('image')->toMediaCollection('post_image');
        }

        return Redirect::route('dashboard')->with('success', 'Post added successfully.');
    }
    /**
     * Display posts
     */
    public function index(): View {
        $posts = Post::orderBy('created_at', 'desc')->get();

        foreach ($posts as &$post) {
            $post->user = User::where('id', $post->user_id)->first();
            $post->comments = Comment::where('post_id', $post->id)->count();
        }

        return view('layouts.app')->with('posts', $posts);
    }
    /**
     * Display a specific post
     */
    public function show(Request $request): View {
        $post = Post::with('comments')->where('post_unique_id', $request->post_unique_id)->first();
        $post->user = User::where('id', $post->user_id)->first();

        foreach ($post->comments as &$comment) {
            $comment->user = User::where('id', $comment->user_id)->first();
        }

        return view('posts.post')->with('post', $post);
    }
    /**
     * Display a post edit form
     */
    public function edit(Request $request): View {
        $post = Post::where('post_unique_id', $request->post_unique_id)->first();
        
        return view('posts.edit')->with('post', $post);
    }
    /**
     * Update information of a post
     */
    public function update(PostRequest $request): RedirectResponse {
        $post = Post::where('post_unique_id', $request->post_unique_id)->first();
        $post->post_description = $request->post_description;
        $post->save();

        return Redirect::route('post.edit', $request->post_unique_id)->with('success', 'Post updated successfully.');
    }
    /**
     * Display post delete form
     */
    public function drop(Request $req): View {
        return view('posts.drop')
                ->with('post_unique_id', $req->post_unique_id);
    }
    /**
     * Delete a post
     */
    public function destroy(Request $request): RedirectResponse {
        $post = Post::where('post_unique_id', $request->post_unique_id)->first();

        if (!$post) return Redirect::route('dashboard');

        // delete comments if any
        Comment::where('post_id', $post->id)->delete();
        // delete image if any
        if ($post->getFirstMediaUrl('post_image')) {
            $post->clearMediaCollection('post_image');
        }
        // delete post
        $post->delete();

        return Redirect::route('dashboard')->with('success', 'Post deleted successfully.');
    }
}