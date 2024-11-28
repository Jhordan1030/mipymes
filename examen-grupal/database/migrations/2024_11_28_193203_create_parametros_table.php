<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParametroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parametro', function (Blueprint $table) {
            $table->id('id_parametro'); // SERIAL PRIMARY KEY
            $table->string('codigo_parametro', 10)->notNullable(); // VARCHAR(10) NOT NULL
            $table->string('nombre_parametro', 100)->notNullable(); // VARCHAR(100) NOT NULL
            $table->decimal('valor_parametro', 10, 2)->notNullable(); // DECIMAL(10, 2) NOT NULL
            $table->string('descripcion_parametro', 255)->nullable(); // VARCHAR(255), NULLABLE
            $table->timestamps(); // Adds created_at and updated_at columns
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
