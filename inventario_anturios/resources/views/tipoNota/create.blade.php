@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="text-center">Crear Nueva Nota</h3>

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
            <label for="tiponota" class="form-label">Tipo de Nota</label>
            <select name="tiponota" class="form-control" required>
                <option value="ENVIO">Envío</option>
                <option value="DEVOLUCION">Devolución</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="idempleado" class="form-label">Solicitante</label>
            <select name="idempleado" class="form-control" required>
                @foreach ($empleados as $empleado)
                    <option value="{{ $empleado->idempleado }}">{{ $empleado->nombreemp }} {{ $empleado->apellidoemp }}</option>
                @endforeach
            </select>
        </div>

        <div id="productos-container">
            <div class="producto-row row mb-3">
                <div class="col-md-4">
                    <label for="codigoproducto[]" class="form-label">Producto</label>
                    <select name="codigoproducto[]" class="form-control" required>
                        @foreach ($productos as $producto)
                            <option value="{{ $producto->codigo }}">{{ $producto->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="cantidad[]" class="form-label">Cantidad</label>
                    <input type="number" name="cantidad[]" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label for="codigotipoempaque[]" class="form-label">Tipo de Empaque</label>
                    <select name="codigotipoempaque[]" class="form-control">
                        <option value="">Sin Empaque</option>
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
            <select name="idbodega" class="form-control" required>
                @foreach ($bodegas as $bodega)
                    <option value="{{ $bodega->idbodega }}">{{ $bodega->nombrebodega }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Nota</button>
    </form>
</div>

<script>
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('add-producto')) {
            e.preventDefault();
            const container = document.getElementById('productos-container');
            const newRow = document.querySelector('.producto-row').cloneNode(true);
            newRow.querySelectorAll('select, input').forEach(input => input.value = '');
            container.appendChild(newRow);
        }

        if (e.target.classList.contains('remove-producto')) {
            e.preventDefault();
            if (document.querySelectorAll('.producto-row').length > 1) {
                e.target.closest('.producto-row').remove();
            }
        }
    });
</script>
@endsection
