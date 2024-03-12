<?php

namespace App\Http\Middleware;

use App\Models\Comment;
use App\Models\Post;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ActionOnOwnContent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->username === $request->username) {
            return $next($request);
        }

        if ($request->post_unique_id) {
            if (Post::where('user_id', Auth::user()->id)) {
                return $next($request);
            }
        }

        if ($request->comment_id) {
            if (Comment::where('user_id', Auth::user()->id)) {
                return $next($request);
            }
        }

        return redirect(RouteServiceProvider::HOME);
    }
}
