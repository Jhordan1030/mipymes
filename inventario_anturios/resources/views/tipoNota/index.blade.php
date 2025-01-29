@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center">Lista de Notas</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-3 text-right">
        <a href="{{ route('tipoNota.create') }}" class="btn btn-primary">Crear Nota</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Tipo</th>
                    <th>Solicitante</th>
                    <th>Código Producto</th>
                    <th>Cantidad</th>
                    <th>Tipo de Empaque</th>
                    <th>Bodega</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tipoNotas as $nota)
                    <tr>
                        <td>{{ $nota->codigo }}</td>
                        <td>{{ $nota->tiponota }}</td>
                        <td>{{ $nota->responsableEmpleado->nombreemp ?? 'Sin asignar' }}</td>
                        <td>{{ $nota->producto->codigo ?? 'Sin productos' }}</td>
                        <td>{{ $nota->cantidad }}</td>
                        <td>{{ $nota->tipoEmpaque->nombretipoempaque ?? 'Sin asignar' }}</td>
                        <td>{{ $nota->bodega->nombrebodega ?? 'Sin asignar' }}</td>
                        <td>{{ $nota->fechanota }}</td>
                        <td>
                            <a href="{{ route('tipoNota.edit', $nota->idtiponota) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('tipoNota.destroy', $nota->idtiponota) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Está seguro de eliminar esta nota?');">
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
        {{ $tipoNotas->links() }}
    </div>
</div>
@endsection
