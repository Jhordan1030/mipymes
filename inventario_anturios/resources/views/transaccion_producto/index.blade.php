@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Lista de Transacciones de Productos</h2>
    <a href="{{ route('transaccion_producto.create') }}" class="btn btn-primary mb-3">Añadir Transacción</a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tipo de Transacción</th>
                <th>Código Producto</th>
                <th>Cantidad</th>
                <th>Bodega</th>
                <th>Responsable</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transacciones as $transaccion)
                <tr>
                    <td>{{ $transaccion->idtransaccion }}</td>
                    <td>{{ $transaccion->tipotransaccion }}</td>
                    <td>{{ $transaccion->producto->codigo ?? 'Sin asignar' }}</td>
                    <td>{{ $transaccion->cantidad }}</td>
                    <td>{{ $transaccion->bodega->nombrebodega ?? 'Sin asignar' }}</td>
                    <td>{{ $transaccion->empleado->nombreemp ?? 'Sin asignar' }}</td>
                    <td>
                        <!-- <a href="{{ route('transaccion_producto.edit', $transaccion->idtransaccion) }}" class="btn btn-sm btn-primary">Editar</a> -->
                        <form action="{{ route('transaccion_producto.destroy', $transaccion->idtransaccion) }}" method="POST" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Está seguro de eliminar esta transacción?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No hay transacciones registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-3">
        {{ $transacciones->links() }}
    </div>
</div>
@endsection
