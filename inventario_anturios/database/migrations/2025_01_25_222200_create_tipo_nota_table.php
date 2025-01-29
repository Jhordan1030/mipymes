<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up()
    {
        Schema::create('tipo_nota', function (Blueprint $table) {
            // Convertimos 'codigo' en la clave primaria
            $table->string('codigo', 50)->primary();

            $table->string('tiponota', 10);

            // Asegurar que 'idempleado' tenga el mismo tipo que en 'empleados'
            $table->unsignedBigInteger('idempleado');
            $table->foreign('idempleado')->references('idempleado')->on('empleados')->onDelete('cascade');

            // 'idbodega' como string(10) para coincidir con la tabla 'bodegas'
            $table->string('idbodega', 10);
            $table->foreign('idbodega')->references('idbodega')->on('bodegas')->onDelete('cascade');

            $table->date('fechanota')->default(DB::raw('CURRENT_DATE'));
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tipo_nota');
    }
};
