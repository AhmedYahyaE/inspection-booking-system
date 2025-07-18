<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            ['name' => 'Admin User 1', 'email' => 'admin1@demo.com', 'password' => Hash::make('12345678'), 'tenant_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Admin User 2', 'email' => 'admin2@demo.com', 'password' => Hash::make('12345678'), 'tenant_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Alpha Admin 1', 'email' => 'admin1@alpha.com', 'password' => Hash::make('12345678'), 'tenant_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Alpha Admin 2', 'email' => 'admin2@alpha.com', 'password' => Hash::make('12345678'), 'tenant_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Beta Admin 1', 'email' => 'admin1@beta.com', 'password' => Hash::make('12345678'), 'tenant_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Beta Admin 2', 'email' => 'admin2@beta.com', 'password' => Hash::make('12345678'), 'tenant_id' => 3, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
