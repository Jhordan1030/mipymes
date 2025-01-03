<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    use HasFactory;

    protected $table = 'ubicacion'; // Si la tabla se llama 'ubicacion' y no 'ubicaciones'.

    protected $primaryKey = 'idubicacion'; // Define explícitamente la clave primaria.

    protected $fillable = [
        'nombreUbicacion',
        'descripcionUbicacion',
    ];
}