<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $primaryKey = 'resultId';

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

    public function status()
    {
        return $this->belongsTo(Status::class, 'statusId', 'statusId');
    }

    public function finishingPosition()
    {
        if ($this->position) {
            return $this->position;
        } else {
            switch ($this->positionText) {
                case 'R':
                    return 'RETIRED';
                case 'N':
                    return 'NOT CLASSIFIED';
                case 'F':
                    return 'FAILED TO QUALIFY';
                case 'W':
                    return 'WITHDRAWN';
            }
        }
    }
}
