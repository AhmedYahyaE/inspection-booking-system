<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('teams')->insert([
            ['name' => 'Demo Team A', 'tenant_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Demo Team B', 'tenant_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Alpha Team A', 'tenant_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Alpha Team B', 'tenant_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Beta Team A', 'tenant_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Beta Team B', 'tenant_id' => 3, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
