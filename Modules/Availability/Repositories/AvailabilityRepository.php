<?php

namespace Modules\Availability\Repositories;

use Modules\Availability\Models\TeamAvailability;

class AvailabilityRepository implements AvailabilityRepositoryInterface
{
    public function allForTeam(int $teamId)
    {
        return TeamAvailability::where('team_id', $teamId)->get();
    }

    public function setAvailability(int $teamId, array $availabilities)
    {
        TeamAvailability::where('team_id', $teamId)->delete();
        foreach ($availabilities as $availability) {
            TeamAvailability::create(array_merge($availability, ['team_id' => $teamId]));
        }
    }
}
