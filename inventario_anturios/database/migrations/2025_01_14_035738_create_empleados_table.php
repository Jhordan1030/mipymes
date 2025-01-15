<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id('idempleado'); // Clave primaria
            $table->unsignedBigInteger('ididentificacion')->nullable(); // Clave foránea
            $table->char('idbodega',10)->nullable(); // Clave foránea
            $table->unsignedBigInteger('idcargo')->nullable(); // Clave foránea
            $table->integer('idtransaccion')->nullable();
            $table->integer('idtiponota')->nullable();
            $table->string('nombreemp', 10);
            $table->string('apellidoemp', 10);
            $table->string('email', 20);
            $table->string('nro_telefono', 10);
            $table->string('direccionemp', 50);
            $table->string('nro_identificacion', 15)->nullable();
            $table->timestamps();

            // Relaciones con tablas foráneas
            $table->foreign('ididentificacion')->references('ididentificacion')->on('tipoidentificaciones')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('idbodega')->references('idbodega')->on('bodegas')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('idcargo')->references('idcargo')->on('cargos')->onDelete('set null')->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
