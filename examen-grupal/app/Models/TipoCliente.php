<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoCliente extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_tipo_Cliente';
    public $incrementing = true;

    protected $keyType = 'int'; 
    // Si la tabla no sigue la convención de nombres, puedes especificarla manualmente
    protected $table = 'tipo_clientes';


    // Los campos que son asignables masivamente
    protected $fillable = [
        'codigo_tipo_Cliente',
        'descripcion_tipo_Cliente',
    ];
    public $timestamps = true;

}
