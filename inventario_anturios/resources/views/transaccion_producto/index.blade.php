@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Lista de Transacciones de Productos</h2>
    <a href="{{ route('transaccion_producto.create') }}" class="btn btn-primary mb-3">Añadir Transacción</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tipo de Transacción</th>
                <th>Cantidad</th>
                <th>Estado de Disponibilidad</th>
                <th>Estado del Producto</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transacciones as $transaccion)
                <tr>
                    <td>{{ $transaccion->idtransaccion }}</td>
                    <td>{{ $transaccion->tipotransaccion }}</td>
                    <td>{{ $transaccion->cantidad }}</td>
                    <td>{{ $transaccion->estadodisponibilidad }}</td>
                    <td>{{ $transaccion->estadoproducto }}</td>
                    <td>
                        <a href="{{ route('transaccion_producto.edit', $transaccion->idtransaccion) }}" class="btn btn-primary btn-sm">Editar</a>
                        <form action="{{ route('transaccion_producto.destroy', $transaccion->idtransaccion) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar esta transacción?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-3">
        {{ $transacciones->links() }}
    </div>
</div>
@endsection
