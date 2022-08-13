<?php

use App\Actions\Drivers\Birthdays;
use App\Actions\Drivers\Index;
use App\Actions\Drivers\Races;
use App\Actions\Drivers\Show;

Route::group(['as' => 'api.'], function () {
    Route::group(['prefix' => 'drivers', 'as' => 'drivers.'], function () {
        Route::get('', Index::class)->name('drivers');

        Route::get('birthdays', Birthdays::class)->name('birthdays');

        Route::get('{id}', Show::class)->name('show');
        Route::get('{id}/races', Races::class)->name('races');
    });
});
