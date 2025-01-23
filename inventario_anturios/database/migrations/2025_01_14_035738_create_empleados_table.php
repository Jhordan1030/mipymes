<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
       Schema::create('empleados', function (Blueprint $table) {
           $table->id('idempleado');
           $table->string('nombreemp');
           $table->string('apellidoemp');
           $table->string('email')->unique();
           $table->string('nro_telefono');
           $table->string('direccionemp');
           $table->string('idbodega'); // Cambia a string para que coincida con la tabla bodegas
           $table->unsignedBigInteger('ididentificacion');
           $table->unsignedBigInteger('idcargo');
           $table->string('nro_identificacion')->unique();
           $table->timestamps();

           $table->foreign('idbodega')->references('idbodega')->on('bodegas');
           $table->foreign('ididentificacion')->references('ididentificacion')->on('tipoidentificaciones');
           $table->foreign('idcargo')->references('idcargo')->on('cargos');
       });

    }

    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
