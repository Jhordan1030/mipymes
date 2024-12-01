<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoIdentificacion extends Model
{
    use HasFactory;

    // Definimos la tabla si su nombre no sigue la convención
    protected $table = 'tipo_identificacion';

    // Definimos la clave primaria si es distinta de "id"
    protected $primaryKey = 'id_tipo_identificacion';

    // Desactivamos los timestamps si no los necesitamos, o lo dejamos en true si los usamos
    public $timestamps = true;

    // Definimos qué campos son asignables en masa
    protected $fillable = [
        'codigo_tipo_identificacion',
        'nombre_tipo_identificacion',
    ];
}
