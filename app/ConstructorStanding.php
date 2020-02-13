<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConstructorStanding extends Model
{
    protected $primaryKey = 'constructorStandingsId';

    protected $table = 'constructorStandings';

    public function race()
    {
        return $this->belongsTo(Race::class, 'raceId');
    }

    public function constructor()
    {
        return $this->belongsTo(Constructor::class, 'constructorId');
    }
}
