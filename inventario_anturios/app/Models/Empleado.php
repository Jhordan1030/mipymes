<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = 'empleados';
    protected $primaryKey = 'idempleado';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'ididentificacion',
        'idbodega',
        'idcargo',
        'idtransaccion',
        'idtiponota',
        'nombreemp',
        'apellidoemp',
        'email',
        'nro_telefono',
        'direccionemp',
        'nro_identificacion'
    ];

    // Relaciones
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
