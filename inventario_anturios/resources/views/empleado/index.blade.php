@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-center">Lista de Empleados</h2>

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
        <form action="{{ route('empleado.index') }}" method="GET" class="mb-3">
            <div class="row">
                <div class="col-md-6">
                    <input type="text" name="search" class="form-control"
                        placeholder="Buscar por nombre o Nro. de Identificación" value="{{ request()->search }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100" style="background-color: #88022D">Buscar</button>
                </div>
            </div>
        </form>

        <!-- Botones para crear nuevos registros -->
        <div class="mb-3 text-right">
            <a href="{{ route('empleado.create') }}" class="btn btn-primary" style="background-color: #88022D">Añadir
                Empleado</a>
            <a href="{{ route('cargo.index') }}" class="btn btn-primary" style="background-color: #88022D">Añadir Cargo</a>
        </div>

        <!-- Tabla de empleados -->
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nro. Identificación</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Tipo de Identificación</th>
                    <th>Bodega</th>
                    <th>Cargo</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($empleados as $empleado)
                    <tr>
                        <td>{{ $empleado->nro_identificacion }}</td>
                        <td>{{ $empleado->nombreemp }}</td>
                        <td>{{ $empleado->apellidoemp }}</td>
                        <td>{{ $empleado->tipo_identificacion }}</td>
                        <td>{{ $empleado->bodega->nombrebodega ?? 'N/A' }}</td>
                        <td>{{ $empleado->cargo->nombrecargo ?? 'N/A' }}</td>

                        <!-- Columna de Email con ícono para copiar -->
                        <td>
                            <span id="email-{{ $empleado->nro_identificacion }}">{{ $empleado->email }}</span>
                            <button class="btn btn-sm btn-secondary"
                                onclick="copyToClipboard('{{ $empleado->nro_identificacion }}')">
                                <i id="icon-{{ $empleado->nro_identificacion }}" class="fas fa-copy"></i> Copiar
                            </button>
                        </td>

                        <td>
                            <a href="{{ route('empleado.edit', $empleado->nro_identificacion) }}"
                                class="btn btn-sm btn-primary">Editar</a>
                            <form action="{{ route('empleado.destroy', $empleado->nro_identificacion) }}" method="POST"
                                class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('¿Está seguro de eliminar este empleado?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No hay empleados registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Paginación -->
        <div class="mt-3">
            {{ $empleados->links() }}
        </div>
    </div>

    <!-- Script para copiar al portapapeles -->
    <script>
        function copyToClipboard(nro_identificacion) {
            var emailText = document.getElementById('email-' + nro_identificacion).innerText;
            var textarea = document.createElement('textarea');
            textarea.value = emailText;
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand('copy');
            document.body.removeChild(textarea);

            // Cambiar el ícono a un "check" verde
            var icon = document.getElementById('icon-' + nro_identificacion);
            icon.classList.remove('fa-copy'); // Elimina el ícono de copiar
            icon.classList.add('fa-check'); // Añade el ícono de "check"
            icon.style.color = 'green'; // Cambia el color a verde
        }
    </script>
@endsection
