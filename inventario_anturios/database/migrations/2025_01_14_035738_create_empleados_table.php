<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->string('nro_identificacion')->primary();
            $table->string('nombreemp');
            $table->string('apellidoemp');
            $table->string('email')->unique();
            $table->string('nro_telefono', 10);
            $table->string('direccionemp', 100);
            $table->string('idbodega', 10);
            $table->enum('tipo_identificacion', ['Cedula', 'RUC', 'Pasaporte']);
            $table->string('codigocargo', 10); // Se cambia idcargo a codigocargo
            $table->timestamps();

            // Relaciones
            $table->foreign('idbodega')->references('idbodega')->on('bodegas');
            $table->foreign('codigocargo')->references('codigocargo')->on('cargos'); // Cambio en la clave foránea
        });

        // Creación del procedimiento para validar datos de empleados
        DB::unprepared("CREATE OR REPLACE FUNCTION validar_empleado() RETURNS TRIGGER AS $$
        BEGIN
            IF NEW.nombreemp !~ '^[a-zA-ZÁÉÍÓÚáéíóúÑñ ]+$' THEN
                RAISE EXCEPTION 'El nombre solo puede contener letras y espacios';
            END IF;
            IF NEW.apellidoemp !~ '^[a-zA-ZÁÉÍÓÚáéíóúÑñ ]+$' THEN
                RAISE EXCEPTION 'El apellido solo puede contener letras y espacios';
            END IF;
            IF NEW.email !~ '^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$' THEN
                RAISE EXCEPTION 'El email no es válido';
            END IF;
            IF NEW.nro_telefono !~ '^[0-9]{10}$' THEN
                RAISE EXCEPTION 'El número de teléfono debe tener exactamente 10 dígitos';
            END IF;
            IF NEW.tipo_identificacion = 'Cedula' AND NEW.nro_identificacion !~ '^[0-9]{10}$' THEN
                RAISE EXCEPTION 'La cédula debe tener exactamente 10 dígitos numéricos';
            ELSIF NEW.tipo_identificacion = 'RUC' AND NEW.nro_identificacion !~ '^[0-9]{13}$' THEN
                RAISE EXCEPTION 'El RUC debe tener exactamente 13 dígitos numéricos';
            ELSIF NEW.tipo_identificacion = 'Pasaporte' AND NEW.nro_identificacion !~ '^[A-Za-z0-9]{6,12}$' THEN
                RAISE EXCEPTION 'El pasaporte debe ser alfanumérico y tener entre 6 y 12 caracteres';
            END IF;
            RETURN NEW;
        END;
        $$ LANGUAGE plpgsql;");

        DB::unprepared("CREATE TRIGGER trigger_validar_empleado
        BEFORE INSERT OR UPDATE ON empleados
        FOR EACH ROW
        EXECUTE FUNCTION validar_empleado();");
    }

    public function down(): void
    {
        Schema::dropIfExists('empleados');
        DB::unprepared("DROP TRIGGER IF EXISTS trigger_validar_empleado ON empleados;");
        DB::unprepared("DROP FUNCTION IF EXISTS validar_empleado;");
    }
};
