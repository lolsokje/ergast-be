<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Constructor extends Model
{
    public function qualifyingResults(): HasMany
    {
        return $this->hasMany(QualifyingResult::class);
    }

    public function raceResults(): HasMany
    {
        return $this->hasMany(RaceResult::class);
    }

    public function sprintResults(): HasMany
    {
        return $this->hasMany(SprintResult::class);
    }

    public function standings(): HasMany
    {
        return $this->hasMany(ConstructorStanding::class);
    }

    public function results(): HasMany
    {
        return $this->hasMany(ConstructorResult::class);
    }
}
