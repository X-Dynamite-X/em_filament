<?php

namespace Database\Seeders;

use App\Models\TeamUser;
use Illuminate\Database\Seeder;

class TeamUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        TeamUser::create([
            'team_id' => 1,
            'user_id' => 1,
        ]);
        TeamUser::create([
            'team_id' => 2,
            'user_id' => 1,
        ]);
        TeamUser::create([
            'team_id' => 1,
            'user_id' => 2,
        ]);
        TeamUser::create([
            'team_id' => 1,
            'user_id' => 3,
        ]);
        TeamUser::create([
            'team_id' => 2,
            'user_id' => 4,
        ]);
        TeamUser::create([
            'team_id' => 2,
            'user_id' => 5,
        ]);
    }
}
