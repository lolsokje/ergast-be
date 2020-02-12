<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qualifying extends Model
{
    protected $primaryKey = 'qualifyId';
    protected $table = 'qualifying';

    public function race()
    {
        return $this->belongsTo(Race::class, 'raceId');
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driverId');
    }

    public function constructor()
    {
        return $this->belongsTo(Constructor::class, 'constructorId');
    }
}
