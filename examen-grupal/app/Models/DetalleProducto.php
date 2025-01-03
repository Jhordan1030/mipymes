<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleProducto extends Model
{
    use HasFactory;

    protected $primaryKey = 'iddetalleproducto';
    protected $table = 'detalle_producto';

    protected $fillable = [
        'idproducto',
        'especificacionesproducto',
        'preciodetalleproducto',
        'fechaingresodetalleproducto',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'idproducto', 'idproducto');
    }
}
