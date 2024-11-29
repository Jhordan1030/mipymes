<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parametro extends Model
{
    use HasFactory;

    protected $table = 'parametro';

    protected $primaryKey = 'id_parametro';

    public $timestamps = true;

    protected $fillable = [
        'codigo_parametro', 'nombre_parametro', 'valor_parametro', 'descripcion_parametro'
    ];

    // Definir castings si es necesario
    protected $casts = [
        'valor_parametro' => 'decimal:2',
    ];
}

