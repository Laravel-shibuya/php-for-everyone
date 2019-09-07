<?php

namespace Tests\Feature\Comment;

use App\Eloquent\Post;
use App\Eloquent\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    /** @var User */
    private $user;
    /** @var Post */
    private $post;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->post = factory(Post::class)->create([
            'user_id' => $this->user->id,
        ]);
    }

    public function testCanStoreComment()
    {
        $this->actingAs($this->user);
        $this->post("/posts/{$this->post->id}/comments", ['body' => 'testing comment']);

        $this->assertDatabaseHas('comments', ['body' => 'testing comment']);
    }

    public function testValidationWithEmptyBody()
    {
        $this->actingAs($this->user);
        $response = $this->post("/posts/{$this->post->id}/comments", ['body' => '']);

        $response->assertSessionHasErrors('body');
    }

    public function testCanNotCommentWhenPostDoesNotExists()
    {
        $this->actingAs($this->user);
        $response = $this->post('/posts/9999999/comments', ['body' => 'testing comment']);

        $response->assertStatus(404);
    }

    public function testCanNotCommentWhenUnauthenticated()
    {
        $response = $this->post("/posts/{$this->post->id}/comments", ['body' => 'testing comment']);
        $response->assertRedirect(route('login'));
    }
}
