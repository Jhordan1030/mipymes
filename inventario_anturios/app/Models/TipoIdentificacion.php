<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoIdentificacion extends Model
{
    protected $table = 'tipoidentificaciones';
    protected $primaryKey = 'ididentificacion'; // Clave primaria personalizada
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = ['nombreidentificacion']; // Campos asignables
}
