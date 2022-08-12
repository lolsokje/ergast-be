<?php

use App\Constructor;
use App\Driver;
use App\Models\Circuit;
use App\Season;
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
