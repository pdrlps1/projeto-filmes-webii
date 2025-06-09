<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('movies', MovieController::class);

Route::get('movies/{movie}/toggle-watched', [MovieController::class, 'toggleWatched'])
    ->name('movies.toggleWatched');
