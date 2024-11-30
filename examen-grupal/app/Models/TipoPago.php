<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPago extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo_tipo_pago',
        'nombre_tipo_pago',
        'descripcion_tipo_pago',
    ];
}
