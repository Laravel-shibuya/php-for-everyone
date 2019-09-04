<?php
declare(strict_types=1);

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function testCanRegister()
    {
        $this->post(route('register'), [
            'name' => 'test',
            'screen_name' => 'テストユーザー',
            'profile' => 'プロフィール',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'test',
            'screen_name' => 'テストユーザー',
            'profile' => 'プロフィール',
        ]);
    }

    /**
     * @dataProvider validationDataProvider
     */
    public function testValidation(string $attribute, $value, array $expectedMessage)
    {
        $response = $this->post(
            route('register'),
            $this->getParams([$attribute => $value])
        );

        $response->assertSessionHasErrors($attribute, __(...$expectedMessage));
    }

    private function getParams(array $override = []): array
    {
        return array_merge([
            'name' => 'testing_name',
            'screen_name' => 'testing_screen_name',
            'profile' => null,
            'password' => 'password',
            'password_confirmation' => 'password',
        ], $override);
    }

    public function validationDataProvider(): array
    {
        $cases = [];

        // case1 ------------------------------------------
        $attribute = 'name';
        $value = null;
        $message = ['validation.required', ['attribute' => $attribute]];

        $cases['nameは必須'] = [$attribute, $value, $message];

        // case2 ------------------------------------------
        $attribute = 'name';
        $value = str_repeat('x', 256);
        $message = ['validation.max.string', ['attribute' => $attribute, 'max' => 255]];

        $cases['nameは255文字以下であること'] = [$attribute, $value, $message];

        // case3 ------------------------------------------
        $attribute = 'screen_name';
        $value = [];
        $message = ['validation.string', ['attribute' => $attribute]];

        $cases['screen_nameは文字列であること'] = [$attribute, $value, $message];

        // case4 ------------------------------------------
        $attribute = 'screen_name';
        $value = null;
        $message = ['validation.required', ['attribute' => $attribute]];

        $cases['screen_nameは必須'] = [$attribute, $value, $message];

        // case5 ------------------------------------------
        $attribute = 'screen_name';
        $value = str_repeat('x', 256);
        $message = ['validation.max.string', ['attribute' => $attribute, 'max' => 255]];

        $cases['screen_nameは255文字以下であること'] = [$attribute, $value, $message];

        // case6 ------------------------------------------
        $attribute = 'screen_name';
        $value = [];
        $message = ['validation.string', ['attribute' => $attribute]];

        $cases['screen_nameは文字列であること'] = [$attribute, $value, $message];

        // case7 ------------------------------------------
        $attribute = 'password';
        $value = null;
        $message = ['validation.required', ['attribute' => $attribute]];

        $cases['passwordは必須'] = [$attribute, $value, $message];

        // case8 ------------------------------------------
        $attribute = 'password';
        $value = str_repeat('x', 65);
        $message = ['validation.max.string', ['attribute' => $attribute, 'max' => 64]];

        $cases['passwordは64文字以下であること'] = [$attribute, $value, $message];

        // case9 ------------------------------------------
        $attribute = 'password';
        $value = str_repeat('x', 7);
        $message = ['validation.min.string', ['attribute' => $attribute, 'min' => 8]];

        $cases['passwordは8文字以上であること'] = [$attribute, $value, $message];

        // case10 -----------------------------------------
        $attribute = 'password';
        $value = [];
        $message = ['validation.string', ['attribute' => $attribute]];

        $cases['passwordは文字列であること'] = [$attribute, $value, $message];

        // case11 -----------------------------------------
        $attribute = 'password';
        $value = 'does_not_same';
        $message = ['validation.confirmed', ['attribute' => $attribute]];

        $cases['passwordとpassword_confirmationが同じ値であること'] = [$attribute, $value, $message];

        // case12 -----------------------------------------
        $attribute = 'profile';
        $value = [];
        $message = ['validation.string', ['attribute' => $attribute]];

        $cases['profileは文字列であること'] = [$attribute, $value, $message];

        return $cases;
    }
}
