<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateProductosTable extends Migration
{
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 10)->unique();
            $table->string('nombre', 50)->unique();
            $table->text('descripcion');
            $table->integer('cantidad');
            $table->string('codigotipoempaque')->nullable();
            $table->foreign('codigotipoempaque')->references('codigotipoempaque')->on('tipoempaques')->onDelete('set null');
            $table->timestamps();
        });

        // Crear función PL/pgSQL para validar nombre del producto
        DB::unprepared("
            CREATE OR REPLACE FUNCTION validar_producto()
            RETURNS TRIGGER AS $$
            BEGIN
                -- Validar que el nombre solo contenga letras y espacios
                IF NEW.nombre !~ '^[A-Za-zÁÉÍÓÚáéíóúÑñ ]+$' THEN
                    RAISE EXCEPTION 'El nombre del producto solo puede contener letras y espacios.';
                END IF;
                
                -- Validar unicidad del nombre del producto
                IF EXISTS (SELECT 1 FROM productos WHERE nombre = NEW.nombre AND id <> NEW.id) THEN
                    RAISE EXCEPTION 'El nombre del producto ya existe.';
                END IF;
                
                RETURN NEW;
            END;
            $$ LANGUAGE plpgsql;
        ");

        // Crear el trigger que ejecutará la validación antes de insertar o actualizar
        DB::unprepared("
            CREATE TRIGGER trg_validar_producto
            BEFORE INSERT OR UPDATE ON productos
            FOR EACH ROW EXECUTE FUNCTION validar_producto();
        ");
    }

    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
