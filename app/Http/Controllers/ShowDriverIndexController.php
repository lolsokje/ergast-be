<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class ShowDriverIndexController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Drivers/Index');
    }
}
