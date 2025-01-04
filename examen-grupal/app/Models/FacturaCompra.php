<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacturaCompra extends Model
{
    use HasFactory;

    protected $table = 'factura_compra';
    protected $primaryKey = 'idfacturacompra';

    protected $fillable = [
        'idproveedor',
        'fechafacturacompra',
        'codigofacturacompra',
        'totalfacturacompra'
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'idproveedor', 'idproveedor');
    }
}
