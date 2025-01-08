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
        Schema::create('estado_cuentas', function (Blueprint $table) {
            $table->id('idestadocuenta');
            $table->string('nombreestadocuenta');
            $table->string('descripcionestadocuenta');
            $table->timestamps();
            $table->primary('idestadocuenta');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estado_cuenta');
    }
};
