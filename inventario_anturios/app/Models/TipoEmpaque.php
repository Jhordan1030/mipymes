<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoEmpaque extends Model
{
    protected $table = 'tipoempaques'; // Nombre de la tabla
    protected $primaryKey = 'idtipoempaque'; // Clave primaria personalizada
    public $incrementing = true; // Autoincremental
    protected $keyType = 'int'; // Tipo de clave primaria

    protected $fillable = [
        'nombretipoempaque',
        'codigotipoempaque',
    ];
}
