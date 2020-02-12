<?php

namespace App\Http\Controllers;

use App\Race;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function calendar(int $year): Renderable
    {
        $races = Race::where('year', $year)->get();

        return view('calendar', [
            'races' => $races,
            'year' => $year
        ]);
    }

    public function raceDetails(Race $race): Renderable
    {
        return view('race-details', ['race' => $race]);
    }
}
