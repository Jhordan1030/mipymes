@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Lista de Empleados</h2>
    <a href="{{ route('empleado.create') }}" class="btn btn-primary mb-3">Añadir Empleado</a>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Tipo de Identificación</th>
                <th>Bodega</th>
                <th>Cargo</th>
                <th>Email</th>
                <th>Nro.identificación</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($empleados as $empleado)
                <tr>
                    <td>{{ $empleado->nombreemp }}</td>
                    <td>{{ $empleado->apellidoemp }}</td>
                    <td>{{ $empleado->tipoIdentificacion->nombreidentificacion ?? 'N/A' }}</td>
                    <td>{{ $empleado->bodega->nombrebodega ?? 'N/A' }}</td>
                    <td>{{ $empleado->cargo->nombrecargo ?? 'N/A' }}</td>
                    <td>{{ $empleado->email }}</td>
                    <td>{{ $empleado->nro_identificacion }}</td>

                    <td>
                        <a href="{{ route('empleado.edit', $empleado->idempleado) }}" class="btn btn-primary">Editar</a>
                        <form action="{{ route('empleado.destroy', $empleado->idempleado) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('¿Está seguro de eliminar este empleado?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
