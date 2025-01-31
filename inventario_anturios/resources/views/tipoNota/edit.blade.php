@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="text-center">Editar Nota</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tipoNota.update', $tipoNota->codigo) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="codigo" class="form-label">Código de Nota</label>
                <input type="text" name="codigo" class="form-control" value="{{ $tipoNota->codigo }}" readonly>
            </div>

            <div class="mb-3">
                <label for="tiponota" class="form-label">Tipo de Nota</label>
                <select name="tiponota" class="form-control" required>
                    <option value="ENVIO" {{ $tipoNota->tiponota == 'ENVIO' ? 'selected' : '' }}>Envío</option>
                    <option value="DEVOLUCION" {{ $tipoNota->tiponota == 'DEVOLUCION' ? 'selected' : '' }}>Devolución</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="idempleado" class="form-label">Solicitante</label>
                <select name="idempleado" class="form-control" required>
                    @foreach ($empleados as $empleado)
                        <option value="{{ $empleado->idempleado }}" {{ $tipoNota->idempleado == $empleado->idempleado ? 'selected' : '' }}>
                            {{ $empleado->nombreemp }} {{ $empleado->apellidoemp }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div id="productos-container">
                @foreach ($tipoNota->detalles as $detalle)
                    <div class="producto-row row mb-3">
                        <input type="hidden" name="detalle_ids[]" value="{{ $detalle->id }}">
                        <div class="col-md-4">
                            <label for="codigoproducto[]" class="form-label">Producto</label>
                            <select name="codigoproducto[]" class="form-control" required>
                                @foreach ($productos as $producto)
                                    <option value="{{ $producto->codigo }}" {{ $detalle->codigoproducto == $producto->codigo ? 'selected' : '' }}>
                                        {{ $producto->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="cantidad[]" class="form-label">Cantidad</label>
                            <input type="number" name="cantidad[]" class="form-control" value="{{ $detalle->cantidad }}" required>
                        </div>
                        <div class="col-md-3">
                            <label for="codigotipoempaque[]" class="form-label">Tipo de Empaque</label>
                            <select name="codigotipoempaque[]" class="form-control">
                                <option value="">Sin Empaque</option>
                                @foreach ($tipoempaques as $tipoEmpaque)
                                    <option value="{{ $tipoEmpaque->codigotipoempaque }}" {{ $detalle->codigotipoempaque == $tipoEmpaque->codigotipoempaque ? 'selected' : '' }}>
                                        {{ $tipoEmpaque->nombretipoempaque }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="button" class="btn btn-danger remove-producto">x</button>
                        </div>
                    </div>
                @endforeach
            </div>

            <button type="button" class="btn btn-success add-producto mb-3">+ Agregar Producto</button>

            <div class="mb-3">
                <label for="idbodega" class="form-label">Bodega</label>
                <select name="idbodega" class="form-control" required>
                    @foreach ($bodegas as $bodega)
                        <option value="{{ $bodega->idbodega }}" {{ $tipoNota->idbodega == $bodega->idbodega ? 'selected' : '' }}>
                            {{ $bodega->nombrebodega }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar Nota</button>
            <a href="{{ route('tipoNota.index') }}" class="btn btn-secondary">Cancelar</a>
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
