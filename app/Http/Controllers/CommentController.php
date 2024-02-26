<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Str;

class CommentController extends Controller
{
    public function commentStore(Request $request) {
        $request->validate([
            'comment_description' => ['required', 'string', 'max:255']
        ]);

        $id = DB::table('posts')->where('post_unique_id', '=', $request->post_unique_id)->select('id')->get()->first()->id;

        $comment = [
            'comment_description' => $request->comment_description,
            'user_id' => Auth::user()->id,
            'post_id' => $id,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $res = DB::table('comments')->insertGetId($comment);

        return back();
    }

    public function destroy($post_id) {
        
        DB::table('comments')->where('post_id', '=', $post_id)->delete();
    }
}
