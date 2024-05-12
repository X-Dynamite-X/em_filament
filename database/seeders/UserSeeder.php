<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $user = User::create([
            'name' => 'user1',
            'first_name' => 'user',
            'last_name' => 'user',
            'middle_name' => 'user',
            'email' => 'user@gmail.com',
            "password" => "123",
        ]);
        $user->assignRole('user');
        $user = User::create([
            'name' => 'user2',
            'first_name' => 'user2',
            'last_name' => 'user2',
            'middle_name' => 'user2',
            'email' => 'user2@gmail.com',
            "password" => "123",
        ]);
        $user->assignRole('user');
        $user = User::create([
            'name' => 'user3',
            'first_name' => 'user3',
            'last_name' => 'user3',
            'middle_name' => 'user3',
            'email' => 'user3@gmail.com',
            "password" => "123",
        ]);
        $user->assignRole('user');
        $user = User::create([
            'name' => 'user4',
            'first_name' => 'user4',
            'last_name' => 'user4',
            'middle_name' => 'user4',
            'email' => 'user4@gmail.com',
            "password" => "123",
        ]);
        $user->assignRole('user');
    }
}
