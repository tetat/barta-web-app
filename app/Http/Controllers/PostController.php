<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Http\Requests\PostRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PostController extends Controller
{
    public function postStore(PostRequest $req): RedirectResponse {
        $post = $req->validated();

        $post['user_id'] = Auth::user()->id;
        $post['post_unique_id'] = Str::uuid();
        $post['created_at'] = now();
        $post['updated_at'] = now();

        $images = $post['image'] ?? [];
        unset($post['image']);

        $post_id = DB::table('posts')->insertGetId($post);

        (new ImageController())->store($images, $post_id);

        return Redirect::route('dashboard')->with('success', 'Post added successfully.');
    }

    public function getPosts(): View {
        $posts = DB::table('posts')->orderBy('created_at', 'desc')->leftJoin('users', 'posts.user_id', '=', 'users.id')->select(['posts.*', 'users.name', 'users.username', 'users.profile_picture'])->get();

        foreach ($posts as &$post) {
            $images = DB::table('images')->where('post_id', '=', $post->id)->select(['image', 'post_id'])->get();
            $comments = DB::table('comments')->where('post_id', '=', $post->id)->count();
            
            $post->images = $images;
            $post->comments = $comments;
        }

        return view('layouts.app')->with('posts', $posts);
    }

    public function getPost(Request $req): View {
        $post = DB::table('posts')->join('users', 'posts.user_id', '=', 'users.id')->where('post_unique_id', '=', $req->post_unique_id)->select(['users.name', 'users.username', 'users.profile_picture', 'posts.*'])->get()->first();

        $post->images = DB::table('images')->where('post_id', '=', $post->id)->select('image')->get();

        $post->comments = DB::table('comments')->where('comments.post_id', '=', $post->id)->join('users', 'comments.user_id', '=', 'users.id')->select(['comments.comment_description', 'users.name', 'users.username'])->get();

        return view('posts.post')->with('post', $post);
    }

    public function edit(Request $req): View {
        $post = DB::table('posts')->where('post_unique_id', '=', $req->post_unique_id)->select(['post_description', 'post_unique_id'])->get()->first();
        
        return view('posts.edit')->with('post', $post);
    }

    public function update(PostRequest $req) {
        $update = DB::table('posts')->where('post_unique_id', '=', $req->post_unique_id)->update($req->validated());

        return back()->with('success', 'Post updated successfully.');
    }

    public function drop(Request $req): View {
        return view('posts.drop')->with('post_unique_id', $req->post_unique_id);
    }

    public function destroy(Request $req) {
        $post = DB::table('posts')->where('post_unique_id', '=', $req->post_unique_id)->select('posts.id')->get()->first();
        // delete comments
        (new CommentController())->destroy($post->id);
        // delete images
        (new ImageController())->destroy($post->id);
        // delete post
        $delete = DB::table('posts')->where('post_unique_id', '=', $req->post_unique_id)->delete();

        return back()->with('success', 'Post deleted successfully.');
    }
}