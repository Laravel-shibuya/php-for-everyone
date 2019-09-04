<?php

namespace Tests\Feature\Post;

use App\Eloquent\Post;
use App\Eloquent\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    /** @var Post */
    private $post;

    protected function setUp(): void
    {
        parent::setUp();
        $this->post = factory(Post::class)->state('with_author')->create();
    }

    public function testRedirectToShowPageWhenUpdated()
    {
        $response = $this->actingAs($this->post->author)
                         ->patch(route('posts.update', $this->post), $this->getParams())
        ;

        $response->assertRedirect(route('posts.show', $this->post));
    }

    private function getParams(array $data = []): array
    {
        return array_merge([
            'title' => 'testing title',
            'body' => 'testing body',
        ], $data);
    }

    public function testCanUpdate()
    {
        $data = [
            'title' => 'testing title',
            'body' => 'testing body',
        ];
        $this->actingAs($this->post->author)
             ->patch(route('posts.update', $this->post), $data)
        ;

        $this->assertDatabaseHas('posts', [
            'id' => $this->post->id,
            'title' => 'testing title',
            'body' => 'testing body',
        ]);
    }

    public function testCanNotUpdateWhenLoginUserIsNotAuthor()
    {
        $notAuthor= factory(User::class)->create();
        $response = $this->actingAs($notAuthor)
                         ->patch(route('posts.update', $this->post), $this->getParams())
        ;

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testRedirectToLoginPageWhenUnauthorized()
    {
        $response = $this->patch(route('posts.update', $this->post), $this->getParams());

        $response->assertRedirect(route('login'));
    }

    /**
     * @dataProvider validationDataProvider
     */
    public function testValidation(string $attribute, $value)
    {
        $data = $this->getParams([$attribute => $value]);
        $response = $this->actingAs($this->post->author)
                         ->patch(route('posts.update', $this->post), $data)
        ;

        $response->assertSessionHasErrors($attribute);
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
