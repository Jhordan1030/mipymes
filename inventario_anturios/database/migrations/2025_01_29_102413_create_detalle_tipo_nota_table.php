<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up()
    {
        Schema::create('detalle_tipo_nota', function (Blueprint $table) {
            $table->id();

            // 'tipo_nota_id' ahora es string y referencia 'codigo' en 'tipo_nota'
            $table->string('tipo_nota_id', 50);
            $table->foreign('tipo_nota_id')->references('codigo')->on('tipo_nota')->onDelete('cascade');

            $table->string('codigoproducto', 50);
            $table->foreign('codigoproducto')->references('codigo')->on('productos')->onDelete('cascade');

            $table->integer('cantidad');
            $table->string('codigotipoempaque')->nullable();
            $table->foreign('codigotipoempaque')->references('codigotipoempaque')->on('tipoempaques')->onDelete('set null');

            $table->timestamps();
        });

        // Creación del trigger en la migración
        DB::unprepared("
            CREATE OR REPLACE FUNCTION check_cantidad_detalle_tipo_nota()
            RETURNS TRIGGER AS $$
            DECLARE
                stock_disponible INT;
            BEGIN
                -- Obtener la cantidad disponible en productos
                SELECT cantidad INTO stock_disponible FROM productos WHERE codigo = NEW.codigoproducto;

                -- Si el producto no existe, lanzar un error
                IF stock_disponible IS NULL THEN
                    RAISE EXCEPTION 'El producto % no existe.', NEW.codigoproducto;
                END IF;

                -- Verificar si la cantidad en detalle_tipo_nota supera el stock disponible
                IF NEW.cantidad > stock_disponible THEN
                    RAISE EXCEPTION 'Stock insuficiente para el producto %. Disponible: %, Solicitado: %',
                        NEW.codigoproducto, stock_disponible, NEW.cantidad;
                END IF;

                RETURN NEW;
            END;
            $$ LANGUAGE plpgsql;

            -- Crear el trigger en detalle_tipo_nota
            CREATE TRIGGER trigger_check_cantidad_detalle_tipo_nota
            BEFORE INSERT OR UPDATE ON detalle_tipo_nota
            FOR EACH ROW
            EXECUTE FUNCTION check_cantidad_detalle_tipo_nota();
        ");
    }

    public function down()
    {
        // Eliminar trigger antes de eliminar la tabla
        DB::unprepared("
            DROP TRIGGER IF EXISTS trigger_check_cantidad_detalle_tipo_nota ON detalle_tipo_nota;
            DROP FUNCTION IF EXISTS check_cantidad_detalle_tipo_nota;
        ");

        Schema::dropIfExists('detalle_tipo_nota');
    }
};
