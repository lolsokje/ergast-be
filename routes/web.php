<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\Driver\Index;
use App\Http\Controllers\Driver\Show;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/races', [HomeController::class, 'races'])->name('races');

Route::get('/race/{race}', [HomeController::class, 'raceDetails'])->name('race_details');

Route::get('/seasons', [HomeController::class, 'seasons'])->name('seasons');

Route::get('/seasons/{year}', [HomeController::class, 'showSeason'])->name('show_season');

Route::group(['prefix' => 'drivers', 'as' => 'drivers.'], function () {
    Route::get('', Index::class)->name('index');
    Route::get('{id}', Show::class)->name('show');
});
