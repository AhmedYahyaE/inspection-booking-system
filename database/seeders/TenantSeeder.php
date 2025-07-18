<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TenantSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tenants')->insert([
            ['name' => 'Demo Tenant', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Alpha Corp', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Beta LLC', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
