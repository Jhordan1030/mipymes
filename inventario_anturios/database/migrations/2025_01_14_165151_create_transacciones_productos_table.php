<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('transacciones_productos', function (Blueprint $table) {
            $table->id('idtransaccion');
            $table->string('tipotransaccion', 20);
            $table->string('codigoproducto'); // Código del producto
            $table->integer('cantidad'); // Cantidad
            $table->unsignedBigInteger('idbodega'); // Relación con bodegas
            $table->unsignedBigInteger('idempleado'); // Relación con empleados
            $table->timestamps();

            // Llaves foráneas
            $table->foreign('codigoproducto')->references('codigo')->on('productos')->onDelete('cascade');
            $table->foreign('idbodega')->references('idbodega')->on('bodegas')->onDelete('cascade');
            $table->foreign('idempleado')->references('idempleado')->on('empleados')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transacciones_productos');
    }
};
