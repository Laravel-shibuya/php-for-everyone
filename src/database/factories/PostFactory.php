<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Domain\Eloquent\Post;
use App\Domain\Eloquent\User;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'body' => $faker->sentence,
    ];
});

$factory->state(Post::class, 'with_author', function (Faker $faker) {
    return [
        'user_id' => factory(User::class)->create()->id,
    ];
});
