<?php

namespace Tests\Feature\Post;

use App\Eloquent\User;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class CreateTest extends TestCase
{
    public function testCanAccess()
    {
        $loginUser = factory(User::class)->make();
        $response = $this->actingAs($loginUser)
                         ->get(route('posts.create'))
        ;

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testRedirectToLoginPageWhenUnauthorized()
    {
        $response = $this->get(route('posts.create'));

        $response->assertRedirect(route('login'));
    }
}
