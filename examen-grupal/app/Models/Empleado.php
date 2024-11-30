<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    //
    use HasFactory;
    protected $fillable = ['cedula_empleado','nombre_empleado','apellidos_empleado','direccion_empleado','telefono_empleado'];

}
