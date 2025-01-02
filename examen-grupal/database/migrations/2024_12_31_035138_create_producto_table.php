<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id('idproducto');
            $table->unsignedBigInteger('id_tipo__empaque')->nullable();
            $table->string('nombreproducto', 254);
            $table->string('descripcionproducto', 254);
            $table->integer('cantidadminimaproducto');
            $table->integer('cantidadmaximaproducto');
            $table->foreign('id_tipo__empaque')->references('id_tipo__empaque')->on('tipo__empaque')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
