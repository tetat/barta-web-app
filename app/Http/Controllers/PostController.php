<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function postStore(PostRequest $req) {
        $post = $req->validated();

        $post['user_id'] = session('id');
        $post['post_unique_id'] = Str::uuid();
        $post['created_at'] = now();
        $post['updated_at'] = now();

        $images = $post['image'] ?? [];
        unset($post['image']);

        $res = DB::table('posts')->insertGetId($post);

        foreach ($images as $img) {
            $imageName = time() . '_' . $img->getClientOriginalName();
            $img->move(public_path('images/' . $res), $imageName);

            $imageData = [
                'image' => 'images/' . $res . '/' . $imageName,
                'post_id' => $res,
                'created_at' => now(),
                'updated_at' => now()
            ];

            DB::table('images')->insert($imageData);
        }

        return redirect('/');
    }

    public function getPosts() {
        if (!session('username')) return redirect('/guest');

        $posts = DB::table('posts')->orderBy('created_at', 'desc')->leftJoin('users', 'posts.user_id', '=', 'users.id')->select(['posts.*', 'users.name', 'users.username', 'users.profile_picture'])->get();

        foreach ($posts as &$post) {
            $images = DB::table('images')->where('post_id', '=', $post->id)->select(['image', 'post_id'])->get();
            
            $post->images = $images;
        }

        return view('app')->with('posts', $posts);
    }

    public function getPost(Request $req) {
        if (!session('username')) return redirect('/guest');

        $post = DB::table('posts')->leftJoin('users', 'posts.user_id', '=', 'users.id')->where('post_unique_id', '=', $req->post_unique_id)->select(['posts.*', 'users.name', 'users.username', 'users.profile_picture'])->get()[0];

        $post->images = DB::table('images')->where('post_id', '=', $post->id)->select(['image', 'post_id'])->get();

        return view('post')->with('post', $post);
    }

    public function edit(PostRequest $req) {
        $update = DB::table('posts')->where('post_unique_id', '=', $req->post_unique_id)->update($req->validated());

        return redirect('/');
    }

    public function drop(Request $req) {
        $posts = DB::table('posts')->leftJoin('images', 'posts.id', '=', 'images.post_id')->where('post_unique_id', '=', $req->post_unique_id)->select('posts.id', 'images.image')->get();

        foreach ($posts as $post) {
            DB::table('images')->where('post_id', '=', $post->id)->delete();
            if (isset($post->image)) {
                File::delete($post->image);
            }
        }

        $delete = DB::table('posts')->where('post_unique_id', '=', $req->post_unique_id)->delete();

        return redirect('/');
    }
}
