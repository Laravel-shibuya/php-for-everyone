<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Eloquent\User::class)->create([
            'name' => 'test',
            'screen_name' => 'テストユーザー',
            'password' => bcrypt('password'),
        ]);
    }
}
