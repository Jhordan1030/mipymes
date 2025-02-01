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
                <label for="nro_identificacion" class="form-label">Solicitante</label>
                <select name="nro_identificacion" class="form-control" required>
                    @foreach ($empleados as $empleado)
                        <option value="{{ $empleado->nro_identificacion }}">{{ $empleado->nombreemp }} {{ $empleado->apellidoemp }}</option>
                    @endforeach
                </select>
            </div>

            <div id="productos-container">
                <div class="producto-row row mb-3">
                    <div class="col-md-4">
                        <label for="codigoproducto[]" class="form-label">Producto</label>
                        <select name="codigoproducto[]" class="form-control producto-select" required>
                            <option value="">Seleccione un producto</option>
                            @foreach ($productos as $producto)
                                <option value="{{ $producto->codigo }}" data-stock="{{ $producto->cantidad }}" data-tipoempaque="{{ $producto->tipoempaque }}">
                                    {{ $producto->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="cantidad[]" class="form-label">Cantidad</label>
                        <input type="number" name="cantidad[]" class="form-control cantidad-input" min="1" required>
                    </div>
                    <div class="col-md-3">
                        <label for="tipoempaque[]" class="form-label">Tipo de Empaque</label>
                        <input type="text" name="tipoempaque[]" class="form-control tipoempaque-input" readonly>
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
        document.addEventListener('DOMContentLoaded', function () {
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

            document.addEventListener('change', function (e) {
                if (e.target.classList.contains('producto-select')) {
                    let selectedOption = e.target.options[e.target.selectedIndex];
                    let stock = selectedOption.getAttribute('data-stock');
                    let tipoempaque = selectedOption.getAttribute('data-tipoempaque');
                    let cantidadInput = e.target.closest('.producto-row').querySelector('.cantidad-input');
                    let tipoempaqueInput = e.target.closest('.producto-row').querySelector('.tipoempaque-input');

                    cantidadInput.setAttribute('max', stock);
                    tipoempaqueInput.value = tipoempaque;
                }
            });
        });
    </script>
@endsection
