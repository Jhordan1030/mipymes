<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoNota extends Model
{
    use HasFactory;

    protected $table = 'tipo_nota';
    protected $primaryKey = 'idtiponota';

    protected $fillable = [
        'tiponota',
        'responsable',
        'fechanota',
        'detalle',
        'responsableentrega',
        'fechaentrega',
    ];
}
