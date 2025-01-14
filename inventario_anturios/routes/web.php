<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\TipoIdentificacionController;

Route::resource('cargo', CargoController::class);
Route::resource('tipoidentificacion', TipoIdentificacionController::class);










Route::get('/', function () {
    return view('welcome');
});
