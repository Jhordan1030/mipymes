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

// 🔹 Ruta para la página de inicio de sesión
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// 🔹 Ruta para procesar el inicio de sesión
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// 🔹 Ruta para cerrar sesión
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 🔹 Grupo de rutas protegidas (Solo usuarios autenticados pueden acceder)
Route::middleware(['auth'])->group(function () {

    // 🔹 Ruta para la vista principal (home)
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    // 🔹 Rutas para los módulos
    Route::resource('producto', ProductoController::class);
    Route::resource('empleado', EmpleadoController::class);
    Route::resource('cargo', CargoController::class);
    Route::resource('tipoidentificacion', TipoIdentificacionController::class);
    Route::resource('bodega', BodegaController::class);
    Route::resource('transaccionProducto', TransaccionProductoController::class);
    Route::resource('tipoempaque', TipoEmpaquesController::class);
    Route::resource('tipoNota', TipoNotaController::class);

    // 🔹 Ruta específica para confirmar una Nota y enviarla a transacciones
    Route::post('/tipoNota/confirmar/{codigo}', [TipoNotaController::class, 'confirmar'])->name('tipoNota.confirmar');
    // Rutas para Transacción Producto

    // Ruta para confirmar una nota y crear una transacción
    Route::post('/tipoNota/confirmar/{codigo}', [TransaccionProductoController::class, 'confirmar'])->name('tipoNota.confirmar');

    // Ruta para finalizar una transacción
    Route::get('/transaccionProducto', [TransaccionProductoController::class, 'index'])->name('transaccionProducto.index');
    Route::post('/transaccionProducto/confirmar/{codigo}', [TransaccionProductoController::class, 'confirmar'])->name('transaccionProducto.confirmar');
    Route::post('/transaccionProducto/finalizar/{id}', [TransaccionProductoController::class, 'finalizar'])->name('transaccionProducto.finalizar');

});

// 🔹 Redirigir la raíz al login si no está autenticado
Route::get('/', function () {
    return redirect()->route('login');
});
