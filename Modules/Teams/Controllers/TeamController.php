<?php

namespace Modules\Teams\Controllers;

use Illuminate\Http\Request;
use Modules\Teams\Services\TeamService;
use Modules\Availability\Services\AvailabilityService;
use Illuminate\Support\Facades\Auth;
use Modules\Teams\Resources\TeamResource;
use Modules\Teams\Resources\TeamCollection;
use Modules\Teams\Services\SlotGenerationService;

class TeamController
{
    protected $teams;
    protected $availability;
    protected $slotGenerator;

    public function __construct(TeamService $teams, AvailabilityService $availability, SlotGenerationService $slotGenerator)
    {
        $this->teams = $teams;
        $this->availability = $availability;
        $this->slotGenerator = $slotGenerator;
    }

    public function index(Request $request)
    {
        $tenantId = Auth::user()->tenant_id;
        $teams = $this->teams->listTeamsForTenant($tenantId);
        return new TeamCollection($teams);
    }

    public function store(Request $request)
    {
        $tenantId = Auth::user()->tenant_id;
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $data['tenant_id'] = $tenantId;
        $team = $this->teams->createTeam($data);
        return (new TeamResource($team))->response()->setStatusCode(201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $team = $this->teams->updateTeam($id, $data);
        return new TeamResource($team);
    }

    public function destroy($id)
    {
        $this->teams->deleteTeam($id);
        return response()->json(['message' => 'Deleted']);
    }

    public function setAvailability(Request $request, $id)
    {
        $availabilities = $request->validate([
            'availabilities' => 'required|array',
            'availabilities.*.day_of_week' => 'required|integer|min:0|max:6',
            'availabilities.*.start_time' => 'required|date_format:H:i',
            'availabilities.*.end_time' => 'required|date_format:H:i|after:availabilities.*.start_time',
        ]);
        $this->availability->setAvailabilityForTeam($id, $availabilities['availabilities']);
        return response()->json(['message' => 'Availability set']);
    }

    public function generateSlots(Request $request, $id)
    {
        $from = $request->query('from');
        $to = $request->query('to');
        if (!$from || !$to) {
            return response()->json(['message' => 'from and to query parameters are required'], 422);
        }
        $tenantId = Auth::user()->tenant_id;
        $team = $this->teams->findForTenant($tenantId, $id);
        $slots = $this->slotGenerator->generateSlots($team, $from, $to);
        return response()->json(['slots' => $slots]);
    }
}
