<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parametro extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'parametro';

    // Llave primaria
    protected $primaryKey = 'id_parametro';

    // Si no usas timestamps
    public $timestamps = true;

    // Atributos asignables masivamente
    protected $fillable = [
        'codigo_parametro', 'nombre_parametro', 'valor_parametro', 'descripcion_parametro'
    ];

    // Definir castings si es necesario
    protected $casts = [
        'valor_parametro' => 'decimal:2',
    ];
}

