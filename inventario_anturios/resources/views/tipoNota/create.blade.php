@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="text-center">Crear Nuevo Tipo de Nota</h3>

    <!-- Alertas de validación -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulario -->
    <form action="{{ route('tipoNota.store') }}" method="POST">
        @csrf

        <div class="row mb-3">
            <div class="col-md-6 col-sm-12">
                <label for="tiponota" class="form-label">Tipo</label>
                <select name="tiponota" id="tiponota" class="form-control" required>
                    <option value="" disabled selected>Seleccione un tipo</option>
                    <option value="ENVIO">Envío</option>
                    <option value="DEVOLUCION">Devolución</option>
                </select>
            </div>

            <div class="col-md-6 col-sm-12">
                <label for="idempleado" class="form-label">Solicitante</label>
                <select name="idempleado" id="idempleado" class="form-control" required>
                    <option value="" disabled selected>Seleccione un solicitante</option>
                    @foreach ($empleados as $empleado)
                        <option value="{{ $empleado->idempleado }}">
                            {{ $empleado->nombreemp }} {{ $empleado->apellidoemp }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Campos dinámicos para Producto, Cantidad y Tipo de Empaque -->
        <div id="productos-container">
            <div class="form-group row producto-row">
                <!-- Código del Producto -->
                <div class="col-md-4">
                    <label for="codigoproducto[]" class="form-label">Código del Producto</label>
                    <select name="codigoproducto[]" class="form-control" required>
                        <option value="" disabled selected>Seleccione un producto</option>
                        @foreach ($productos as $producto)
                            <option value="{{ $producto->codigo }}">{{ $producto->codigo }} - {{ $producto->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Cantidad -->
                <div class="col-md-3">
                    <label for="cantidad[]" class="form-label">Cantidad</label>
                    <input type="number" name="cantidad[]" class="form-control" min="1" placeholder="Cantidad" required>
                </div>

                <!-- Tipo de Empaque -->
                <div class="col-md-3">
                    <label for="codigotipoempaque[]" class="form-label">Tipo de Empaque</label>
                    <select name="codigotipoempaque[]" class="form-control" required>
                        <option value="" disabled selected>Seleccione un tipo de empaque</option>
                        @foreach ($tipoempaques as $tipoEmpaque)
                            <option value="{{ $tipoEmpaque->codigotipoempaque }}">{{ $tipoEmpaque->nombretipoempaque }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Botones (+ y x) -->
                <div class="col-md-2 d-flex align-items-end">
                    <button type="button" class="btn btn-success add-producto me-2">+</button>
                    <button type="button" class="btn btn-danger remove-producto">x</button>
                </div>
            </div>
        </div>

        <!-- Fechas -->
        <div class="row mb-3 mt-4">
            <div class="col-md-6 col-sm-12">
                <label for="fechanota" class="form-label">Fecha Solicitud</label>
                <input type="date" name="fechanota" id="fechanota" class="form-control" value="{{ now()->toDateString() }}" required readonly>
            </div>
        </div>

        <!-- Bodega -->
        <div class="form-group mb-3">
            <label for="idbodega" class="form-label">Bodega</label>
            <select name="idbodega" id="idbodega" class="form-control" required>
                <option value="" disabled selected>Seleccione una bodega</option>
                @foreach ($bodegas as $bodega)
                    <option value="{{ $bodega->idbodega }}">{{ $bodega->nombrebodega }}</option>
                @endforeach
            </select>
        </div>

        <!-- Botones -->
        <div class="d-flex justify-content-between">
            <a href="{{ route('tipoNota.index') }}" class="btn btn-secondary">Atrás</a>
            <button type="submit" class="btn btn-success">Guardar</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('add-producto')) {
            e.preventDefault();
            const container = document.getElementById('productos-container');
            const newRow = document.querySelector('.producto-row').cloneNode(true);

            // Limpiar valores
            newRow.querySelectorAll('select').forEach(select => select.value = '');
            newRow.querySelectorAll('input').forEach(input => input.value = '');

            // Configurar botones
            const addButton = newRow.querySelector('.add-producto');
            addButton.classList.replace('btn-success', 'btn-danger');
            addButton.textContent = 'x';
            addButton.classList.add('remove-producto');
            addButton.classList.remove('add-producto');

            container.appendChild(newRow);
        }

        if (e.target.classList.contains('remove-producto')) {
            e.preventDefault();
            const row = e.target.closest('.producto-row');
            if (row) {
                row.remove();
            }
        }
    });
</script>
@endsection
