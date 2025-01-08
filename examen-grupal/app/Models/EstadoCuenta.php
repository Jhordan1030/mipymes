<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoCuenta extends Model
{
    use HasFactory;

    // Especificar el nombre de la tabla
    protected $table = 'estado_cuentas';

    // Especificar la clave primaria
    protected $primaryKey = 'idestadocuenta';

    // Permitir que la clave primaria no sea incremental (opcional, dependiendo de tu configuración)
    public $incrementing = true;

    // Especificar el tipo de la clave primaria (PostgreSQL usa 'int' para serial)
    protected $keyType = 'int';

    // Campos permitidos para asignación masiva
    protected $fillable = ['nombreestadocuenta', 'descripcionestadocuenta'];
}
