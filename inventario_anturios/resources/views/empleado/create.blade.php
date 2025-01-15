@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Crear Empleado</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('empleado.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombreemp">Nombre</label>
            <input type="text" name="nombreemp" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="apellidoemp">Apellido</label>
            <input type="text" name="apellidoemp" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <!-- Select Tipo de Identificación -->
        <div class="form-group">
            <label for="ididentificacion">Tipo de Identificación</label>
            <select name="ididentificacion" id="ididentificacion" class="form-control" required>
                <option value="">Seleccione una opción</option>
                @foreach ($tipoIdentificaciones as $tipo)
                    <option value="{{ $tipo->ididentificacion }}">{{ $tipo->nombreidentificacion }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="nro_identificacion">Nro.identificacion</label>
            <input type="nro_identificacion" name="nro_identificacion" class="form-control" required>
        </div>


        <!-- Select Bodega -->
        <div class="form-group">
            <label for="idbodega">Bodega</label>
            <select name="idbodega" id="idbodega" class="form-control" required>
                <option value="">Seleccione una opción</option>
                @foreach ($bodegas as $bodega)
                    <option value="{{ $bodega->idbodega }}">{{ $bodega->nombrebodega }}</option>
                @endforeach
            </select>
        </div>

        <!-- Select Cargo -->
        <div class="form-group">
            <label for="idcargo">Cargo</label>
            <select name="idcargo" id="idcargo" class="form-control" required>
                <option value="">Seleccione una opción</option>
                @foreach ($cargos as $cargo)
                    <option value="{{ $cargo->idcargo }}">{{ $cargo->nombrecargo }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="nro_telefono">Teléfono</label>
            <input type="text" name="nro_telefono" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="direccionemp">Dirección</label>
            <input type="text" name="direccionemp" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection
