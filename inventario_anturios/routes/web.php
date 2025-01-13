<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CargoController;

Route::resource('cargo', CargoController::class);
Route::get('/', function () {
    return view('welcome');
});
