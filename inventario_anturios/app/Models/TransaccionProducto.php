<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaccionProducto extends Model
{
    protected $table = 'transacciones_productos';
    protected $primaryKey = 'idtransaccion';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'tipotransaccion',
        'codigoproducto',
        'cantidad',
        'idbodega',
        'idempleado',
    ];

    // Relación con productos
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'codigoproducto', 'codigo');
    }

    // Relación con bodegas
    public function bodega()
    {
        return $this->belongsTo(Bodega::class, 'idbodega', 'idbodega');
    }

    // Relación con empleados
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'idempleado', 'idempleado');
    }
}
