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

    public function raceName()
    {
        return "{$this->year} {$this->name}";
    }
}
