@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center">Cargos</h2>

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

    <!-- Formulario para crear un nuevo cargo -->
    <div class="mb-4">
        <h4>Nuevo Cargo</h4>
        <form action="{{ route('cargo.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="codigocargo">Código del Cargo</label>
                        <input type="text" name="codigocargo" id="codigocargo" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nombrecargo">Nombre del Cargo</label>
                        <input type="text" name="nombrecargo" id="nombrecargo" class="form-control" required>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3" style="background-color: #88022D">Guardar</button>
        </form>
    </div>

    <!-- Tabla de cargos -->
    <div>
        <h4>Lista de Cargos</h4>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Código Cargo</th>
                    <th>Nombre Cargo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($cargos as $cargo)
                <tr>
                    <td>{{ $cargo->codigocargo }}</td>
                    <td>{{ $cargo->nombrecargo }}</td>
                    <td>
                        <a href="{{ route('cargo.edit', $cargo->codigocargo) }}" class="btn btn-sm btn-primary">Editar</a>
                        <form action="{{ route('cargo.destroy', $cargo->codigocargo) }}" method="POST" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este cargo?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center">No hay cargos registrados.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Paginación -->
        <div class="mt-3">
            {{ $cargos->links() }}
        </div>
    </div>
</div>
@endsection
