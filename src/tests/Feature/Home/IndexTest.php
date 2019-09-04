<?php
declare(strict_types=1);

namespace Tests\Feature\Home;

use App\Eloquent\User;
use Tests\TestCase;

final class IndexTest extends TestCase
{
    public function testCanSeeLoggedInUser()
    {
        /** @var User $user */
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->get(route('home'));
        $response->assertSee(e($user->name));
        $response->assertSee(e($user->screen_name));
        $response->assertSee(nl2br(e($user->profile)));
    }

    public function testRedirectToLoginPageIfUnauthorized()
    {
        $response = $this->get(route('home'));
        $response->assertRedirect(route('login'));
    }
}
