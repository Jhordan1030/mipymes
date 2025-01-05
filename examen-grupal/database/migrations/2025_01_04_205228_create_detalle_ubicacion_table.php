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
        Schema::create('detalle_ubicacion', function (Blueprint $table) {
            $table->id('iddetalleubicacion');
            $table->unsignedBigInteger('idubicacion')->nullable();
            $table->unsignedBigInteger('idproducto')->nullable();
            $table->string('especificacionesdetalleubicacion', 254);
            $table->date('fechaingresodetalleproducto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_ubicacion');
    }
};
