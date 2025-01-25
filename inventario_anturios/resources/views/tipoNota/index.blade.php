@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center">Lista de Notas</h2>

    <!-- Alertas de éxito o error -->
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <!-- Formulario de búsqueda -->
    <form action="{{ route('tipoNota.index') }}" method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <input type="text" name="search" class="form-control" placeholder="Buscar por tipo o responsable" value="{{ request()->search }}">
            </div>
            <div class="col-md-4 col-sm-12 mt-2 mt-md-0">
                <button type="submit" class="btn btn-primary w-100" style="background-color: #88022D">Buscar</button>
            </div>
        </div>
    </form>

    <!-- Botón para crear una nueva nota -->
    <div class="mb-3 text-right">
        <a href="{{ route('tipoNota.create') }}" class="btn btn-primary" style="background-color: #88022D"  >Añadir Nota</a>
    </div>

    <!-- Tabla de notas -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Tipo</th>
                    <th>Solicitante</th>
                    <th>Fecha Solicitud</th>
                    <th>Descripción</th>
                    <th>Responsable Entrega</th>
                    <th>Fecha Entrega</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tipoNotas as $nota)
                <tr>
                    <td>{{ $nota->tiponota }}</td>
                    <td>{{ $nota->responsableEmpleado->nombreemp }} {{ $nota->responsableEmpleado->apellidoemp }}</td>
                    <td>{{ $nota->fechanota }}</td>
                    <td>{{ $nota->detalle }}</td>
                    <td>{{ $nota->responsableEntregaEmpleado->nombreemp }} {{ $nota->responsableEntregaEmpleado->apellidoemp }}</td>
                    <td>{{ $nota->fechaentrega }}</td>
                    <td>
                        <a href="{{ route('tipoNota.edit', $nota->idtiponota) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('tipoNota.destroy', $nota->idtiponota) }}" method="POST" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Está seguro de eliminar esta nota?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">No hay notas registradas.</td>
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
