<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\TipoIdentificacionController;
use App\Http\Controllers\BodegaController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\TransaccionProductoController;
use App\Http\Controllers\TipoEmpaquesController;
use App\Http\Controllers\TipoNotaController;
use App\Http\Controllers\ProductoController;

Route::resource('cargo', CargoController::class);
Route::resource('tipoidentificacion', TipoIdentificacionController::class);
Route::resource('bodega', BodegaController::class);
Route::resource('empleado', EmpleadoController::class);
Route::resource('transaccion_producto', TransaccionProductoController::class);



Route::resource('tipoempaque', TipoEmpaquesController::class);
Route::resource('tipoNota', TipoNotaController::class);
Route::resource('producto', ProductoController::class);


Route::get('/', function () {
    return view('welcome');
});
