<?php

use App\Http\Controllers\ParametroController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaisController;
Route::get('/', function () {
    return view('welcome');
});

Route::resource('/parametro', ParametroController::class);
Route::resource('/pais', PaisController::class);
