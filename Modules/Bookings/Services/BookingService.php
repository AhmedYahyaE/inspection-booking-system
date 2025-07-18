<?php

namespace Modules\Bookings\Services;

use Modules\Bookings\Repositories\BookingRepositoryInterface;

class BookingService
{
    protected $bookings;

    public function __construct(BookingRepositoryInterface $bookings)
    {
        $this->bookings = $bookings;
    }

    public function listBookingsForTenant(int $tenantId)
    {
        return $this->bookings->allForTenant($tenantId);
    }

    public function createBooking(array $data)
    {
        // Conflict check can be added here
        return $this->bookings->create($data);
    }

    public function updateBooking(int $id, array $data)
    {
        return $this->bookings->update($id, $data);
    }

    public function deleteBooking(int $id)
    {
        return $this->bookings->delete($id);
    }

    public function hasConflict(int $teamId, string $date, string $startTime, string $endTime, ?int $excludeBookingId = null)
    {
        return $this->bookings->findConflictingBooking($teamId, $date, $startTime, $endTime, $excludeBookingId) !== null;
    }
}
