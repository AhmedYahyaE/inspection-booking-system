<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamAvailabilitySeeder extends Seeder
{
    public function run(): void
    {
        foreach (range(1, 6) as $teamId) {
            foreach (range(1, 5) as $day) { // 1=Monday, 5=Friday
                DB::table('team_availabilities')->insert([
                    'team_id' => $teamId,
                    'day_of_week' => $day,
                    'start_time' => '09:00:00',
                    'end_time' => '17:00:00',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
