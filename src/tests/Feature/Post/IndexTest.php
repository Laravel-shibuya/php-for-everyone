<?php

namespace Tests\Feature\Post;

use App\Eloquent\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function testCanAccess()
    {
        $response = $this->get(route('posts.index'));

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testCanSeePosts()
    {
        $posts = factory(Post::class, 2)->state('with_author')->create();
        $response = $this->get(route('posts.index'));
        foreach ($posts as $post) {
            /** @var Post $post */
            $response->assertSee(e($post->title));
            $response->assertSee(route('posts.show', $post));
        }
    }
}
