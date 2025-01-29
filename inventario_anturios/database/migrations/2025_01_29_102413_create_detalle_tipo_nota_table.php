<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleTipoNotaTable extends Migration
{
    public function up()
    {
        Schema::create('detalle_tipo_nota', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tipo_nota_id');
            $table->string('codigoproducto', 50);
            $table->integer('cantidad');
            $table->string('codigotipoempaque')->nullable();
            $table->foreign('tipo_nota_id')->references('idtiponota')->on('tipo_nota')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('detalle_tipo_nota');
    }
}

