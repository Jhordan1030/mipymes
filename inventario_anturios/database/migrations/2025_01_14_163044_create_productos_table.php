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
            $table->string('codigo', 10);
            $table->string('nombre', 50);
            $table->text('descripcion');
            $table->integer('cantidad');
            $table->string('tipoempaque')->nullable();
            $table->timestamps();
        });

        // Crear función PL/pgSQL para validar unicidad del código del producto
        DB::unprepared(" 
            CREATE OR REPLACE FUNCTION validar_codigo_producto()
            RETURNS TRIGGER AS $$
            BEGIN
                -- Validar unicidad del código del producto
                IF EXISTS (SELECT 1 FROM productos WHERE codigo = NEW.codigo AND id <> NEW.id) THEN
                    RAISE EXCEPTION 'El código del producto ya existe.';
                END IF;
                RETURN NEW;
            END;
            $$ LANGUAGE plpgsql;
        ");

        // Crear el trigger que ejecutará la validación antes de insertar o actualizar
        DB::unprepared(" 
            CREATE TRIGGER trg_validar_codigo_producto
            BEFORE INSERT OR UPDATE ON productos
            FOR EACH ROW EXECUTE FUNCTION validar_codigo_producto();
        ");
    }

    public function down()
    {
        // Eliminar el trigger y la función antes de eliminar la tabla
        DB::unprepared("DROP TRIGGER IF EXISTS trg_validar_codigo_producto ON productos;");
        DB::unprepared("DROP FUNCTION IF EXISTS validar_codigo_producto;");

        Schema::dropIfExists('productos');
    }
}
