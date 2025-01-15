<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaccionProducto extends Model
{
    protected $table = 'transacciones_productos';
    protected $primaryKey = 'idtransaccion';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'tipotransaccion',
        'cantidad',
        'estadodisponibilidad',
        'estadoproducto'
    ];
}
