@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="text-center">Lista de Notas</h3>
    <a href="{{ route('tipoNota.create') }}" class="btn btn-primary mb-3">Crear Nota</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>CÓDIGO</th>
                <th>TIPO</th>
                <th>SOLICITANTE</th>
                <th>PRODUCTOS</th>
                <th>CANTIDAD</th>
                <th>TIPO EMPAQUE</th>
                <th>BODEGA</th>
                <th>FECHA</th>
                <th>ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tipoNotas as $nota)
                <tr>
                    <td>{{ $nota->codigo }}</td>
                    <td>{{ $nota->tiponota }}</td>
                    <td>{{ $nota->responsableEmpleado->nombreemp ?? 'N/A' }}</td>
                    <td>
                        <ul>
                            @foreach ($nota->detalles as $detalle)
                                <li>{{ $detalle->producto->nombre ?? 'N/A' }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <ul>
                            @foreach ($nota->detalles as $detalle)
                                <li>{{ $detalle->cantidad }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <ul>
                            @foreach ($nota->detalles as $detalle)
                                <li>{{ $detalle->tipoEmpaque->nombretipoempaque ?? 'Sin Empaque' }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ $nota->bodega->nombrebodega ?? 'N/A' }}</td>
                    <td>{{ $nota->fechanota }}</td>
                    <td>
                        <a href="{{ route('tipoNota.edit', $nota->idtiponota) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('tipoNota.destroy', $nota->idtiponota) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $tipoNotas->links() }}
</div>
@endsection
