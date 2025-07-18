<?php

namespace Modules\Teams\Controllers;

use Illuminate\Http\Request;
use Modules\Teams\Services\TeamService;
use Modules\Availability\Services\AvailabilityService;
use Illuminate\Support\Facades\Auth;

class TeamController
{
    protected $teams;
    protected $availability;

    public function __construct(TeamService $teams, AvailabilityService $availability)
    {
        $this->teams = $teams;
        $this->availability = $availability;
    }

    public function index(Request $request)
    {
        $tenantId = Auth::user()->tenant_id;
        return response()->json($this->teams->listTeamsForTenant($tenantId));
    }

    public function store(Request $request)
    {
        $tenantId = Auth::user()->tenant_id;
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $data['tenant_id'] = $tenantId;
        $team = $this->teams->createTeam($data);
        return response()->json($team, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $team = $this->teams->updateTeam($id, $data);
        return response()->json($team);
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
        // This will call a SlotGenerationService in a real implementation
        // For now, just return a placeholder
        return response()->json(['slots' => []]);
    }
}
