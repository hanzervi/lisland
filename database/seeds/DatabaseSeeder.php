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
            'name' => 'Hanz',
            'username' => 'hanzervi',
            'password' => '$2y$12$rXoBo/eorWMOqQ10QJiGkeDdPr1L82w/1/cot01M3m3OSa6sS/UYO',
            'status' => 1,
            'created_by' => 1
        ]);
    }
}
