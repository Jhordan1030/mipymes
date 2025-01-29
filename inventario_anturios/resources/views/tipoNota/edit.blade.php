@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="text-center">Editar Tipo de Nota</h3>

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
        <form action="{{ route('tipoNota.update', $tipoNota->idtiponota) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="tiponota" class="form-label">Tipo</label>
                    <select name="tiponota" id="tiponota" class="form-control" required>
                        <option value="ENVIO" {{ $tipoNota->tiponota == 'ENVIO' ? 'selected' : '' }}>Envío</option>
                        <option value="DEVOLUCION" {{ $tipoNota->tiponota == 'DEVOLUCION' ? 'selected' : '' }}>Devolución
                        </option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="idempleado" class="form-label">Solicitante</label>
                    <select name="idempleado" id="idempleado" class="form-control" required>
                        <option value="" disabled>Seleccione un solicitante</option>
                        @foreach ($empleados as $empleado)
                            <option value="{{ $empleado->idempleado }}"
                                {{ $tipoNota->idempleado == $empleado->idempleado ? 'selected' : '' }}>
                                {{ $empleado->nombreemp }} {{ $empleado->apellidoemp }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Código del Producto -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="codigoproducto" class="form-label">Código del Producto</label>
                    <select name="codigoproducto" id="codigoproducto" class="form-control" required>
                        <option value="" disabled>Seleccione un producto</option>
                        @foreach ($productos as $producto)
                            <option value="{{ $producto->codigo }}"
                                {{ $tipoNota->codigoproducto == $producto->codigo ? 'selected' : '' }}>
                                {{ $producto->codigo }} - {{ $producto->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Cantidad -->
                <div class="col-md-6">
                    <label for="cantidad" class="form-label">Cantidad</label>
                    <input type="number" name="cantidad" id="cantidad" class="form-control"
                        value="{{ $tipoNota->cantidad }}" required>
                </div>
            </div>

            <!-- Tipo de Empaque -->
            <div class="mb-3">
                <label for="codigotipoempaque" class="form-label">Tipo de Empaque</label>
                <select name="codigotipoempaque" id="codigotipoempaque" class="form-control" required>
                    <option value="" disabled>Seleccione un tipo de empaque</option>
                    @foreach ($tipoempaques as $tipoEmpaque)
                        <option value="{{ $tipoEmpaque->codigotipoempaque }}"
                            {{ $tipoNota->codigotipoempaque == $tipoEmpaque->codigotipoempaque ? 'selected' : '' }}>
                            {{ $tipoEmpaque->nombretipoempaque }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Fecha de la Nota -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="fechanota" class="form-label">Fecha de Solicitud</label>
                    <input type="date" name="fechanota" id="fechanota" class="form-control"
                        value="{{ $tipoNota->fechanota }}" required readonly>
                </div>

                <!-- Bodega -->
                <div class="col-md-6">
                    <label for="idbodega" class="form-label">Bodega</label>
                    <select name="idbodega" id="idbodega" class="form-control" required>
                        <option value="" disabled>Seleccione una bodega</option>
                        @foreach ($bodegas as $bodega)
                            <option value="{{ $bodega->idbodega }}"
                                {{ $tipoNota->idbodega == $bodega->idbodega ? 'selected' : '' }}>
                                {{ $bodega->nombrebodega }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Botones -->
            <div class="d-flex justify-content-between">
                <a href="{{ route('tipoNota.index') }}" class="btn btn-secondary">Atrás</a>
                <button type="submit" class="btn btn-success">Actualizar</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('click', function(e) {
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
