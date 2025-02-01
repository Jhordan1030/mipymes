<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoNota extends Model
{
    use HasFactory;

    protected $table = 'tipo_nota';
    protected $primaryKey = 'codigo'; // Clave primaria manual
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'codigo',
        'tiponota',
        'nro_identificacion',
        'idbodega',
        'fechanota',
    ];

    /**
     * Relación con los detalles de la nota.
     */
    public function detalles()
    {
        return $this->hasMany(DetalleTipoNota::class, 'tipo_nota_id', 'codigo');
    }

    /**
     * Relación con el empleado responsable.
     */
    public function responsableEmpleado()
    {
        return $this->belongsTo(Empleado::class, 'nro_identificacion', 'nro_identificacion');
    }

    /**
     * Relación con la bodega.
     */
    public function bodega()
    {
        return $this->belongsTo(Bodega::class, 'idbodega', 'idbodega');
    }

    /**
     * 🔹 Relación con TransaccionProducto a través de detalle_tipo_nota
     */
    public function transaccion()
    {
        return $this->hasOne(TransaccionProducto::class, 'tipo_nota_id', 'codigo');
    }
}
