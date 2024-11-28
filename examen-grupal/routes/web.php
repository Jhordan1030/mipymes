<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaisController;
Route::get('/', function () {
    return view('welcome');
});
Route::resource('/pais', PaisController::class);