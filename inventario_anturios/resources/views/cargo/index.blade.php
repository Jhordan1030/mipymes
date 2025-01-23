@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center">Lista de Cargos</h2>

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
    <form action="{{ route('cargo.index') }}" method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Buscar por código cargo" value="{{ request()->search }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Buscar</button>
            </div>
        </div>
    </form>

    <div class="mb-3 text-right">
        <a href="{{ route('cargo.create') }}" class="btn btn-primary">Añadir Cargo</a>
    </div>

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
                        <a href="{{ route('cargo.edit', $cargo->idcargo) }}" class="btn btn-sm btn-primary">Editar</a>
                        <form action="{{ route('cargo.destroy', $cargo->idcargo) }}" method="POST" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este cargo?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No hay cargos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Paginación -->
    <div class="mt-3">
        {{ $cargos->links() }}
    </div>
</div>
@endsection
