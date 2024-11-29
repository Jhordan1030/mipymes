<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoEmpaque extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_tipo__empaque';

    protected $table = 'tipo__empaque'; // Nombre de la tabla

    protected $fillable = ['descripcion_tipo__empaque'];

    public $timestamps = false;
}
