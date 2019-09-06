<?php
declare(strict_types=1);

namespace App\Http\Responders\Post;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class Index
 * @package App\Http\Responders\Post
 */
final class Index
{
    /**
     * @param LengthAwarePaginator $posts
     * @return mixed
     */
    public function respond(LengthAwarePaginator $posts)
    {
        return view('post.index', compact('posts'));
    }
}
