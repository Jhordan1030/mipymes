<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParametrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parametro', function (Blueprint $table) {
            $table->id('id_parametro'); // Cambiar SERIAL por id()
            $table->string('codigo_parametro', 10);
            $table->string('nombre_parametro', 100);
            $table->decimal('valor_parametro', 10, 2);
            $table->string('descripcion_parametro', 255)->nullable();
            $table->timestamps(); // Para created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parametro');
    }
}