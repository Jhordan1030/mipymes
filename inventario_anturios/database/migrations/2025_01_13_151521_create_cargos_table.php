<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cargos', function (Blueprint $table) {
            $table->string('codigocargo', 10)->primary(); // Clave primaria como 'codigocargo'
            $table->string('nombrecargo')->unique();
            $table->timestamps();
        });

        // Crear función PL/pgSQL para validar nombre del cargo
        DB::unprepared("
            CREATE OR REPLACE FUNCTION validar_nombre_cargo()
            RETURNS TRIGGER AS $$
            BEGIN
                -- Validar que el nombre solo contenga letras y espacios
                IF NEW.nombrecargo !~ '^[A-Za-zÁÉÍÓÚáéíóúÑñ ]+$' THEN
                    RAISE EXCEPTION 'El nombre del cargo solo puede contener letras y espacios.';
                END IF;
                RETURN NEW;
            END;
            $$ LANGUAGE plpgsql;
        ");

        // Crear el trigger que ejecutará la validación antes de insertar o actualizar
        DB::unprepared("
            CREATE TRIGGER trg_validar_nombre_cargo
            BEFORE INSERT OR UPDATE ON cargos
            FOR EACH ROW EXECUTE FUNCTION validar_nombre_cargo();
        ");
    }

    public function down(): void
    {
        Schema::dropIfExists('cargos');
    }
};
