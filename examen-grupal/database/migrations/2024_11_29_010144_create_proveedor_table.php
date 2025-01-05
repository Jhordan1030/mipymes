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
            $table->id('idproveedor'); // Esto crea la columna 'idproveedor' como PRIMARY KEY.
            $table->string('nombre_proveedor');
            $table->string('descripcion_proveedor')->nullable(); // Permitir valores nulos si corresponde.
            $table->string('direccion_proveedor');
            $table->string('telefono_proveedor');
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
