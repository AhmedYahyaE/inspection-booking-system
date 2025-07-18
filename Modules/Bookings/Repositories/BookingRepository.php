<?php

namespace Modules\Bookings\Repositories;

use Modules\Bookings\Models\Booking;

class BookingRepository implements BookingRepositoryInterface
{
    public function allForTenant(int $tenantId)
    {
        return Booking::forTenant($tenantId)->get();
    }

    public function findForTenant(int $tenantId, int $id)
    {
        return Booking::forTenant($tenantId)->findOrFail($id);
    }

    public function create(array $data)
    {
        return Booking::create($data);
    }

    public function update(int $id, array $data)
    {
        $booking = Booking::findOrFail($id);
        $booking->update($data);
        return $booking;
    }

    public function delete(int $id)
    {
        $booking = Booking::findOrFail($id);
        return $booking->delete();
    }

    public function findConflictingBooking(int $teamId, string $date, string $startTime, string $endTime, ?int $excludeBookingId = null)
    {
        $query = Booking::where('team_id', $teamId)
            ->where('date', $date)
            ->where(function ($q) use ($startTime, $endTime) {
                $q->where(function ($q2) use ($startTime, $endTime) {
                    $q2->where('start_time', '<', $endTime)
                        ->where('end_time', '>', $startTime);
                });
            });
        if ($excludeBookingId) {
            $query->where('id', '!=', $excludeBookingId);
        }
        return $query->first();
    }
}
