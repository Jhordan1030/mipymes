<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoNota extends Model
{
    use HasFactory;

    protected $table = 'tipo_nota';
    protected $primaryKey = 'idtiponota';

    protected $fillable = [
        'codigo',
        'tiponota',
        'idempleado',
        'idbodega',
        'fechanota',
    ];

    public function detalles()
    {
        return $this->hasMany(DetalleTipoNota::class, 'tipo_nota_id');
    }

    public function responsableEmpleado()
    {
        return $this->belongsTo(Empleado::class, 'idempleado', 'idempleado');
    }

    public function bodega()
    {
        return $this->belongsTo(Bodega::class, 'idbodega', 'idbodega');
    }
}

