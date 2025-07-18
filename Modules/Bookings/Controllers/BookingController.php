<?php

namespace Modules\Bookings\Controllers;

use Illuminate\Http\Request;
use Modules\Bookings\Services\BookingService;
use Illuminate\Support\Facades\Auth;
use Modules\Bookings\Resources\BookingResource;
use Modules\Bookings\Resources\BookingCollection;

class BookingController
{
    protected $bookings;

    public function __construct(BookingService $bookings)
    {
        $this->bookings = $bookings;
    }

    public function index(Request $request)
    {
        $tenantId = Auth::user()->tenant_id;
        $bookings = $this->bookings->listBookingsForTenant($tenantId);
        return new BookingCollection($bookings);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'team_id' => 'required|integer|exists:teams,id',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);
        $data['tenant_id'] = Auth::user()->tenant_id;
        $data['user_id'] = Auth::id();
        // Check for conflicts
        if ($this->bookings->hasConflict($data['team_id'], $data['date'], $data['start_time'], $data['end_time'])) {
            return response()->json(['message' => 'Booking conflict'], 409);
        }
        $booking = $this->bookings->createBooking($data);
        return (new BookingResource($booking))->response()->setStatusCode(201);
    }

    public function destroy($id)
    {
        $this->bookings->deleteBooking($id);
        return response()->json(['message' => 'Booking cancelled']);
    }
}
