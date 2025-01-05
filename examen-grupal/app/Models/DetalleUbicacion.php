<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleUbicacion extends Model
{
    use HasFactory;

    protected $table = 'detalle_ubicacion';
    protected $primaryKey = 'iddetalleubicacion';

    protected $fillable = [
        'idubicacion',
        'idproducto',
        'especificacionesdetalleubicacion',
        'fechaingresodetalleproducto'
    ];

    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class, 'idubicacion', 'idubicacion');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'idproducto', 'idproducto');
    }
}
