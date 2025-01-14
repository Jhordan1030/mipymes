<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\TipoIdentificacionController;
use App\Http\Controllers\BodegaController;

Route::resource('cargo', CargoController::class);
Route::resource('tipoidentificacion', TipoIdentificacionController::class);
Route::resource('bodega', BodegaController::class);








Route::get('/', function () {
    return view('welcome');
});
