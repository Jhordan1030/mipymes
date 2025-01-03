@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Lista de Tipos de Estados</h3>
        <a href="{{ route('tipo_estado.create') }}" class="btn btn-primary mb-3">Añadir Tipo de Estado</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tipoEstados as $tipoEstado)
                    <tr>
                        <td>{{ $tipoEstado->nombre_estado }}</td>
                        <td>{{ $tipoEstado->descripcion_estado }}</td>
                        <td>
                            <a href="{{ route('tipo_estado.edit', $tipoEstado->id_estado) }}"
                                class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('tipo_estado.destroy', $tipoEstado->id_estado) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No hay registros.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="footer">
            <p>Creado por: Marcelo Chiriboga</p>
        </div>
        {{ $tipoEstados->links() }}
    </div>
@endsection
