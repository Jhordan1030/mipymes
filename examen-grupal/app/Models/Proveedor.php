<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'proveedor'; // Asegura que el nombre de la tabla sea correcto
    protected $primaryKey = 'idproveedor'; // Especifica la clave primaria

    protected $fillable = [
        'nombre_proveedor',
        'descripcion_proveedor',
        'direccion_proveedor',
        'telefono_proveedor',
    ];

    public $timestamps = true; // Laravel gestionará automáticamente los campos 'created_at' y 'updated_at'
}
