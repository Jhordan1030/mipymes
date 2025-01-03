<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleProductoTable extends Migration
{
    public function up()
    {
        Schema::create('detalle_producto', function (Blueprint $table) {
            $table->id('iddetalleproducto');
            $table->unsignedBigInteger('idproducto')->nullable();
            $table->string('especificacionesproducto', 254);
            $table->decimal('preciodetalleproducto', 10, 2);
            $table->date('fechaingresodetalleproducto');
            $table->timestamps();

            $table->primary('iddetalleproducto');
            $table->foreign('idproducto')->references('idproducto')->on('producto')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('detalle_producto');
    }
}