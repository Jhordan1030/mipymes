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
            $table->id('idtiponota'); // Hacer string unico
            $table->char('tiponota', 10);
            // $table->string('responsable', 20);
            $table->foreign('idempleado')->references('idempleado')->on('empleados')->onDelete('cascade');
            $table->json('productos')->nullable();
            $table->string('codigoproducto'); // Código del producto
            $table->integer('cantidad'); // Cantidad
            $table->string('codigotipoempaque')->nullable(); // Cambiar a codigotipoempaque
            $table->foreign('codigotipoempaque')
                ->references('codigotipoempaque')
                ->on('tipoempaques')
                ->onDelete('set null'); // Relación con tipoempaques

            $table->string('idbodega', 10); // Asegúrate de que tenga una longitud adecuada
            $table->foreign('idbodega')
                ->references('idbodega')
                ->on('bodegas')
                ->onDelete('cascade');

            $table->date('fechanota');

            $table->timestamps();

            $table->foreign('codigoproducto')->references('codigo')->on('productos')->onDelete('cascade');
            $table->foreign('idbodega')->references('idbodega')->on('bodegas')->onDelete('cascade');
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
