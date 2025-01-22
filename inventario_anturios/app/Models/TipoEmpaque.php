<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoEmpaque extends Model
{
    protected $table = 'tipoempaques';
    protected $primaryKey = 'codigotipoempaque'; // Clave primaria personalizada
    public $incrementing = false; // No es auto-incremental
    protected $keyType = 'string'; // Tipo de la clave primaria
    protected $fillable = [
        'nombretipoempaque',
        'codigotipoempaque',
    ];

    // Relación con productos
    public function productos()
    {
        return $this->hasMany(Producto::class, 'codigotipoempaque', 'codigotipoempaque');
    }
}
