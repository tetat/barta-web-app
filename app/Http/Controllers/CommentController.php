<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CommentController extends Controller
{
    public function store(CommentRequest $request): RedirectResponse {
        Comment::create([
            'comment_description' => $request->comment_description,
            'user_id' => Auth::user()->id,
            'post_id' => $request->post_id,
        ]);

        return Redirect::back();
    }

    public function update(CommentRequest $request): RedirectResponse {
        $comment = Comment::where('id', $request->comment_id)->first();
        $comment->comment_description = $request->comment_description;
        $comment->save();

        return Redirect::back();
    }

    public function destroy(Request $request): RedirectResponse {
        $comment = Comment::where('id', $request->comment_id)->first();

        if (!$comment) return Redirect::route('dashboard');

        $comment->delete();

        return Redirect::back();
    }
}
