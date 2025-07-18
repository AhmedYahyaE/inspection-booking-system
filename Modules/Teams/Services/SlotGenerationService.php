<?php

namespace Modules\Teams\Services;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Modules\Teams\Models\Team;
use Modules\Bookings\Models\Booking;

class SlotGenerationService
{
    /**
     * Generate available 1-hour slots for a team in a date range, excluding booked slots.
     *
     * @param Team $team
     * @param string $from (Y-m-d)
     * @param string $to (Y-m-d)
     * @return array
     */
    public function generateSlots(Team $team, string $from, string $to): array
    {
        $slots = [];
        $period = CarbonPeriod::create($from, $to);
        $availabilities = $team->availabilities()->get();
        $bookings = Booking::where('team_id', $team->id)
            ->whereBetween('date', [$from, $to])
            ->get();

        foreach ($period as $date) {
            $dayOfWeek = $date->dayOfWeek; // 0=Sunday
            foreach ($availabilities->where('day_of_week', $dayOfWeek) as $availability) {
                $start = Carbon::parse($date->toDateString() . ' ' . $availability->start_time);
                $end = Carbon::parse($date->toDateString() . ' ' . $availability->end_time);
                while ($start->copy()->addHour() <= $end) {
                    $slotStart = $start->copy();
                    $slotEnd = $start->copy()->addHour();
                    // Check for booking conflicts
                    $conflict = $bookings->first(function ($booking) use ($slotStart, $slotEnd) {
                        $bookingStart = Carbon::parse($booking->date . ' ' . $booking->start_time);
                        $bookingEnd = Carbon::parse($booking->date . ' ' . $booking->end_time);
                        return $slotStart < $bookingEnd && $slotEnd > $bookingStart;
                    });
                    if (!$conflict) {
                        $slots[] = [
                            'date' => $date->toDateString(),
                            'start_time' => $slotStart->format('H:i'),
                            'end_time' => $slotEnd->format('H:i'),
                        ];
                    }
                    $start->addHour();
                }
            }
        }
        return $slots;
    }
}
