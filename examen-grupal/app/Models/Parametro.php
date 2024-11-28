<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parametro extends Model
{
    use HasFactory;
    protected $fillable = ['codigo_parametro', 'nombre_parametro', 'valor_parametro', 'descripcion_parametro'];
}
