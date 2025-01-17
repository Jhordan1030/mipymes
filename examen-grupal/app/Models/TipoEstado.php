<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoEstado extends Model
{
    use HasFactory;

    protected $table = 'tipo_estado';

    protected $primaryKey = 'id_estado';

    protected $fillable = ['nombre_estado', 'descripcion_estado'];
}
