<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credito extends Model
{
    use HasFactory;

    protected $table = 'credito';

    protected $fillable = [
        'idcliente',
        'idestadocuenta',
        'valorcredito',
        'fechacredito',
        'idempleadocredito',
        'descripcioncredito',
    ];

    public function cliente()
    {
        //return $this->belongsTo(Cliente::class, 'idcliente');
    }

    public function estadocuenta()
    {
        //return $this->belongsTo(EstadoCuenta::class, 'idestadocuenta');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'idempleadocredito');
    }
}
