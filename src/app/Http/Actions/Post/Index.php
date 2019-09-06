<?php
declare(strict_types=1);

namespace App\Http\Actions\Post;

use App\Domain\Services\Post\FetchRecentPosts;
use App\Http\Actions\Action;
use App\Http\Responders\Post\Index as Responder;

/**
 * Class Index
 * @package App\Http\Actions\Post
 */
final class Index extends Action
{
    const POSTS_PER_PAGE = 25;

    /**
     * @var FetchRecentPosts
     */
    private $fetchRecentPosts;

    /**
     * @var Responder
     */
    private $responder;

    /**
     * Index constructor.
     * @param FetchRecentPosts $fetchRecentPosts
     * @param Responder $responder
     */
    public function __construct(FetchRecentPosts $fetchRecentPosts, Responder $responder)
    {
        $this->fetchRecentPosts = $fetchRecentPosts;
        $this->responder = $responder;
    }

    /**
     * @return mixed
     */
    public function __invoke()
    {
        // 記事一覧を取得（最近投稿された記事を複数件数取得）
        $posts = $this->fetchRecentPosts->execute(static::POSTS_PER_PAGE);
        // HTTPレスポンスを構築して、返す
        return $this->responder->respond($posts);
    }
}
