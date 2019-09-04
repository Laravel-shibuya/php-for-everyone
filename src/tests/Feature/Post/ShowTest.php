<?php

namespace Tests\Feature\Post;

use App\Eloquent\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    /** @var Post */
    private $post;

    protected function setUp(): void
    {
        parent::setUp();

        $this->post = factory(Post::class)->state('with_author')->create();
    }

    public function testCanAccess()
    {
        $response = $this->get(route('posts.show', $this->post));

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testResponseStatusMustBe404WhenPostDoesNotExists()
    {
        $response = $this->get(route('posts.show', 9999999));

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function testCanSeePost()
    {
        $response = $this->get(route('posts.show', $this->post));

        $response->assertSee(e($this->post->title));
        $response->assertSee(e($this->post->body));
    }

    public function testCanSeeAuthor()
    {
        $response = $this->get(route('posts.show', $this->post));

        $response->assertSee(e($this->post->author->screen_name));
        $response->assertSee(e(route('users.show', $this->post->author)));
    }
}
