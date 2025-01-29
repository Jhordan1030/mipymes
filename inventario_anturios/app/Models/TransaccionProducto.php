<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaccionProducto extends Model
{
    use HasFactory;

    protected $table = 'transacciones_producto';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'codigo_tipo_nota',
        'codigo_producto',
        'tipo_empaque',
        'cantidad',
        'bodega_destino',
        'responsable',
        'fecha_entrega',
    ];

    public function tipoNota()
    {
        return $this->belongsTo(TipoNota::class, 'codigo_tipo_nota', 'codigo');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'codigo_producto', 'codigo');
    }

    public function bodega()
    {
        return $this->belongsTo(Bodega::class, 'bodega_destino', 'idbodega');
    }

    public function responsable()
    {
        return $this->belongsTo(Empleado::class, 'responsable', 'idempleado');
    }

    public function tipoEmpaque()
    {
        return $this->belongsTo(TipoEmpaque::class, 'tipo_empaque', 'codigotipoempaque');
    }
}
