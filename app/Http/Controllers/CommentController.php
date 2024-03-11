<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CommentController extends Controller
{
    public function store(Request $request): RedirectResponse {
        $request->validate([
            'comment_description' => ['required', 'string', 'max:255']
        ]);

        Comment::create([
            'comment_description' => $request->comment_description,
            'user_id' => Auth::user()->id,
            'post_id' => $request->post_id,
        ]);

        return Redirect::back();
    }

    public function destroy($post_id) {
        
        DB::table('comments')->where('post_id', '=', $post_id)->delete();
    }
}
