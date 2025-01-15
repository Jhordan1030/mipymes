<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';
    protected $primaryKey = 'idproducto';

    protected $fillable = [
        'idtipoempaque',
        'nombreprod',
        'descripcionprod',
        'precio',
        'estadodisponibilidad',
        'cantidadmin',
    ];

    // Relación con otra tabla si aplica (por ejemplo, TipoEmpaque)
    public function tipoEmpaque()
    {
        return $this->belongsTo(TipoEmpaque::class, 'idtipoempaque');
    }
}
