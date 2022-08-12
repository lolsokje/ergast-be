<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DriverStanding extends Model
{
    protected $primaryKey = 'driverStandingsId';

    protected $table = 'driverStandings';

    public function race()
    {
        return $this->belongsTo(Race::class, 'raceId');
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driverId');
    }
}
