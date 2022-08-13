<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class Index extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Drivers/Index');
    }
}
