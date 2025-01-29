@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="text-center">Crear Tipo de Nota</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tipoNota.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="codigo" class="form-label">Código de Nota</label>
            <input type="text" name="codigo" id="codigo" class="form-control" value="{{ $codigoNota }}" readonly>
        </div>

        <div class="mb-3">
            <label for="tiponota" class="form-label">Tipo</label>
            <select name="tiponota" id="tiponota" class="form-control" required>
                <option value="ENVIO">Envío</option>
                <option value="DEVOLUCION">Devolución</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="idempleado" class="form-label">Solicitante</label>
            <select name="idempleado" id="idempleado" class="form-control" required>
                @foreach ($empleados as $empleado)
                    <option value="{{ $empleado->idempleado }}">{{ $empleado->nombreemp }} {{ $empleado->apellidoemp }}</option>
                @endforeach
            </select>
        </div>

        <div id="productos-container">
            <div class="producto-row row mb-3">
                <div class="col-md-4">
                    <label for="codigoproducto[]" class="form-label">Código de Producto</label>
                    <select name="codigoproducto[]" class="form-control" required>
                        @foreach ($productos as $producto)
                            <option value="{{ $producto->codigo }}">{{ $producto->codigo }} - {{ $producto->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="cantidad[]" class="form-label">Cantidad</label>
                    <input type="number" name="cantidad[]" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label for="codigotipoempaque[]" class="form-label">Tipo de Empaque</label>
                    <select name="codigotipoempaque[]" class="form-control" required>
                        @foreach ($tipoempaques as $tipoEmpaque)
                            <option value="{{ $tipoEmpaque->codigotipoempaque }}">{{ $tipoEmpaque->nombretipoempaque }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="button" class="btn btn-success add-producto me-2">+</button>
                    <button type="button" class="btn btn-danger remove-producto">x</button>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="idbodega" class="form-label">Bodega</label>
            <select name="idbodega" id="idbodega" class="form-control" required>
                @foreach ($bodegas as $bodega)
                    <option value="{{ $bodega->idbodega }}">{{ $bodega->nombrebodega }}</option>
                @endforeach
            </select>
        </div>

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

            newRow.querySelectorAll('select').forEach(select => select.value = '');
            newRow.querySelectorAll('input').forEach(input => input.value = '');

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
