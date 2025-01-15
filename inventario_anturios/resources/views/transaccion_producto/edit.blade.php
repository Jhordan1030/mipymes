@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Editar Transacción de Producto</h2>

    <form action="{{ route('transaccion_producto.update', $transaccion->idtransaccion) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="tipotransaccion">Tipo de Transacción</label>
            <input type="text" name="tipotransaccion" class="form-control" value="{{ $transaccion->tipotransaccion }}" required>
        </div>
        <div class="form-group">
            <label for="cantidad">Cantidad</label>
            <input type="number" name="cantidad" class="form-control" value="{{ $transaccion->cantidad }}" min="1" required>
        </div>
        <div class="form-group">
            <label for="estadodisponibilidad">Estado de Disponibilidad</label>
            <input type="text" name="estadodisponibilidad" class="form-control" value="{{ $transaccion->estadodisponibilidad }}" required>
        </div>
        <div class="form-group">
            <label for="estadoproducto">Estado del Producto</label>
            <input type="text" name="estadoproducto" class="form-control" value="{{ $transaccion->estadoproducto }}" required>
        </div>
        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('transaccion_producto.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
