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
        'codigoproducto',
        'cantidad',
        'codigotipoempaque',
        'idbodega',
        'fechanota',
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class, 'codigo', 'codigoproducto');
    }

    public function responsableEmpleado()
    {
        return $this->belongsTo(Empleado::class, 'responsable', 'idempleado');
    }

    public function bodega()
    {
        return $this->belongsTo(Bodega::class, 'idbodega', 'idbodega');
    }

    public function tipoEmpaque()
    {
        return $this->belongsTo(TipoEmpaque::class, 'codigotipoempaque', 'codigotipoempaque');
    }

    
}
