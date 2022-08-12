<?php

namespace App\Models;

use App\Actions\Drivers\Stats;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Driver extends Model
{
    protected $casts = [
        'dob' => 'date:F dS, Y',
    ];

    protected $appends = [
        'full_name',
    ];

    public function fullName(): Attribute
    {
        return Attribute::get(fn () => "$this->given_name $this->surname");
    }

    public function age($getYearOnly = false): Attribute
    {
        // TODO refactor
        $diff = date_diff(date_create($this->dob), date_create('today'));

        if ($getYearOnly) {
            return Attribute::get(fn () => $diff->y);
        }

        $yearText = $diff->y . " years";
        $monthText = $diff->m . " month";
        $dayText = $diff->d . " day";

        $monthText = $diff->m !== 1 ? $monthText . "s" : $monthText;
        $dayText = $diff->y !== 1 ? $dayText . "s" : $dayText;

        return Attribute::get(fn () => "$yearText, $monthText, $dayText");
    }

    public function results(): HasMany
    {
        return $this->hasMany(Result::class, 'driverId');
    }

    public function stats(): Attribute
    {
        return Attribute::get(fn () => Stats::run($this));
    }
}
