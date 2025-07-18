<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Modules\Users\Models\User;
use Modules\Bookings\Models\Booking;
use Modules\Teams\Models\Team;
use Laravel\Sanctum\Sanctum;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_user_can_create_booking()
    {
        $user = User::first();
        Sanctum::actingAs($user);
        $team = Team::where('tenant_id', $user->tenant_id)->first();
        $response = $this->postJson('/api/v1/bookings', [
            'team_id' => $team->id,
            'date' => '2025-06-10',
            'start_time' => '09:00',
            'end_time' => '10:00',
        ]);
        $response->assertStatus(201);
        $this->assertDatabaseHas('bookings', [
            'team_id' => $team->id,
            'date' => '2025-06-10',
            'start_time' => '09:00',
            'end_time' => '10:00',
        ]);
    }

    public function test_booking_conflict_is_prevented()
    {
        $user = User::first();
        Sanctum::actingAs($user);
        $team = Team::where('tenant_id', $user->tenant_id)->first();
        // Create an initial booking
        Booking::create([
            'tenant_id' => $user->tenant_id,
            'team_id' => $team->id,
            'user_id' => $user->id,
            'date' => '2025-06-11',
            'start_time' => '10:00:00',
            'end_time' => '11:00:00',
        ]);
        // Try to create a conflicting booking
        $response = $this->postJson('/api/v1/bookings', [
            'team_id' => $team->id,
            'date' => '2025-06-11',
            'start_time' => '10:30',
            'end_time' => '11:30',
        ]);
        $response->assertStatus(409);
        $response->assertJson(['message' => 'Booking conflict']);
    }
}
