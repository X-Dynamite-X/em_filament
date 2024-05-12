<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Team::create([
            'name' => 'admin',
            'slug' => 'admin',
        ]);
        Team::create([
            'name' => 'user',
            'slug' => 'user',
        ]);

        
    }
}
