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
        Schema::create('credito', function (Blueprint $table) {
            $table->id('idcredito');
            $table->unsignedBigInteger('idcliente')->nullable();
            $table->unsignedBigInteger('idestadocuenta')->nullable();
            $table->decimal('valorcredito', 15, 2);
            $table->date('fechacredito');
            $table->unsignedBigInteger('idempleadocredito');
            $table->string('descripcioncredito', 254);
            $table->timestamps();

            // Relaciones
            $table->foreign('idcliente')
                  ->references('id')->on('clientes')
                  ->onDelete('set null')
                  ->onUpdate('cascade');

            $table->foreign('idestadocuenta')
                  ->references('id')->on('estadocuenta')
                  ->onDelete('set null')
                  ->onUpdate('cascade');

            $table->foreign('idempleadocredito')
                  ->references('id')->on('empleados')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credito');
    }
};
