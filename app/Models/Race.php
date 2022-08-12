<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Race extends Model
{
    public function circuit(): BelongsTo
    {
        return $this->belongsTo(Circuit::class);
    }

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }

//    public function qualifying()
//    {
//        return $this->hasMany(Qualifying::class, 'raceId');
//    }
//
//    public function results()
//    {
//        return $this->hasMany(Result::class, 'raceId');
//    }
//
//    public function driverStandings()
//    {
//        return $this->hasMany(DriverStanding::class, 'raceId')->orderBy('points', 'DESC');
//    }
//
//    public function constructorStandings()
//    {
//        return $this->hasMany(ConstructorStanding::class, 'raceId')->orderBy('points', 'DESC');
//    }
//
//    public function raceName(bool $upper = true)
//    {
//        $name = $upper ? strtoupper($this->name) : $this->name;
//        return "{$this->year} {$name}";
//    }
}
