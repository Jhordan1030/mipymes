<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoEmpaque extends Model
{
    protected $table = 'tipoempaques'; // Nombre correcto de la tabla
    protected $primaryKey = 'idtipoempaque'; // Clave primaria personalizada
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nombretipoempaque',
        'codigotipoempaque',
    ];

    // Relación con productos
    public function productos()
    {
        return $this->hasMany(Producto::class, 'idtipoempaque', 'idtipoempaque');
    }
}
