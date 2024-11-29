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
        Schema::create('tipo_pago', function (Blueprint $table) {
            $table->id(); 
            $table->string('codigo_tipo_pago')->unique(); 
            $table->string('nombre_tipo_pago'); 
            $table->text('descripcion_tipo_pago')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_pago');
    }
};
