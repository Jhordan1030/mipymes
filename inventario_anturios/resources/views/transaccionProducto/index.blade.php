@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="text-center">Lista de Transacciones de Producto</h3>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-3 text-right">
        <a href="{{ route('transaccionProducto.create') }}" class="btn btn-primary">Nueva Transacción</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Código Tipo Nota</th>
                    <th>Código Producto</th>
                    <th>Tipo Empaque</th>
                    <th>Descripción Empaque</th>
                    <th>Cantidad</th>
                    <th>Bodega Destino</th>
                    <th>Responsable</th>
                    <th>Fecha Entrega</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transacciones as $transaccion)
                    <tr>
                        <td>{{ $transaccion->codigo_tipo_nota }}</td>
                        <td>{{ $transaccion->producto->codigo ?? 'N/A' }}</td>
                        <td>{{ $transaccion->tipo_empaque }}</td>
                        <td>{{ $transaccion->producto->tipoEmpaque->nombretipoempaque ?? 'N/A' }}</td>
                        <td>{{ $transaccion->cantidad }}</td>
                        <td>{{ $transaccion->bodega->nombrebodega ?? 'N/A' }}</td>
                        <td>{{ $transaccion->responsable->nombreemp ?? 'N/A' }} {{ $transaccion->responsable->apellidoemp ?? '' }}</td>
                        <td>{{ $transaccion->fecha_entrega }}</td>
                        <td>
                            <a href="{{ route('transaccionProducto.edit', $transaccion->id) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('transaccionProducto.destroy', $transaccion->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Está seguro de eliminar esta transacción?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $transacciones->links() }}
    </div>
</div>
@endsection