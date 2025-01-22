<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\TipoIdentificacionController;
use App\Http\Controllers\BodegaController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\TransaccionProductoController;
use App\Http\Controllers\TipoEmpaquesController;
use App\Http\Controllers\TipoNotaController;
use App\Http\Controllers\ProductoController;

// Ruta para mostrar la página de inicio de sesión
Route::get('/login', function () {
    return view('auth.login'); // Vista de inicio de sesión
})->name('login');

// Ruta para procesar el inicio de sesión
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Ruta para cerrar sesión
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas protegidas por middleware de autenticación
Route::middleware(['auth'])->group(function () {
    Route::resource('cargo', CargoController::class);
    Route::resource('tipoidentificacion', TipoIdentificacionController::class);
    Route::resource('bodega', BodegaController::class);
    Route::resource('empleado', EmpleadoController::class);
    Route::resource('transaccion_producto', TransaccionProductoController::class);
    Route::resource('tipoempaque', TipoEmpaquesController::class);
    Route::resource('tipoNota', TipoNotaController::class);
    Route::resource('producto', ProductoController::class);
});

// Redirigir la ruta raíz (/) a la página de inicio de sesión
Route::get('/', function () {
    return redirect()->route('login');
});
