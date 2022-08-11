<?php

use App\Actions\Drivers\Birthdays;
use App\Actions\Drivers\Index;

Route::get('birthdays', Birthdays::class)->name('birthdays');

Route::get('drivers', Index::class)->name('drivers');
