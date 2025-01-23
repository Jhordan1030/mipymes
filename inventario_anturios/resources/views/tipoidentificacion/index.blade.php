@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center">Tipos de Identificaciones</h2>

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
    <form action="{{ route('tipoidentificacion.index') }}" method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Buscar por nombre, ciudad o código" value="{{ request()->search }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Buscar</button>
            </div>
        </div>
    </form>

    <div class="mb-3 text-right">
        <a href="{{ route('tipoidentificacion.create') }}" class="btn btn-primary">Añadir Tipo identificacion</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                
                <th>Nombre Identificación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tipoIdentificaciones as $tipoidentificacion)
                <tr>
                    
                    <td>{{ $tipoidentificacion->nombreidentificacion }}</td>
                    
                    <td>
                        <a href="{{ route('tipoidentificacion.edit', $tipoidentificacion->ididentificacion) }}" class="btn btn-sm btn-primary">Editar</a>
                        <form action="{{ route('tipoidentificacion.destroy', $tipoidentificacion->ididentificacion) }}" method="POST" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este tipo de identificación?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No hay identificación registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Paginación -->
    <div class="mt-3">
        {{ $tipoIdentificaciones->links() }}
    </div>
</div>
@endsection
