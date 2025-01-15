@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center">Listado de Productos</h2>

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
    <form action="{{ route('producto.index') }}" method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Buscar por nombre de producto" value="{{ request()->search }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Buscar</button>
            </div>
        </div>
    </form>

    <!-- Botón para crear un nuevo producto -->
    <div class="mb-3 text-right">
        <a href="{{ route('producto.create') }}" class="btn btn-primary">Añadir Producto</a>
        <a href="{{ route('tipoempaque.index') }}" class="btn btn-primary">Añadir Tipo de Empaque</a>
    </div>

    <!-- Tabla de productos -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Disponibilidad</th>
                <th>Cantidad Mínima</th>
                <th>Tipo Empaque</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($productos as $producto)
            <tr>
                <td>{{ $producto->idproducto }}</td>
                <td>{{ $producto->nombreprod }}</td>
                <td>{{ $producto->descripcionprod }}</td>
                <td>${{ number_format($producto->precio, 2) }}</td>
                <td>{{ $producto->estadodisponibilidad }}</td>
                <td>{{ $producto->cantidadmin }}</td>
                <td>{{ $producto->tipoEmpaque->nombretipoempaque ?? 'Sin asignar' }}</td>
                <td>
                    <a href="{{ route('producto.edit', $producto->idproducto) }}" class="btn btn-sm btn-primary">Editar</a>
                    <form action="{{ route('producto.destroy', $producto->idproducto) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este producto?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">No hay productos registrados.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Paginación -->
    <div class="mt-3">
        {{ $productos->links() }}
    </div>
</div>
@endsection
