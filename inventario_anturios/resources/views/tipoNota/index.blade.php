@extends('layouts.app')
@section('content')
<div class="container">
    <h3>Lista de Notas</h3>
    <a href="{{ route('tipoNota.create') }}" class="btn btn-primary mb-3">Añadir Nota</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Tipo</th>
                <th>Solicitante</th>
                <th>Fecha Solicitud</th>
                <th>Descripcion</th>
                <th>Responsable Entrega</th>
                <th>Fecha Entrega</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tipoNotas as $nota)
            <tr>
                <td>{{ $nota->tiponota }}</td>
                <td>{{ $nota->responsable }}</td>
                <td>{{ $nota->fechanota }}</td>
                <td>{{ $nota->detalle }}</td>
                <td>{{ $nota->responsableentrega }}</td>
                <td>{{ $nota->fechaentrega }}</td>
                <td>
                    <a href="{{ route('tipoNota.edit', $nota->idtiponota) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('tipoNota.destroy', $nota->idtiponota) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $tipoNotas->links() }}
</div>
@endsection
