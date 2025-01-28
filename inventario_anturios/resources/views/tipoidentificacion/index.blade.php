@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center">Tipos de Identificación</h2>

    <!-- Alertas de éxito o error -->
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Formulario para crear un nuevo tipo de identificación -->
    <div class="mb-4">
        <h4>Nuevo Tipo de Identificación</h4>
        <form action="{{ route('tipoidentificacion.store') }}" method="POST">
            @csrf
            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nombreidentificacion">Nombre del Tipo de Identificación</label>
                        <input type="text" name="nombreidentificacion" id="nombreidentificacion" class="form-control" required>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3" style="background-color: #88022D">Guardar</button>
        </form>
    </div>

    <!-- Tabla de tipos de identificación -->
    <div>
        <h4>Lista de Tipos de Identificación</h4>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Código Identificación</th>
                    <th>Nombre Identificación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tipoIdentificaciones as $tipoIdentificacion)
                <tr>
                    <td>{{ $tipoIdentificacion->ididentificacion }}</td>
                    <td>{{ $tipoIdentificacion->nombreidentificacion }}</td>
                    <td>
                        <a href="{{ route('tipoidentificacion.edit', $tipoIdentificacion->ididentificacion) }}" class="btn btn-sm btn-primary">Editar</a>
                        <form action="{{ route('tipoidentificacion.destroy', $tipoIdentificacion->ididentificacion) }}" method="POST" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este tipo de identificación?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center">No hay tipos de identificación registrados.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Paginación -->
        <div class="mt-3">
            {{ $tipoIdentificaciones->links() }}
        </div>
    </div>
</div>
@endsection
