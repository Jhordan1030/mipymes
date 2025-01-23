@extends('layouts.app')
@section('content')
<div class="container">
    <h2 class="text-center my-4">Crear Empleado</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('empleado.store') }}" method="POST" class="row g-3">
        @csrf

        <div class="col-md-6">
            <label for="nombreemp" class="form-label">Nombre</label>
            <input type="text" name="nombreemp" id="nombreemp" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label for="apellidoemp" class="form-label">Apellido</label>
            <input type="text" name="apellidoemp" id="apellidoemp" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label for="ididentificacion" class="form-label">Tipo de Identificación</label>
            <select name="ididentificacion" id="ididentificacion" class="form-select" required>
                <option value="">Seleccione una opción</option>
                @foreach ($tipoIdentificaciones as $tipo)
                    <option value="{{ $tipo->ididentificacion }}">{{ $tipo->nombreidentificacion }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <label for="nro_identificacion" class="form-label">Nro. Identificación</label>
            <input type="text" name="nro_identificacion" id="nro_identificacion" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label for="idbodega" class="form-label">Bodega</label>
            <select name="idbodega" id="idbodega" class="form-select" required>
                <option value="">Seleccione una opción</option>
                @foreach ($bodegas as $bodega)
                    <option value="{{ $bodega->idbodega }}">{{ $bodega->nombrebodega }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <label for="idcargo" class="form-label">Cargo</label>
            <select name="idcargo" id="idcargo" class="form-select" required>
                <option value="">Seleccione una opción</option>
                @foreach ($cargos as $cargo)
                    <option value="{{ $cargo->idcargo }}">{{ $cargo->nombrecargo }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <label for="nro_telefono" class="form-label">Teléfono</label>
            <input type="text" name="nro_telefono" id="nro_telefono" class="form-control" required>
        </div>

        <div class="col-md-12">
            <label for="direccionemp" class="form-label">Dirección</label>
            <input type="text" name="direccionemp" id="direccionemp" class="form-control" required>
        </div>

        <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </form>
</div>
@endsection
