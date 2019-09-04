<?php

namespace Tests\Feature\Post;

use App\Eloquent\Post;
use App\Eloquent\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class EditTest extends TestCase
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
        $response = $this->actingAs($this->post->author)
                         ->get(route('posts.edit', $this->post))
        ;

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testRedirectToLoginPageWhenUnauthorized()
    {
        $response = $this->get(route('posts.edit', $this->post));

        $response->assertRedirect(route('login'));
    }

    public function testCanNotAccessWhenLoginUserIsNotAuthor()
    {
        $notAuthor= factory(User::class)->create();
        $response = $this->actingAs($notAuthor)
                         ->get(route('posts.edit', $this->post))
        ;

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
