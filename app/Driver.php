<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $primaryKey = 'driverId';

    public function fullName()
    {
        return "{$this->forename} {$this->surname}";
    }

    public function age()
    {
        $diff = date_diff(date_create($this->dob), date_create('today'));

        $yearText = $diff->y . " years";
        $monthText = $diff->m . " month";
        $dayText = $diff->d . " day";

        $monthText = $diff->m !== 1 ? $monthText .= "s" : $monthText;
        $dayText = $diff->y !== 1 ? $dayText .= "s" : $dayText;

        return "{$yearText}, {$monthText}, {$dayText}";
    }

    public function results()
    {
        return $this->hasMany(Result::class, 'driverId');
    }
}
