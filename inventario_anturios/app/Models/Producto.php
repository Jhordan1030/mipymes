<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos'; // Nombre correcto de la tabla
    protected $primaryKey = 'idproducto'; // Clave primaria personalizada
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'idtipoempaque',
        'nombreprod',
        'descripcionprod',
        'precio',
        'estadodisponibilidad',
        'cantidadmin',
    ];

    // Relación con tipo de empaque
    public function tipoEmpaque()
    {
        return $this->belongsTo(TipoEmpaque::class, 'idtipoempaque', 'idtipoempaque');
    }
}
