@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center">Lista de Empleados</h2>

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
    <form action="{{ route('empleado.index') }}" method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-6">
                <input type="text" name="search" class="form-control" placeholder="Buscar por nombre o Nro. de Identificación" value="{{ request()->search }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100" style="background-color: #88022D">Buscar</button>
            </div>
        </div>
    </form>

    <!-- Botones para crear nuevos registros -->
    <div class="mb-3 text-right">
        <a href="{{ route('empleado.create') }}" class="btn btn-primary" style="background-color: #88022D">Añadir Empleado</a>
        <a href="{{ route('cargo.create') }}" class="btn btn-primary" style="background-color: #88022D">Añadir Cargo</a>
        <a href="{{ route('tipoidentificacion.create') }}" class="btn btn-primary" style="background-color: #88022D">Añadir Tipo de Identidad</a>
    </div>

    <!-- Tabla de empleados -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Tipo de Identificación</th>
                <th>Bodega</th>
                <th>Cargo</th>
                <th>Email</th>
                <th>Nro. Identificación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($empleados as $empleado)
            <tr>
                <td>{{ $empleado->nombreemp }}</td>
                <td>{{ $empleado->apellidoemp }}</td>
                <td>{{ $empleado->tipoIdentificacion->nombreidentificacion ?? 'N/A' }}</td>
                <td>{{ $empleado->bodega->nombrebodega ?? 'N/A' }}</td>
                <td>{{ $empleado->cargo->nombrecargo ?? 'N/A' }}</td>
                <td>{{ $empleado->email }}</td>
                <td>{{ $empleado->nro_identificacion }}</td>
                <td>
                    <a href="{{ route('empleado.edit', $empleado->idempleado) }}" class="btn btn-sm btn-primary">Editar</a>
                    <form action="{{ route('empleado.destroy', $empleado->idempleado) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Está seguro de eliminar este empleado?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">No hay empleados registrados.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Paginación -->
    <div class="mt-3">
        {{ $empleados->links() }}
    </div>
</div>
@endsection
