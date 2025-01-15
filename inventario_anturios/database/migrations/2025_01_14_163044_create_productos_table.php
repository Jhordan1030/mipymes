<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
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
            $table->unsignedBigInteger('idtipoempaque')->nullable();
            $table->string('nombreprod', 10);
            $table->string('descripcionprod', 30);
            $table->decimal('precio', 8, 2);
            $table->string('estadodisponibilidad', 10);
            $table->integer('cantidadmin');
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
