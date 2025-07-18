<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('bookings')->insert([
            // Demo Team A (tenant 1, team 1, user 1)
            ['tenant_id' => 1, 'team_id' => 1, 'user_id' => 1, 'date' => '2025-06-02', 'start_time' => '10:00:00', 'end_time' => '11:00:00', 'created_at' => now(), 'updated_at' => now()],
            // Demo Team B (tenant 1, team 2, user 2)
            ['tenant_id' => 1, 'team_id' => 2, 'user_id' => 2, 'date' => '2025-06-03', 'start_time' => '13:00:00', 'end_time' => '14:00:00', 'created_at' => now(), 'updated_at' => now()],
            // Alpha Team A (tenant 2, team 3, user 3)
            ['tenant_id' => 2, 'team_id' => 3, 'user_id' => 3, 'date' => '2025-06-04', 'start_time' => '09:00:00', 'end_time' => '10:00:00', 'created_at' => now(), 'updated_at' => now()],
            // Alpha Team B (tenant 2, team 4, user 4)
            ['tenant_id' => 2, 'team_id' => 4, 'user_id' => 4, 'date' => '2025-06-05', 'start_time' => '15:00:00', 'end_time' => '16:00:00', 'created_at' => now(), 'updated_at' => now()],
            // Beta Team A (tenant 3, team 5, user 5)
            ['tenant_id' => 3, 'team_id' => 5, 'user_id' => 5, 'date' => '2025-06-06', 'start_time' => '11:00:00', 'end_time' => '12:00:00', 'created_at' => now(), 'updated_at' => now()],
            // Beta Team B (tenant 3, team 6, user 6)
            ['tenant_id' => 3, 'team_id' => 6, 'user_id' => 6, 'date' => '2025-06-07', 'start_time' => '14:00:00', 'end_time' => '15:00:00', 'created_at' => now(), 'updated_at' => now()],
            // Overlapping booking for Demo Team A (user 1)
            ['tenant_id' => 1, 'team_id' => 1, 'user_id' => 1, 'date' => '2025-06-02', 'start_time' => '10:30:00', 'end_time' => '11:30:00', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
