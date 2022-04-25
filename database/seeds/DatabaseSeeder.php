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
            'username' => 'admin',
            'password' => '$2a$10$lGHmB7ID8.hGlc7c/9Pg0.O7t/i3w.P8vrf0XKmb03F42mfx/bdSK',
            'status' => 1,
            'created_by' => 1
        ]);
    }
}
