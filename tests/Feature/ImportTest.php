<?php

use App\Constructor;
use App\Driver;
use function PHPUnit\Framework\assertGreaterThan;

it('imports drivers', function () {
    Artisan::call('imports:drivers');

    assertGreaterThan(0, Driver::count());
});

it('imports constructors', function () {
    Artisan::call('imports:constructors');

    assertGreaterThan(0, Constructor::count());
});
