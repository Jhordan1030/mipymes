<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaccionesProductoTable extends Migration
{
    public function up()
    {
        Schema::create('transacciones_producto', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_tipo_nota');
            $table->foreign('codigo_tipo_nota')->references('codigo')->on('tipo_nota')->onDelete('cascade');
            $table->string('codigo_producto');
            $table->foreign('codigo_producto')->references('codigo')->on('productos')->onDelete('cascade');
            $table->string('tipo_empaque');
            $table->integer('cantidad')->unsigned();
            $table->string('bodega_destino');
            $table->foreign('bodega_destino')->references('idbodega')->on('bodegas')->onDelete('cascade');
            $table->unsignedBigInteger('responsable');
            $table->foreign('responsable')->references('idempleado')->on('empleados')->onDelete('cascade');
            $table->timestamp('fecha_entrega')->useCurrent();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transacciones_producto');
    }
}
