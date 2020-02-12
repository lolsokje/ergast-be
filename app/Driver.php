<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $primaryKey = 'driverId';

    public function fullName()
    {
        return "{$this->forename} {$this->surname}";
    }
}
