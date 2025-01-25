@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="text-center">Crear Nuevo Tipo de Nota</h3>

    <!-- Alertas de validación -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Formulario -->
    <form action="{{ route('tipoNota.store') }}" method="POST">
        @csrf

        <div class="row mb-3">
            <div class="col-md-6 col-sm-12">
                <label for="tiponota" class="form-label">Tipo</label>
                <input type="text" name="tiponota" id="tiponota" class="form-control" placeholder="Tipo Nota (máx. 10 caracteres)" maxlength="10" required>
            </div>
            <div class="col-md-6 col-sm-12">
                <label for="responsable" class="form-label">Solicitante</label>
                <select name="responsable" id="responsable" class="form-control" required>
                    <option value="" disabled selected>Seleccione un solicitante</option>
                    @foreach ($empleados as $empleado)
                    <option value="{{ $empleado->idempleado }}">
                        {{ $empleado->nombreemp }} {{ $empleado->apellidoemp }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6 col-sm-12">
                <label for="fechanota" class="form-label">Fecha Solicitud</label>
                <input type="date" name="fechanota" id="fechanota" class="form-control" value="{{ now()->format('Y-m-d') }}" required readonly>
            </div>
            <div class="col-md-6 col-sm-12">
                <label for="fechaentrega" class="form-label">Fecha Entrega</label>
                <input type="date" name="fechaentrega" id="fechaentrega" class="form-control" min="{{ now()->addDay()->format('Y-m-d') }}" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6 col-sm-12">
                <label for="detalle" class="form-label">Descripción</label>
                <input type="text" name="detalle" id="detalle" class="form-control" placeholder="Detalle (máx. 50 caracteres)" maxlength="50" required>
            </div>
            <div class="col-md-6 col-sm-12">
                <label for="responsableentrega" class="form-label">Responsable Entrega</label>
                <select name="responsableentrega" id="responsableentrega" class="form-control" required>
                    <option value="" disabled selected>Seleccione un responsable</option>
                    @foreach ($empleados as $empleado)
                    <option value="{{ $empleado->idempleado }}">
                        {{ $empleado->nombreemp }} {{ $empleado->apellidoemp }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Botones -->
        <div class="d-flex justify-content-between">
            <a href="{{ route('tipoNota.index') }}" class="btn btn-secondary">Atrás</a>
            <button type="submit" class="btn btn-success">Guardar</button>
        </div>
    </form>
</div>
@endsection
