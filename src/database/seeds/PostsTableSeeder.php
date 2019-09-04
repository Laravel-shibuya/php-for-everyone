<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var \Illuminate\Support\Collection $users */
        $users = factory(\App\Eloquent\User::class)->times(5)->create();
        $ids = $users->pluck('id');

        $body = <<<TEXT
Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
TEXT;

        $times = 50;
        while ($times--) {
            factory(\App\Eloquent\Post::class)->create([
                'user_id' => $ids->random(),
                'body' => $body,
            ]);
        }
    }
}
