@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Crear Transacción de Producto</h2>

    <form action="{{ route('transaccion_producto.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="tipotransaccion">Tipo de Transacción</label>
            <input type="text" name="tipotransaccion" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="cantidad">Cantidad</label>
            <input type="number" name="cantidad" class="form-control" min="1" required>
        </div>
        <div class="form-group">
            <label for="estadodisponibilidad">Estado de Disponibilidad</label>
            <input type="text" name="estadodisponibilidad" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="estadoproducto">Estado del Producto</label>
            <input type="text" name="estadoproducto" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection
