<?php
declare(strict_types=1);

namespace App\Domain\Services\Post;

use App\Domain\Eloquent\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class FetchRecentPosts
 * @package App\Domain\Services\Post
 */
final class FetchRecentPosts
{
    /**
     * @var Post
     */
    private $post;

    /**
     * FetchRecentPosts constructor.
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * 投稿日時順で最新の記事一覧を取得する
     *
     * @param int $postsPerPage 1 ページあたりの記事件数
     * @return LengthAwarePaginator
     */
    public function execute(int $postsPerPage): LengthAwarePaginator
    {
        return $this->post
            ->with('author')
            ->orderByDesc('created_at')
            ->paginate($postsPerPage);
    }
}
