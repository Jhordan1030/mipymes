<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaisController;
use App\Http\Controllers\ProvinciaController;
use App\Http\Controllers\CantonController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\DetalleProductoController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\TipoEmpaqueController;
use App\Http\Controllers\TipoIdentificacionController;
use App\Http\Controllers\TipoClienteController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\TipoPagoController;
use App\Http\Controllers\ParametroController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\TipoEstadoController;
use App\Http\Controllers\UbicacionController;

Route::get('/', function () {
    return view('welcome');
});


Route::resource('/parametro', ParametroController::class);
Route::resource('/tipo_empaque', TipoEmpaqueController::class);
Route::resource('/tipoidentificacion', TipoIdentificacionController::class);
Route::resource('tipocliente', TipoClienteController::class);
Route::resource('/provincia', ProvinciaController::class);
Route::resource('/canton', CantonController::class);
Route::resource('/empleado', EmpleadoController::class);
Route::resource('/cargo',CargoController::class);
Route::resource('/pais', PaisController::class);
Route::resource('/proveedor', ProveedorController::class);
Route::resource('/tpago', TipoPagoController::class);
Route::resource('/producto', ProductoController::class);
Route::resource('/tipo_estado', TipoEstadoController::class);
Route::resource('/detalleproducto', DetalleProductoController::class);

Route::get('/home', function() {
    return view('home', ['nombre' => 'Usuario invitado']);
})->name('home');
