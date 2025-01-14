<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\TipoIdentificacionController;
use App\Http\Controllers\BodegaController;
use App\Http\Controllers\TipoEmpaquesController;

Route::resource('cargo', CargoController::class);
Route::resource('tipoidentificacion', TipoIdentificacionController::class);
Route::resource('bodega', BodegaController::class);
Route::resource('tipoempaque', TipoEmpaquesController::class);








Route::get('/', function () {
    return view('welcome');
});
