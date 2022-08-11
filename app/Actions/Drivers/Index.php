<?php

namespace App\Actions\Drivers;

use App\Driver;
use App\Http\Resources\DriverCollection;
use Lorisleiva\Actions\Concerns\AsAction;

class Index
{
    use AsAction;

    public function handle(): DriverCollection
    {
        $page = request()->get('page') ?? 1;
        $drivers = Driver::query()
            ->with('results')
            ->orderBy('dob', 'DESC');

        $paginated = $drivers->paginate(perPage: 20, page: $page);

        return new DriverCollection($paginated);
    }
}
