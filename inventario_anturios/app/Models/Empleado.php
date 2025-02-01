<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $table = 'empleados';
    protected $primaryKey = 'nro_identificacion';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nombreemp',
        'apellidoemp',
        'email',
        'tipo_identificacion',
        'nro_identificacion',
        'idbodega',
        'codigocargo', // Cambio de idcargo a codigocargo
        'nro_telefono',
        'direccionemp'
    ];

    public function bodega()
    {
        return $this->belongsTo(Bodega::class, 'idbodega', 'idbodega');
    }

    public function cargo()
    {
        return $this->belongsTo(Cargo::class, 'codigocargo', 'codigocargo'); // Cambio en la relación
    }

    public function setNombreempAttribute($value)
    {
        if (!preg_match('/^[a-zA-ZÁÉÍÓÚáéíóúÑñ ]+$/', $value)) {
            throw new \InvalidArgumentException('El nombre solo debe contener letras y espacios.');
        }
        $this->attributes['nombreemp'] = ucfirst(strtolower($value));
    }

    public function setApellidoempAttribute($value)
    {
        if (!preg_match('/^[a-zA-ZÁÉÍÓÚáéíóúÑñ ]+$/', $value)) {
            throw new \InvalidArgumentException('El apellido solo debe contener letras y espacios.');
        }
        $this->attributes['apellidoemp'] = ucfirst(strtolower($value));
    }

    // Eliminamos la relación con tipoIdentificacion ya que ahora se gestiona mediante un campo tipo_identificacion
    // public function tipoIdentificacion()
    // {
    //     return $this->belongsTo(TipoIdentificacion::class, 'ididentificacion', 'ididentificacion');
    // }

}
