<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;
    protected $table = 'proveedor';
    // Los campos que se pueden asignar masivamente
    protected $fillable = ['nombre_proveedor', 'descripcion_proveedor', 'direccion_proveedor', 'telefono_proveedor'];

    public function facturas()
    {
        return $this->hasMany(FacturaCompra::class, 'idproveedor', 'idproveedor');
    }
}
