<?php

namespace Modules\Teams\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Availability\Resources\TeamAvailabilityResource;

class TeamResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'tenant_id' => $this->tenant_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            // Optionally include relationships
            'availabilities' => TeamAvailabilityResource::collection($this->whenLoaded('availabilities')),
        ];
    }
}
