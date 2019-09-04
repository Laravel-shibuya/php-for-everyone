<?php

namespace Tests\Feature\Post;

use App\Eloquent\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    /** @var User */
    private $loginUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->loginUser = factory(User::class)->create();
    }

    public function testCanStore()
    {
        $this->actingAs($this->loginUser)
             ->post(route('posts.store'), $params = $this->getParams())
        ;

        $this->assertDatabaseHas('posts', [
            'title' => $params['title'],
            'body' => $params['body'],
        ]);
    }

    public function testRedirectToLoginPageWhenUnauthorized()
    {
        $response = $this->post(route('posts.store'), $this->getParams());

        $response->assertRedirect(route('login'));
    }

    /**
     * @dataProvider validationDataProvider
     */
    public function testValidation(string $attribute, $value)
    {
        $data = $this->getParams([$attribute => $value]);
        $response = $this->actingAs($this->loginUser)
                         ->post(route('posts.store'), $data)
        ;

        $response->assertSessionHasErrors($attribute);
    }

    private function getParams(array $data = []): array
    {
        return array_merge([
            'title' => 'testing title',
            'body' => 'testing body',
        ], $data);
    }

    public function validationDataProvider(): array
    {
        $cases = [];

        // case1 ------------------------------------------
        $attribute = 'title';
        $value = null;

        $cases['titleは必須'] = [$attribute, $value];

        // case2 ------------------------------------------
        $attribute = 'title';
        $value = str_repeat('x', 256);

        $cases['titleは255文字以下であること'] = [$attribute, $value];

        // case3 ------------------------------------------
        $attribute = 'title';
        $value = [];

        $cases['titleは文字列であること'] = [$attribute, $value];

        // case4 ------------------------------------------
        $attribute = 'body';
        $value = null;

        $cases['bodyは必須'] = [$attribute, $value];

        // case5 ------------------------------------------
        $attribute = 'body';
        $value = [];

        $cases['bodyは文字列であること'] = [$attribute, $value];

        return $cases;
    }
}
