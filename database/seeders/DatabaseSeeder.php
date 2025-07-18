<?php

namespace Database\Seeders;

use Modules\Users\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            TenantSeeder::class,
            UserSeeder::class,
            TeamSeeder::class,
            TeamAvailabilitySeeder::class,
            BookingSeeder::class,
        ]);
    }
}
