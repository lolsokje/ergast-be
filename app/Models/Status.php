<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Status extends Model
{
    public function raceResults(): BelongsToMany
    {
        return $this->belongsToMany(RaceResult::class);
    }

    public function sprintResults(): BelongsToMany
    {
        return $this->belongsToMany(SprintResult::class);
    }
}
