<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $table = 'empleados'; // Nombre de la tabla
    protected $primaryKey = 'idempleado'; // Clave primaria personalizada

    protected $fillable = [
        'nombreemp',
        'apellidoemp',
        'email',
        'nro_telefono',
        'direccionemp',
        'ididentificacion',
        'idbodega',
        'idcargo',
        'nro_identificacion',
    ];

    public function tipoIdentificacion()
    {
        return $this->belongsTo(TipoIdentificacion::class, 'ididentificacion', 'ididentificacion');
    }

    public function bodega()
    {
        return $this->belongsTo(Bodega::class, 'idbodega', 'idbodega');
    }

    public function cargo()
    {
        return $this->belongsTo(Cargo::class, 'idcargo', 'idcargo');
    }
}

