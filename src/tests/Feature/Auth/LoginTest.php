<?php
declare(strict_types=1);

namespace Tests\Feature\Auth;

use App\Eloquent\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

final class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @var User */
    private $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create([
            'name' => 'test',
            'password' => bcrypt('password'),
        ]);
    }

    public function testCanLogin()
    {
        $this->post(route('login'), [
            'name' => $this->user->name,
            'password' => 'password',
        ]);

        $this->assertTrue(Auth::check());
    }

    public function testRedirectToHomeIfLoginSucceed()
    {
        $response = $this->post(route('login'), [
            'name' => $this->user->name,
            'password' => 'password',
        ]);

        $response->assertRedirect(route('home'));
    }

    public function testFailLoginWithPasswordIsIncorrect()
    {
        $response = $this->post(route('login'), [
            'name' => $this->user->name,
            'password' => 'incorrect password',
        ]);

        $response->assertSessionHasErrors('name');
        $this->assertFalse(Auth::check());
    }

    public function testFailLoginWithNameIsIncorrect()
    {
        $response = $this->post(route('login'), [
            'name' => $this->user->name.' incorrect',
            'password' => 'password',
        ]);

        $response->assertSessionHasErrors('name');
        $this->assertFalse(Auth::check());
    }
}
