@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="text-center">Lista de Notas</h3>
        <a href="{{ route('tipoNota.create') }}" class="btn btn-primary mb-3">Crear Nota</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

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
                <th>ESTADO</th>
                <th>ACCIONES</th>
                <th>PDF</th>
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
                        @if($nota->transaccionProducto)
                            <span class="badge bg-info">{{ $nota->transaccionProducto->estado }}</span>
                        @else
                            <span class="badge bg-secondary">Sin Confirmar</span>
                        @endif
                    </td>
                    <td>
                        @if(!$nota->transaccionProducto)
                            <form action="{{ route('tipoNota.confirmar', $nota->codigo) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-success">Confirmar</button>
                            </form>
                        @endif
                        <a href="{{ route('tipoNota.edit', $nota->codigo) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('tipoNota.destroy', $nota->codigo) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta nota?')">Eliminar</button>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('tipoNota.pdf', $nota->codigo) }}" class="btn btn-danger">Descargar PDF</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $tipoNotas->links() }}
    </div>
@endsection
