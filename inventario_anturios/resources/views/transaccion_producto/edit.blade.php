@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Editar Transacción de Producto</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('transaccion_producto.update', $transaccion->idtransaccion) }}" method="POST">
        @csrf
        @method('PATCH')

        <!-- Tipo de Transacción -->
        <div class="form-group">
            <label for="tipotransaccion">Tipo de Transacción</label>
            <select name="tipotransaccion" id="tipotransaccion" class="form-control">
                <option value="envío" {{ $transaccion->tipotransaccion == 'envío' ? 'selected' : '' }}>Envío</option>
                <option value="devolución" {{ $transaccion->tipotransaccion == 'devolución' ? 'selected' : '' }}>Devolución</option>
            </select>
        </div>

        <!-- Productos y Cantidades -->
        <div id="productos-container">
            <label>Código del Producto y Cantidad</label>
            @php
                $productosCodigos = is_array($transaccion->codigoproducto) 
                    ? $transaccion->codigoproducto 
                    : json_decode($transaccion->codigoproducto, true);
            @endphp

            @if ($productosCodigos)
                @foreach ($productosCodigos as $index => $codigo)
                    <div class="form-group row producto-row">
                        <div class="col-md-6">
                            <select name="codigoproducto[]" class="form-control">
                                <option value="">Seleccione un producto</option>
                                @foreach ($productos as $producto)
                                    <option value="{{ $producto->codigo }}" {{ $producto->codigo == $codigo ? 'selected' : '' }}>
                                        {{ $producto->codigo }} - {{ $producto->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <input type="number" name="cantidad[]" class="form-control" min="1" placeholder="Cantidad" value="{{ $transaccion->cantidad[$index] ?? '' }}">
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger remove-producto">x</button>
                        </div>
                    </div>
                @endforeach
            @else
                <!-- Si no hay productos, muestra una fila vacía -->
                <div class="form-group row producto-row">
                    <div class="col-md-6">
                        <select name="codigoproducto[]" class="form-control">
                            <option value="">Seleccione un producto</option>
                            @foreach ($productos as $producto)
                                <option value="{{ $producto->codigo }}">{{ $producto->codigo }} - {{ $producto->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input type="number" name="cantidad[]" class="form-control" min="1" placeholder="Cantidad">
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-success add-producto">+</button>
                    </div>
                </div>
            @endif
        </div>

        <!-- Bodega -->
        <div class="form-group">
            <label for="idbodega">Bodega</label>
            <select name="idbodega" id="idbodega" class="form-control">
                <option value="">Seleccione una bodega</option>
                @foreach ($bodegas as $bodega)
                    <option value="{{ $bodega->idbodega }}" {{ $bodega->idbodega == $transaccion->idbodega ? 'selected' : '' }}>
                        {{ $bodega->nombrebodega }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Responsable -->
        <div class="form-group">
            <label for="idempleado">Empleado</label>
            <select name="idempleado" id="idempleado" class="form-control">
                <option value="">Seleccione un empleado</option>
                @foreach ($empleados as $empleado)
                    <option value="{{ $empleado->idempleado }}" {{ $empleado->idempleado == $transaccion->idempleado ? 'selected' : '' }}>
                        {{ $empleado->nombreemp }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success mt-3">Actualizar</button>
        <a href="{{ route('transaccion_producto.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
    </form>
</div>

<script>
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('add-producto')) {
            e.preventDefault();
            const container = document.getElementById('productos-container');
            const newRow = document.querySelector('.producto-row').cloneNode(true);
            newRow.querySelector('select').value = '';
            newRow.querySelector('input').value = '';
            newRow.querySelector('.add-producto').classList.replace('btn-success', 'btn-danger');
            newRow.querySelector('.add-producto').textContent = 'x';
            container.appendChild(newRow);
        }

        if (e.target.classList.contains('remove-producto')) {
            e.target.closest('.producto-row').remove();
        }
    });
</script>
@endsection
