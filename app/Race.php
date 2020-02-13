<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    protected $primaryKey = 'raceId';

    public function qualifying()
    {
        return $this->hasMany(Qualifying::class, 'raceId');
    }

    public function results()
    {
        return $this->hasMany(Result::class, 'raceId');
    }

    public function driverStandings()
    {
        return $this->hasMany(DriverStanding::class, 'raceId')->orderBy('points', 'DESC');
    }

    public function constructorStandings()
    {
        return $this->hasMany(ConstructorStanding::class, 'raceId')->orderBy('points', 'DESC');
    }

    public function raceName(bool $upper = true)
    {
        $name = $upper ? strtoupper($this->name) : $this->name;
        return "{$this->year} {$name}";
    }
}
