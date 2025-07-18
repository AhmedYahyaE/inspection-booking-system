<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Modules\Bookings\Services\BookingService;
use Modules\Bookings\Repositories\BookingRepository;
use Modules\Users\Models\User;
use Modules\Teams\Models\Team;
use Modules\Bookings\Models\Booking;

class BookingServiceTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_conflict_detection_returns_true_for_overlapping_booking()
    {
        $service = new BookingService(new BookingRepository());
        $user = User::first();
        $team = Team::where('tenant_id', $user->tenant_id)->first();
        Booking::create([
            'tenant_id' => $user->tenant_id,
            'team_id' => $team->id,
            'user_id' => $user->id,
            'date' => '2025-06-12',
            'start_time' => '10:00:00',
            'end_time' => '11:00:00',
        ]);
        $conflict = $service->hasConflict($team->id, '2025-06-12', '10:30', '11:30');
        $this->assertTrue($conflict);
    }

    public function test_conflict_detection_returns_false_for_non_overlapping_booking()
    {
        $service = new BookingService(new BookingRepository());
        $user = User::first();
        $team = Team::where('tenant_id', $user->tenant_id)->first();
        Booking::create([
            'tenant_id' => $user->tenant_id,
            'team_id' => $team->id,
            'user_id' => $user->id,
            'date' => '2025-06-12',
            'start_time' => '10:00',
            'end_time' => '11:00',
        ]);
        $conflict = $service->hasConflict($team->id, '2025-06-12', '11:00', '12:00');
        $this->assertFalse($conflict);
    }
}
