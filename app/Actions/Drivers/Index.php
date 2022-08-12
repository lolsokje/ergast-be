<?php

namespace App\Actions\Drivers;

use App\Http\Resources\DriverCollection;
use App\Models\Driver;
use Lorisleiva\Actions\Concerns\AsAction;

class Index
{
    use AsAction;

    public function handle(): DriverCollection
    {
        $page = request()->get('page') ?? 1;
        $drivers = Driver::query()
            ->with('raceResults')
            ->orderBy('dob', 'DESC');

        $paginated = $drivers->paginate(perPage: 20, page: $page);

        return new DriverCollection($paginated);
    }
}
