<?php

use App\Http\Controllers\MovieController;

Route::get('/', function () {
    return redirect()->route('movies.index');
});

// Rotas RESTful para Movie
Route::resource('movies', MovieController::class);
