<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Season extends Model
{
    public function races(): HasMany
    {
        return $this->hasMany(Race::class);
    }
}
