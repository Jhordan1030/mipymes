<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoNotaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_nota', function (Blueprint $table) {
            $table->id('idtiponota');
            $table->char('tiponota', 10);
            $table->string('responsable', 20);
            $table->date('fechanota');
            $table->string('detalle', 50);
            $table->string('responsableentrega', 20);
            $table->date('fechaentrega');
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
        Schema::dropIfExists('tipo_nota');
    }
}
