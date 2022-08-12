<?php

use App\Models\Circuit;
use App\Models\Constructor;
use App\Models\ConstructorResult;
use App\Models\ConstructorStanding;
use App\Models\Driver;
use App\Models\DriverStanding;
use App\Models\Pitstop;
use App\Models\QualifyingResult;
use App\Models\Race;
use App\Models\RaceResult;
use App\Models\Season;
use App\Models\SprintResult;
use App\Models\Status;
use function PHPUnit\Framework\assertGreaterThan;

it('imports drivers', function () {
    Artisan::call('imports:drivers');

    assertGreaterThan(0, Driver::count());
});

it('imports constructors', function () {
    Artisan::call('imports:constructors');

    assertGreaterThan(0, Constructor::count());
});

it('imports seasons', function () {
    Artisan::call('imports:seasons');

    assertGreaterThan(0, Season::count());
});

it('imports circuits', function () {
    Artisan::call('imports:circuits');

    assertGreaterThan(0, Circuit::count());
});

it('imports statuses', function () {
    Artisan::call('imports:statuses');

    assertGreaterThan(0, Status::count());
});

it('imports races', function () {
    callPrerequisiteActions(['seasons', 'circuits']);
    Artisan::call('imports:races');

    assertGreaterThan(0, Race::count());
});

it('imports qualifying results', function () {
    callPrerequisiteActions(['seasons', 'circuits', 'races', 'drivers', 'constructors']);
    Artisan::call('imports:qualifying_results');

    assertGreaterThan(0, QualifyingResult::count());
});

it('imports race results', function () {
    callPrerequisiteActions(['seasons', 'circuits', 'races', 'drivers', 'constructors', 'statuses']);
    Artisan::call('imports:race_results');

    assertGreaterThan(0, RaceResult::count());
});

it('imports sprint results', function () {
    callPrerequisiteActions(['seasons', 'circuits', 'races', 'drivers', 'constructors', 'statuses']);
    Artisan::call('imports:sprint_results');

    assertGreaterThan(0, SprintResult::count());
});

it('imports pitstops', function () {
    callPrerequisiteActions(['seasons', 'circuits', 'races', 'drivers', 'constructors']);
    Artisan::call('imports:pitstops');

    assertGreaterThan(0, Pitstop::count());
});

it('imports driver standings', function () {
    callPrerequisiteActions(['seasons', 'circuits', 'races', 'drivers', 'constructors']);
    Artisan::call('imports:driver_standings');

    assertGreaterThan(0, DriverStanding::count());
});

it('imports constructor standings', function () {
    callPrerequisiteActions(['seasons', 'circuits', 'races', 'drivers', 'constructors']);
    Artisan::call('imports:constructor_standings');

    assertGreaterThan(0, ConstructorStanding::count());
});

it('imports constructor results', function () {
    callPrerequisiteActions(['seasons', 'circuits', 'races', 'drivers', 'constructors']);
    Artisan::call('imports:constructor_results');

    assertGreaterThan(0, ConstructorResult::count());
});

function callPrerequisiteActions(array $actions): void
{
    foreach ($actions as $action) {
        Artisan::call("imports:$action");
    }
}
