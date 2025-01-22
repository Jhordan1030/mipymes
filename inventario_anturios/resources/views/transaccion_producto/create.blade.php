@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Crear Transacción de Producto</h2>

    <form action="{{ route('transaccion_producto.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="tipotransaccion">Tipo de Transacción</label>
            <select name="tipotransaccion" id="tipotransaccion" class="form-control">
                <option value="envío">Envío</option>
                <option value="devolución">Devolución</option>
            </select>
        </div>

        <div id="envio-fields">
            <label>Código del Producto y Cantidad</label>
            <div id="productos-container">
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
            </div>

            <div class="form-group">
                <label for="idbodega">Bodega</label>
                <select name="idbodega" id="idbodega" class="form-control">
                    <option value="">Seleccione una bodega</option>
                    @foreach ($bodegas as $bodega)
                        <option value="{{ $bodega->idbodega }}">{{ $bodega->nombrebodega }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="idempleado">Empleado</label>
                <select name="idempleado" id="idempleado" class="form-control">
                    <option value="">Seleccione un empleado</option>
                    @foreach ($empleados as $empleado)
                        <option value="{{ $empleado->idempleado }}">{{ $empleado->nombreemp }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Guardar</button>
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

        if (e.target.classList.contains('btn-danger')) {
            e.target.closest('.producto-row').remove();
        }
    });
</script>
@endsection
