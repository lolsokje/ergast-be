<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class Show extends Controller
{
    public function __invoke(int $id): Response
    {
        return Inertia::render('Drivers/Show', [
            'id' => $id,
        ]);
    }
}
