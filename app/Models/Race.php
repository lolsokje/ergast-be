<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Race extends Model
{
    protected $casts = [
        'date' => 'date:F dS, Y',
    ];

    public function circuit(): BelongsTo
    {
        return $this->belongsTo(Circuit::class);
    }

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }

    public function qualifingResults(): HasMany
    {
        return $this->hasMany(QualifyingResult::class);
    }

    public function results(): HasMany
    {
        return $this->hasMany(RaceResult::class);
    }

    public function sprintResults(): HasMany
    {
        return $this->hasMany(SprintResult::class);
    }

    public function pitstops(): HasMany
    {
        return $this->hasMany(Pitstop::class);
    }

    public function laptimes(): HasMany
    {
        return $this->hasMany(Laptime::class);
    }

    public function driverStandings(): HasMany
    {
        return $this->hasMany(DriverStanding::class);
    }

    public function constructorStandings(): HasMany
    {
        return $this->hasMany(ConstructorStanding::class);
    }

    public function constructorResults(): HasMany
    {
        return $this->hasMany(ConstructorResult::class);
    }

//
//    public function raceName(bool $upper = true)
//    {
//        $name = $upper ? strtoupper($this->name) : $this->name;
//        return "{$this->year} {$name}";
//    }
}
