<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    //
    use HasFactory;
    protected $fillable = ['nombre_provincia'];
    public function cantones() 
    { 
        return $this->hasMany(Canton::class); 
    }
}