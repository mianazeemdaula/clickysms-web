<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            ['name' => 'Admin', 'email' => 'admin@gmail.com', 'password' => bcrypt('12345678'), 'role' => 'admin'],
            ['name' => 'accountant', 'email' => 'accountant@gmail.com', 'password' => bcrypt('password'), 'role' => 'accountant'],
            ['name' => 'User One', 'email' => 'user@gmail.com', 'password' => bcrypt('password'), 'role' => 'user'],
            ['name' => 'User Two', 'email' => 'user2@gmail.com', 'password' => bcrypt('password'), 'role' => 'user'],
        ]);
    }
}
