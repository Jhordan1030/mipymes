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
        Schema::create('pais', function (Blueprint $table) {
            $table->id('id'); // Crea un campo idPais como clave primaria (auto incrementable)
            $table->char('codigo_pais', 3); // Código de país de 3 caracteres
            $table->string('nombre_pais', 100); // Nombre del país, hasta 100 caracteres
            $table->timestamps(); // Campos created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pais');
    }
};
