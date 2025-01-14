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
        Schema::create('tipo_empaques', function (Blueprint $table) {
            $table->id('idtipoempaque'); // SERIAL equivale a un campo autoincremental
            $table->unsignedBigInteger('idproducto')->nullable(); // Relación con productos (puede ser NULL)
            $table->string('nombretipoempaque', 20); // Nombre del tipo de empaque
            $table->string('codigotipoempaque', 5); // Código del tipo de empaque
            $table->timestamps(); // Campos created_at y updated_at

             // Clave primaria
             $table->primary('idtipoempaque');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_empaques');
    }
};
