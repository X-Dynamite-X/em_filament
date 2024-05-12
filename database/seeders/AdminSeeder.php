<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user = User::factory()->create([
            'name' => 'dynamite',
            'first_name' => 'dynamite',
            'last_name' => 'dynamite',
            'middle_name' => 'dynamite',

            'email' => 'dynamite@gmail.com',
            "password" => "123",
        ]);
        $user->assignRole('admin');


    }
}
