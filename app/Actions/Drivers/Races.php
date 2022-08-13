<?php

namespace App\Actions\Drivers;

use App\Http\Resources\DriverRaceCollection;
use App\Models\RaceResult;
use Lorisleiva\Actions\Concerns\AsAction;

class Races
{
    use AsAction;

    public function handle(int $id): DriverRaceCollection
    {
        $results = RaceResult::query()
            ->where('driver_id', $id)
            ->with('race', 'constructor', 'status')
            ->paginate(perPage: 20, page: request()->get('page') ?? 1);

        return new DriverRaceCollection($results);
    }
}
