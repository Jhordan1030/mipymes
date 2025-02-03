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
DECLARE
    provincia INTEGER;
    tercer_digito INTEGER;
    coeficientes INTEGER[] := ARRAY[2, 1, 2, 1, 2, 1, 2, 1, 2];  -- Coeficientes usados en validación de cédula
    suma INTEGER := 0;
    resultado INTEGER;
    digito_verificador INTEGER;
    i INTEGER;
    digito INTEGER;
    ultimos_tres_digitos TEXT;
    primeros_diez_digitos TEXT;
    primer_digito CHAR;
    digitos_iguales BOOLEAN;
BEGIN
    -- Validación del nombre y apellido (solo letras y espacios)
    IF NEW.nombreemp !~ '^[a-zA-ZÁÉÍÓÚáéíóúÑñ ]+$' THEN
        RAISE EXCEPTION 'El nombre solo puede contener letras y espacios';
    END IF;
    
    IF NEW.apellidoemp !~ '^[a-zA-ZÁÉÍÓÚáéíóúÑñ ]+$' THEN
        RAISE EXCEPTION 'El apellido solo puede contener letras y espacios';
    END IF;

    -- Validación del email
    IF NEW.email !~ '^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$' THEN
        RAISE EXCEPTION 'El email no es válido: ejemplo@gmail.com';
    END IF;

    -- Validación del número de teléfono
    IF NEW.nro_telefono !~ '^0[2-9][0-9]{8}$' THEN
        RAISE EXCEPTION 'El número de teléfono debe comenzar con 0, el segundo dígito entre 2 y 9 y tener 10 dígitos en total';
    END IF;

    -- Validación de identificaciones
    IF NEW.tipo_identificacion = 'Cedula' OR NEW.tipo_identificacion = 'RUC' THEN
        -- Extraer los primeros 10 dígitos (para cédula o base del RUC)
        primeros_diez_digitos := SUBSTRING(NEW.nro_identificacion FROM 1 FOR 10);

        -- Verificar que tiene 10 dígitos numéricos
        IF LENGTH(primeros_diez_digitos) <> 10 OR primeros_diez_digitos !~ '^[0-9]+$' THEN
            RAISE EXCEPTION 'La cédula debe tener exactamente 10 dígitos numéricos';
        END IF;

        -- Verificar si todos los dígitos son iguales
        primer_digito := SUBSTRING(primeros_diez_digitos FROM 1 FOR 1);
        digitos_iguales := primeros_diez_digitos ~ ('^' || primer_digito || '{10}$');

        IF digitos_iguales THEN
            RAISE EXCEPTION 'La cédula no puede contener 10 dígitos iguales';
        END IF;

        -- Verificar provincia válida (01-24)
        provincia := CAST(SUBSTRING(primeros_diez_digitos FROM 1 FOR 2) AS INTEGER);
        IF provincia < 1 OR provincia > 24 THEN
            RAISE EXCEPTION 'La cédula tiene un código de provincia inválido';
        END IF;

        -- Verificar tercer dígito (0-6)
        tercer_digito := CAST(SUBSTRING(primeros_diez_digitos FROM 3 FOR 1) AS INTEGER);
        IF tercer_digito < 0 OR tercer_digito > 6 THEN
            RAISE EXCEPTION 'El tercer dígito de la cédula es inválido';
        END IF;

        -- Cálculo del dígito verificador con módulo 10
        suma := 0;
        FOR i IN 1..9 LOOP
            digito := CAST(SUBSTRING(primeros_diez_digitos FROM i FOR 1) AS INTEGER);
            resultado := digito * coeficientes[i];
            IF resultado > 9 THEN
                resultado := resultado - 9;
            END IF;
            suma := suma + resultado;
        END LOOP;

        digito_verificador := (10 - (suma % 10)) % 10;
        IF digito_verificador <> CAST(SUBSTRING(primeros_diez_digitos FROM 10 FOR 1) AS INTEGER) THEN
            RAISE EXCEPTION 'El número de cédula es inválido (dígito verificador incorrecto)';
        END IF;

        -- Validación adicional solo para RUC
        IF NEW.tipo_identificacion = 'RUC' THEN
            -- Verificar que el RUC tiene 13 dígitos
            IF LENGTH(NEW.nro_identificacion) <> 13 OR NEW.nro_identificacion !~ '^[0-9]+$' THEN
                RAISE EXCEPTION 'El RUC debe tener exactamente 13 dígitos numéricos';
            END IF;

            -- Validar que los últimos tres dígitos sean '001'
            ultimos_tres_digitos := SUBSTRING(NEW.nro_identificacion FROM 11 FOR 3);
            IF ultimos_tres_digitos <> '001' THEN
                RAISE EXCEPTION 'El RUC debe terminar en 001';
            END IF;
        END IF;

    ELSIF NEW.tipo_identificacion = 'Pasaporte' THEN
        -- Validar que el pasaporte sea alfanumérico y tenga entre 6 y 12 caracteres
        IF NEW.nro_identificacion !~ '^[A-Za-z0-9]{6,12}$' THEN
            RAISE EXCEPTION 'El pasaporte debe ser alfanumérico y tener entre 6 y 12 caracteres';
        END IF;
    ELSE
        RAISE EXCEPTION 'El tipo de identificación no es válido';
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
