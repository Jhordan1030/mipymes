<?php

use App\Http\Controllers\ParametroController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/parametro', ParametroController::class);
