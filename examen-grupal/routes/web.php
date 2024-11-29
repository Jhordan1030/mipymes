<?php

use App\Http\Controllers\ParametroController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaisController;
use App\Http\Controllers\ProvinciaController;
use App\Http\Controllers\CantonController;
use App\Http\Controllers\TipoEmpaqueController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\TipoPagoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('home',function(){ 
    return view('home',['nombre'=>'Usuario invitado']);
});

Route::resource('/parametro', ParametroController::class);
Route::resource('/pais', PaisController::class);
Route::view('/provincia', ProvinciaController::class);
Route::resource('/canton',CantonController::class);
Route::resource('/tipo_empaque', TipoEmpaqueController::class);
Route::resource('/proveedor', ProveedorController::class);
Route::resource('/tpago', TipoPagoController::class);