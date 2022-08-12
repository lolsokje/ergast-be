<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Race;
use App\Models\Result;
use App\Models\Season;
use Illuminate\Contracts\Support\Renderable;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * @return Renderable
     */
    public function index()
    {
        return Inertia::render('Index');
    }

    /**
     * @return Renderable
     */
    public function races(): Renderable
    {
        $races = Race::orderBy('year', 'DESC')->orderBy('round', 'DESC')->paginate(25);

        return view('races', ['races' => $races]);
    }

    /**
     * @param Race $race
     * @return Renderable
     */
    public function raceDetails(Race $race): Renderable
    {
        return view('race-details', ['race' => $race]);
    }

    /**
     * @return Renderable
     */
    public function seasons(): Renderable
    {
        return view('seasons', ['seasons' => Season::orderBy('year', 'DESC')->get()]);
    }

    /**
     * @param int $year
     * @return Renderable
     */
    public function showSeason(int $year): Renderable
    {
        $races = Race::where('year', $year)->get();

        return view('calendar', [
            'races' => $races,
            'year' => $year,
        ]);
    }

    /**
     * @return Renderable
     */
    public function drivers(): Renderable
    {
        $drivers = Driver::orderBy('dob', 'DESC')->paginate(25);
        $today = date('Y-m-d');

        $birthdays = Driver::whereRaw("DAY(dob) = DAY('{$today}') AND MONTH(dob) = MONTH('{$today}')")->get();

        return view('drivers', [
            'drivers' => $drivers,
            'birthdays' => $birthdays,
        ]);
    }

    /**
     * @param Driver $driver
     * @return Renderable
     */
    public function driverDetails(Driver $driver): Renderable
    {
        $results = Result::where('driverId', $driver->driverId)
            ->join('races', 'races.raceId', '=', 'results.raceId')
            ->orderBy('races.year', 'DESC')
            ->orderBy('races.round', 'DESC')
            ->paginate(20);

        return view('driver-details', [
            'driver' => $driver,
            'results' => $results,
        ]);
    }
}
