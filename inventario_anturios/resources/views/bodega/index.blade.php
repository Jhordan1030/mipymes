@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center">Listado De Bodegas</h2>

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
    <form action="{{ route('bodega.index') }}" method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Buscar por ID bodega" value="{{ request()->search }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Buscar</button>
            </div>
        </div>
    </form>

    <div class="mb-3 text-right">
        <a href="{{ route('bodega.create') }}" class="btn btn-primary">Añadir Bodega</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>

                <th>Id Bodega</th>
                <th>Nombre Bodega</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($bodegas as $bodega)
            <tr>

                <td>{{ $bodega->idbodega }}</td>
                <td>{{ $bodega->nombrebodega }}</td>

                <td>
                    <a href="{{ route('bodega.edit', $bodega->idbodega) }}" class="btn btn-sm btn-primary">Editar</a>
                    <form action="{{ route('bodega.destroy', $bodega->idbodega) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta bodega?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">No hay bodega registrada</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Paginación -->
    <div class="mt-3">
        {{ $bodegas->links() }}
    </div>
</div>
@endsection