<?php

namespace App\Actions\Drivers;

use App\Models\Driver;
use Lorisleiva\Actions\Concerns\AsAction;

class Stats
{
    use AsAction;

    public function handle(Driver $driver)
    {
        $results = $driver->results;

        $entries = $results->count();
        $poles = $results->where('grid', 1)->count();
        $wins = $results->where('position', 1)->count();
        $podiums = $results->whereIn('position', [1, 2, 3])->count();
        $points = $results->sum('points');

        return [
            'entries' => $entries,
            'poles' => $poles,
            'wins' => $wins,
            'podiums' => $podiums,
            'points' => $points,
        ];
    }
}
