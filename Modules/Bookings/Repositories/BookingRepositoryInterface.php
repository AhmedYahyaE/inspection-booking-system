<?php

namespace Modules\Bookings\Repositories;

interface BookingRepositoryInterface
{
    public function allForTenant(int $tenantId);
    public function findForTenant(int $tenantId, int $id);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
    public function findConflictingBooking(int $teamId, string $date, string $startTime, string $endTime, ?int $excludeBookingId = null);
}
