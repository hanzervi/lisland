<?php

use Illuminate\Database\Seeder;

use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'username' => '123',
            'password' => '$2a$12$N4Vu9EhyKJxQW.jkvVz8Metk/1dPYcQCT4z/wkgk2xGeK/2tfkeo.',
            'status' => 1,
            'created_by' => 1
        ]);
    }
}
