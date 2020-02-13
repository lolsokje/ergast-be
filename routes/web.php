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

Route::get('/', 'HomeController@index');

Route::get('/races', 'HomeController@races')->name('races');

Route::get('/race/{race}', 'HomeController@raceDetails')->name('race_details');

Route::get('/seasons', 'HomeController@seasons')->name('seasons');

Route::get('/seasons/{year}', 'HomeController@showSeason')->name('show_season');

Route::get('/drivers', 'HomeController@drivers')->name('drivers');

Route::get('/drivers/{driver}', 'HomeController@driverDetails')->name('driver_details');
