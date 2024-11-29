<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('proveedor', function (Blueprint $table) {
            $table->id();  // Esto crea la columna 'id' automáticamente como PRIMARY KEY.
            $table->string('nombre_proveedor');
            $table->string('descripcion_proveedor');
            $table->string('direccion_proveedor');
            $table->string('telefono_proveedor');
            $table->unsignedBigInteger('id_pais');  // Define la relación con la tabla pais
            $table->foreign('id_pais')->references('id')->on('pais')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedor');
    }
};
