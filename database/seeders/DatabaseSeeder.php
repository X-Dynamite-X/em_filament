<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // $user = User::factory()->create([
        //     'name' => 'dynamite',
        //     'first_name' => 'dynamite',
        //     'last_name' => 'dynamite',
        //     'middle_name' => 'dynamite',

        //     'email' => 'dynamite@gmail.com',
        //     "password" => "123",
        // ]);
        // $user->assignRole('admin');
        $this->call(RoleSeeder::class);
        $this->call(TeamSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(TeamUserSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(StateSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(EmployeeSeeder::class);


    }
}
