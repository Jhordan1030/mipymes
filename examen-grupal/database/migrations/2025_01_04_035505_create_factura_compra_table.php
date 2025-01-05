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
        Schema::create('factura_compra', function (Blueprint $table) {
            $table->id('idfacturacompra');
            $table->unsignedBigInteger('idproveedor')->nullable();
            $table->date('fechafacturacompra');
            $table->string('codigofacturacompra', 250);
            $table->decimal('totalfacturacompra', 10, 2);
            $table->timestamps();
        
            // Relaciones
            $table->foreign('idproveedor')->references('idproveedor')->on('proveedor')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factura_compra');
    }
};
