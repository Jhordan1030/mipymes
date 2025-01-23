<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\TipoIdentificacionController;
use App\Http\Controllers\BodegaController;
use App\Http\Controllers\TransaccionProductoController;
use App\Http\Controllers\TipoEmpaquesController;
use App\Http\Controllers\TipoNotaController;

// Ruta para la página de inicio de sesión
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Ruta para procesar el inicio de sesión
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Ruta para cerrar sesión
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Grupo de rutas protegidas (Solo usuarios autenticados pueden acceder)
Route::middleware(['auth'])->group(function () {

    // Ruta para la vista principal (home)
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    // Rutas para el módulo de productos
    Route::resource('producto', ProductoController::class);

    // Rutas para el módulo de empleados
    Route::resource('empleado', EmpleadoController::class);

    // Rutas para otros módulos
    Route::resource('cargo', CargoController::class);
    Route::resource('tipoidentificacion', TipoIdentificacionController::class);
    Route::resource('bodega', BodegaController::class);
    Route::resource('transaccion_producto', TransaccionProductoController::class);
    Route::resource('tipoempaque', TipoEmpaquesController::class);
    Route::resource('tipoNota', TipoNotaController::class);
});

// Redirigir la raíz al login
Route::get('/', function () {
    return redirect()->route('login');
});