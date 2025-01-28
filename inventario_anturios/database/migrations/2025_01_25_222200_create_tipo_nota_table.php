<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoNotaTable extends Migration
{
    public function up()
    {
        Schema::create('tipo_nota', function (Blueprint $table) {
            $table->id('idtiponota');
            $table->char('tiponota', 10);
            $table->unsignedBigInteger('idempleado');
            $table->foreign('idempleado')->references('idempleado')->on('empleados')->onDelete('cascade');
            $table->string('codigoproducto', 10);
            $table->foreign('codigoproducto')->references('codigo')->on('productos')->onDelete('cascade');
            $table->integer('cantidad');
            $table->string('codigotipoempaque')->nullable();
            $table->foreign('codigotipoempaque')->references('codigotipoempaque')->on('tipoempaques')->onDelete('set null');
            $table->string('idbodega', 10);
            $table->foreign('idbodega')->references('idbodega')->on('bodegas')->onDelete('cascade');
            $table->date('fechanota')->useCurrent();  
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tipo_nota');
    }
}
