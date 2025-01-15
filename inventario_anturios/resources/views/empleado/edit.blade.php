@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Editar Empleado</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('empleado.update', $empleado->idempleado) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <label for="nombreemp">Nombre</label>
            <input type="text" name="nombreemp" class="form-control" value="{{ $empleado->nombreemp }}" required>
        </div>

        <div class="form-group">
            <label for="apellidoemp">Apellido</label>
            <input type="text" name="apellidoemp" class="form-control" value="{{ $empleado->apellidoemp }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $empleado->email }}" required>
        </div>

        <div class="form-group">
            <label for="ididentificacion">Tipo de Identificación</label>
            <select name="ididentificacion" id="ididentificacion" class="form-control" required>
                <option value="">Seleccione una opción</option>
                @foreach ($tipoIdentificaciones as $tipo)
                    <option value="{{ $tipo->ididentificacion }}" {{ $empleado->ididentificacion == $tipo->ididentificacion ? 'selected' : '' }}>
                        {{ $tipo->nombreidentificacion }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="idbodega">Bodega</label>
            <select name="idbodega" id="idbodega" class="form-control" required>
                <option value="">Seleccione una opción</option>
                @foreach ($bodegas as $bodega)
                    <option value="{{ $bodega->idbodega }}" {{ $empleado->idbodega == $bodega->idbodega ? 'selected' : '' }}>
                        {{ $bodega->nombrebodega }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="idcargo">Cargo</label>
            <select name="idcargo" id="idcargo" class="form-control" required>
                <option value="">Seleccione una opción</option>
                @foreach ($cargos as $cargo)
                    <option value="{{ $cargo->idcargo }}" {{ $empleado->idcargo == $cargo->idcargo ? 'selected' : '' }}>
                        {{ $cargo->nombrecargo }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="nro_telefono">Teléfono</label>
            <input type="text" name="nro_telefono" class="form-control" value="{{ $empleado->nro_telefono }}" required>
        </div>

        <div class="form-group">
            <label for="nro_identificacion">Nro.identificacion</label>
            <input type="text" name="nro_identificacion" class="form-control" value="{{ $empleado->nro_identificacion }}" required>
        </div>

        <div class="form-group">
            <label for="direccionemp">Dirección</label>
            <input type="text" name="direccionemp" class="form-control" value="{{ $empleado->direccionemp }}" required>
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('empleado.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
