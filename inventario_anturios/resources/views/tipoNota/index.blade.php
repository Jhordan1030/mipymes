@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center">Lista de Notas</h2>

    <!-- Alertas -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Botón Crear Nueva Nota -->
    <div class="mb-3 text-right">
        <a href="{{ route('tipoNota.create') }}" class="btn btn-primary">Crear Nota</a>
    </div>

    <!-- Tabla de TipoNotas -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Tipo</th>
                    <th>Solicitante</th>
                    <th>Código Producto</th>
                    <th>Nombre Producto</th>
                    <th>Cantidad</th>
                    <th>Tipo Empaque</th>
                    <th>Fecha Solicitud</th>
                    <th>Bodega</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tipoNotas as $nota)
                    <tr>
                        <td>{{ $nota->tiponota }}</td>
                        <td>{{ $nota->responsableEmpleado->nombreemp ?? 'Sin asignar' }} {{ $nota->responsableEmpleado->apellidoemp ?? '' }}</td>
                        <td>{{ $nota->producto->codigo ?? 'Sin productos' }}</td>
                        <td>{{ $nota->producto->nombre ?? 'Sin productos' }}</td>
                        <td>{{ $nota->cantidad }}</td>
                        <td>{{ $nota->tipoEmpaque->nombretipoempaque ?? 'Sin asignar' }}</td>
                        <td>{{ $nota->fechanota }}</td>
                        <td>{{ $nota->bodega->nombrebodega ?? 'Sin asignar' }}</td>
                        <td>
                            <a href="{{ route('tipoNota.edit', $nota->idtiponota) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('tipoNota.destroy', $nota->idtiponota) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Está seguro de eliminar esta nota?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">No se encontraron notas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class="mt-3">
        {{ $tipoNotas->links() }}
    </div>
</div>
@endsection
