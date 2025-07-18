<?php

namespace Modules\Availability\Repositories;

interface AvailabilityRepositoryInterface
{
    public function allForTeam(int $teamId);
    public function setAvailability(int $teamId, array $availabilities);
}
