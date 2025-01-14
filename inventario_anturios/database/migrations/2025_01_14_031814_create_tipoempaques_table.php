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
        Schema::create('tipoempaques', function (Blueprint $table) {
            $table->id('idtipoempaque'); // Clave primaria autoincremental
            $table->string('nombretipoempaque', 20); // Nombre del tipo de empaque
            $table->string('codigotipoempaque', 5); // Código del tipo de empaque
            $table->timestamps(); // Campos created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipoempaques');
    }
};
