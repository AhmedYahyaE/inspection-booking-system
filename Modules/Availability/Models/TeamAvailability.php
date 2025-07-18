<?php

namespace Modules\Availability\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Teams\Models\Team;

class TeamAvailability extends Model
{
    protected $fillable = ['team_id', 'day_of_week', 'start_time', 'end_time'];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
