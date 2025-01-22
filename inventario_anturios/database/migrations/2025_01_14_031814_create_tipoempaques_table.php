<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tipoempaques', function (Blueprint $table) {
            $table->string('codigotipoempaque')->primary(); // Definir como clave primaria
            $table->string('nombretipoempaque');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tipoempaques');
    }
};
