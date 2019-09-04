<?php

namespace Tests\Feature\User;

use App\Eloquent\Post;
use App\Eloquent\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    /** @var User */
    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    public function testCanAccess()
    {
        $response = $this->get(route('users.show', $this->user));

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testResponseStatusMustBe404WhenPostDoesNotExists()
    {
        $response = $this->get(route('users.show', 'does_not_exists'));

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function testCanSeeUser()
    {
        $response = $this->get(route('users.show', $this->user));

        $response->assertSee(e($this->user->name));
        $response->assertSee(e($this->user->screen_name));
        $response->assertSee(nl2br(e($this->user->profile)));
    }

    public function testCanSeePosts()
    {
        $posts = factory(Post::class, 2)->create([
            'user_id' => $this->user->id,
        ]);
        $response = $this->get(route('users.show', $this->user));

        foreach ($posts as $post) {
            $response->assertSee(e($post->title));
            $response->assertSee(e(route('posts.show', $post)));
        }
    }
}
