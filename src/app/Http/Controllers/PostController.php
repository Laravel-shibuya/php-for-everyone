<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Eloquent\Post;
use App\Http\Requests\Post\Store as StoreRequest;
use App\Http\Requests\Post\Update as UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

final class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('author')->orderByDesc('created_at')->paginate(25);
        return view('post.index', [
            'posts' => $posts,
        ]);
    }

    public function show(int $postId)
    {
        $post = Post::findOrFail($postId);
        return view('post.show', compact('post'));
    }

    public function create()
    {
        return view('post.create');
    }

    public function store(StoreRequest $request)
    {
        $loginUser = Auth::user();
        $post = $loginUser->posts()->create([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
        ]);

        return redirect(route('posts.show', $post));
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('post.edit', compact('post'));
    }

    public function update(UpdateRequest $request, Post $post)
    {
        $post->update([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
        ]);
        return redirect(route('posts.show', $post));
    }

    public function destroy(Post $post)
    {
        $this->authorize('destroy', $post);
        $post->delete();

        return redirect((route('home')));
    }
}
