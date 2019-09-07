<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, int $postId)
    {
        if (!\App\Eloquent\Post::where('id', $postId)->exists()) abort(404);

        $this->validate($request, ['body' => 'required']);

        $comment = new \App\Eloquent\Comment;
        $comment->body = $request->input('body');
        $comment->post_id = $postId;
        $comment->user_id = \Auth::id();
        $comment->save();

        return redirect(route('posts.show', $postId));
    }
}
