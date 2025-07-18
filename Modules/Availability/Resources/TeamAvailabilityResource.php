<?php

namespace Modules\Availability\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TeamAvailabilityResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'team_id' => $this->team_id,
            'day_of_week' => $this->day_of_week,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
        ];
    }
}
