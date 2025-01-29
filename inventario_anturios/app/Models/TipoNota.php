<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoNota extends Model
{
    use HasFactory;

    protected $table = 'tipo_nota';
    protected $primaryKey = 'codigo'; // Usar 'codigo' como clave primaria
    public $incrementing = false; // No es autoincremental
    protected $keyType = 'string'; // Definirlo como string

    protected $fillable = [
        'codigo',
        'tiponota',
        'idempleado',
        'idbodega',
        'fechanota',
    ];

    // Relación con los detalles de la nota
    public function detalles()
    {
        return $this->hasMany(DetalleTipoNota::class, 'tipo_nota_id', 'codigo');
    }

    // Relación con el empleado responsable
    public function responsableEmpleado()
    {
        return $this->belongsTo(Empleado::class, 'idempleado', 'idempleado');
    }

    // Relación con la bodega
    public function bodega()
    {
        return $this->belongsTo(Bodega::class, 'idbodega', 'idbodega');
    }

    // Relación con la transacción producto
    public function transaccionProducto()
    {
        return $this->hasOne(TransaccionProducto::class, 'tipo_nota_id', 'codigo');
    }
}
