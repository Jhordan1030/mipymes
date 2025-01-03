<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $primaryKey = 'idproducto';
    protected $table = 'producto';

    protected $fillable = [
        'id_tipo__empaque',
        'nombreproducto',
        'descripcionproducto',
        'cantidadminimaproducto',
        'cantidadmaximaproducto',
    ];

    public function tipoEmpaque()
    {
        return $this->belongsTo(TipoEmpaque::class, 'id_tipo__empaque', 'id_tipo__empaque');
    }
}
