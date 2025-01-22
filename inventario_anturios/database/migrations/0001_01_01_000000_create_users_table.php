<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nombre completo del usuario
            $table->string('username')->unique(); // Nombre de usuario único
            $table->string('password'); // Contraseña encriptada
            $table->rememberToken(); // Token para "remember me"
            $table->timestamps();
        });

        // Si deseas mantener las tablas de restablecimiento de contraseña y sesiones, descomenta las siguientes líneas:
        /*
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
        */
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        // Elimina estas líneas si no usas las tablas de restablecimiento de contraseña y sesiones:
        // Schema::dropIfExists('password_reset_tokens');
        // Schema::dropIfExists('sessions');
    }
};
