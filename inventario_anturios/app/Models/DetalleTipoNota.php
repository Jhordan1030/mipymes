<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleTipoNota extends Model
{
    use HasFactory;

    protected $table = 'detalle_tipo_nota';

    protected $fillable = [
        'tipo_nota_id',
        'codigoproducto',
        'cantidad',
        'codigotipoempaque',
    ];

    public function tipoNota()
    {
        return $this->belongsTo(TipoNota::class, 'tipo_nota_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'codigoproducto', 'codigo');
    }

    public function tipoEmpaque()
    {
        return $this->belongsTo(TipoEmpaque::class, 'codigotipoempaque', 'codigotipoempaque');
    }
}

