<?php

namespace App\Actions\Drivers;

use App\Http\Resources\DriverResource;
use App\Models\Driver;
use Lorisleiva\Actions\Concerns\AsAction;

class Show
{
    use AsAction;

    public function handle(int $id): DriverResource
    {
        $driver = Driver::query()
            ->find($id);

        return new DriverResource($driver);
    }
}
