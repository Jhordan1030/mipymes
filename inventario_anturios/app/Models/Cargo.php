<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;

    protected $table = 'cargos'; 
    protected $primaryKey = 'codigocargo'; 
    public $incrementing = false;  
    protected $keyType = 'string';  

    protected $fillable = [
        'codigocargo',  
        'nombrecargo',
    ];

    public function setNombrecargoAttribute($value)
    {
        if (!preg_match('/^[A-Za-zÁÉÍÓÚáéíóúÑñ ]+$/', $value)) {
            throw new \InvalidArgumentException('El nombre del cargo solo puede contener letras y espacios.');
        }
        $this->attributes['nombrecargo'] = ucfirst(strtolower($value)); 
    }
}

