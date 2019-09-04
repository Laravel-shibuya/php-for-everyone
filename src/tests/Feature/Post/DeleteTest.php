<?php

namespace Tests\Feature\Post;

use App\Eloquent\Post;
use App\Eloquent\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    use RefreshDatabase;

    /** @var Post */
    private $post;

    protected function setUp(): void
    {
        parent::setUp();
        $this->post = factory(Post::class)->state('with_author')->create();
    }

    public function testRedirectToHomeWhenDeleted()
    {
        $response = $this->actingAs($this->post->author)
                         ->delete(route('posts.destroy', $this->post))
        ;

        $response->assertRedirect(route('home'));
    }

    public function testCanDelete()
    {
        $this->actingAs($this->post->author)
             ->delete(route('posts.destroy', $this->post))
        ;

        $this->assertDatabaseMissing('posts', [
            'id' => $this->post->id,
        ]);
    }

    public function testCanNotDeleteWhenLoginUserIsNotAuthor()
    {
        $notAuthor= factory(User::class)->create();
        $response = $this->actingAs($notAuthor)
                         ->delete(route('posts.destroy', $this->post))
        ;

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testRedirectToLoginPageWhenUnauthorized()
    {
        $response = $this->delete(route('posts.destroy', $this->post));

        $response->assertRedirect(route('login'));
    }
}
