<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transacciones_productos', function (Blueprint $table) {
            $table->id('idtransaccion'); // Clave primaria
            $table->string('tipotransaccion', 20); // Tipo de transacción
            $table->integer('cantidad'); // Cantidad
            $table->string('estadodisponibilidad', 10); // Estado de disponibilidad
            $table->string('estadoproducto', 10); // Estado del producto
            $table->timestamps(); // Campos created_at y updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transacciones_productos');
    }
};
