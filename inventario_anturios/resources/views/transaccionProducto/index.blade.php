@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="text-center">Gestión de Transacciones</h3>

    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('tipoNota.index') }}" class="btn btn-primary">Nueva Transacción</a>
        <form action="{{ route('transaccionProducto.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control w-25" placeholder="Buscar por código de nota" value="{{ request('search') }}">
            <button type="submit" class="btn btn-secondary ms-2">Buscar</button>
        </form>
    </div>

    <div class="row text-center">
        <!-- Tarjeta de Transacciones Pendientes -->
        <div class="col-md-6">
            <div class="border border-warning p-3">
                <h5 class="text-warning">Transacciones Pendientes</h5>
                <h2>{{ $pendientes ?? 0 }}</h2>
            </div>
        </div>

        <!-- Tarjeta de Transacciones Finalizadas -->
        <div class="col-md-6">
            <div class="border border-success p-3">
                <h5 class="text-success">Transacciones Finalizadas</h5>
                <h2>{{ $finalizadas ?? 0 }}</h2>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-3">
        <a href="{{ route('transaccionProducto.index') }}" class="btn btn-secondary {{ request('estado') ? '' : 'active' }}">Todos</a>
        <a href="{{ route('transaccionProducto.index', ['estado' => 'PENDIENTE']) }}" class="btn btn-warning mx-2 {{ request('estado') == 'PENDIENTE' ? 'active' : '' }}">Pendientes</a>
        <a href="{{ route('transaccionProducto.index', ['estado' => 'FINALIZADA']) }}" class="btn btn-success {{ request('estado') == 'FINALIZADA' ? 'active' : '' }}">Finalizados</a>
    </div>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>CÓDIGO NOTA</th>
                <th>TIPO NOTA</th>
                <th>ESTADO</th>
                <th>PRODUCTOS</th>
                <th>ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transacciones as $transaccion)
                <tr>
                    <td>{{ $transaccion->tipoNota->codigo }}</td>
                    <td>{{ $transaccion->tipoNota->tiponota }}</td>
                    <td>
                        <span class="badge {{ $transaccion->estado == 'PENDIENTE' ? 'bg-warning' : 'bg-success' }}">
                            {{ $transaccion->estado }}
                        </span>
                    </td>
                    <td>
                        <ul>
                            @foreach ($transaccion->tipoNota->detalles as $detalle)
                                <li>
                                    <strong>Producto:</strong> {{ $detalle->producto->nombre ?? 'N/A' }} <br>
                                    <strong>Cantidad:</strong> {{ $detalle->cantidad }} <br>
                                    <strong>Empaque:</strong> {{ $detalle->tipoEmpaque->nombretipoempaque ?? 'Sin Empaque' }}
                                </li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        @if($transaccion->estado == 'PENDIENTE')
                            <form action="{{ route('transaccionProducto.finalizar', $transaccion->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-success">Finalizar</button>
                            </form>
                        @else
                            <span class="badge bg-secondary">Completado</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Paginación -->
    <div class="d-flex justify-content-center">
        {{ $transacciones->appends(['estado' => request('estado'), 'search' => request('search')])->links() }}
    </div>
</div>
@endsection
