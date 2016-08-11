<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where all API routes are defined.
|
*/



Route::resource('tracks', 'tracksAPIController');

Route::resource('albums', 'albumsAPIController');

Route::resource('artists', 'artistsAPIController');