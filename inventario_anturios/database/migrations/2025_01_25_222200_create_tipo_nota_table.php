<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up()
    {
        Schema::create('tipo_nota', function (Blueprint $table) {
            $table->id('idtiponota'); // Clave primaria autoincremental
            $table->string('codigo', 50)->unique();
            $table->string('tiponota', 10);

            // Asegurar que 'idempleado' tenga el mismo tipo que en 'empleados'
            $table->unsignedBigInteger('idempleado');
            $table->foreign('idempleado')->references('idempleado')->on('empleados')->onDelete('cascade');

            // Cambiar 'idbodega' a string(10) para que coincida con la tabla 'bodegas'
            $table->string('idbodega', 10);
            $table->foreign('idbodega')->references('idbodega')->on('bodegas')->onDelete('cascade');

            $table->date('fechanota')->default(DB::raw('CURRENT_DATE')); // Corrección para usar CURRENT_DATE
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tipo_nota');
    }
};
