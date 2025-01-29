<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddTriggerCheckCantidadDetalleTipoNota extends Migration
{
    public function up()
    {
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
        DB::unprepared("
            DROP TRIGGER IF EXISTS trigger_check_cantidad_detalle_tipo_nota ON detalle_tipo_nota;
            DROP FUNCTION IF EXISTS check_cantidad_detalle_tipo_nota;
        ");
    }
}
