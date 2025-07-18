<?php

namespace Modules\Availability\Services;

use Modules\Availability\Repositories\AvailabilityRepositoryInterface;

class AvailabilityService
{
    protected $availabilities;

    public function __construct(AvailabilityRepositoryInterface $availabilities)
    {
        $this->availabilities = $availabilities;
    }

    public function getAvailabilityForTeam(int $teamId)
    {
        return $this->availabilities->allForTeam($teamId);
    }

    public function setAvailabilityForTeam(int $teamId, array $availabilities)
    {
        return $this->availabilities->setAvailability($teamId, $availabilities);
    }
}
