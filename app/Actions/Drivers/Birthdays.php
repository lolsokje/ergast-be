<?php

namespace App\Actions\Drivers;

use App\Driver;
use App\Http\Resources\DriverResource;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Lorisleiva\Actions\Concerns\AsAction;

class Birthdays
{
    use AsAction;

    public function handle(): JsonResponse
    {
        $today = Carbon::now();

        $drivers = Driver::query()
            ->whereMonth('dob', $today->month)
            ->whereDay('dob', $today->day)
            ->orderBy('dob', 'DESC')
            ->get()
            ->append('stats');

        return response()->json(DriverResource::collection($drivers));
    }
}
