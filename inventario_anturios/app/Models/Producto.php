<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    protected $fillable = ['codigo', 'nombre', 'descripcion', 'cantidad', 'codigotipoempaque'];

    // Relación con TipoEmpaque
    public function tipoEmpaque()
    {
        return $this->belongsTo(TipoEmpaque::class, 'codigotipoempaque', 'codigotipoempaque');
    }
}
