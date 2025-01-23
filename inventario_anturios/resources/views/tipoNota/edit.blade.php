@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="text-center">Editar Tipo de Nota</h3>

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

    <!-- Formulario de edición -->
    <form action="{{ route('tipoNota.update', $tipoNota->idtiponota) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="row mb-3">
            <div class="col-md-6 col-sm-12">
                <label for="tiponota" class="form-label">Tipo</label>
                <input type="text" name="tiponota" id="tiponota" class="form-control" value="{{ $tipoNota->tiponota }}" maxlength="10" required>
            </div>
            <div class="col-md-6 col-sm-12">
                <label for="responsable" class="form-label">Solicitante</label>
                <input type="text" name="responsable" id="responsable" class="form-control" value="{{ $tipoNota->responsable }}" maxlength="20" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6 col-sm-12">
                <label for="fechanota" class="form-label">Fecha Solicitud</label>
                <input type="date" name="fechanota" id="fechanota" class="form-control" value="{{ $tipoNota->fechanota }}" required>
            </div>
            <div class="col-md-6 col-sm-12">
                <label for="fechaentrega" class="form-label">Fecha Entrega</label>
                <input type="date" name="fechaentrega" id="fechaentrega" class="form-control" value="{{ $tipoNota->fechaentrega }}" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6 col-sm-12">
                <label for="detalle" class="form-label">Descripción</label>
                <input type="text" name="detalle" id="detalle" class="form-control" value="{{ $tipoNota->detalle }}" maxlength="50" required>
            </div>
            <div class="col-md-6 col-sm-12">
                <label for="responsableentrega" class="form-label">Responsable Entrega</label>
                <input type="text" name="responsableentrega" id="responsableentrega" class="form-control" value="{{ $tipoNota->responsableentrega }}" maxlength="20" required>
            </div>
        </div>

        <!-- Botones de acción -->
        <div class="d-flex justify-content-between">
            <a href="{{ route('tipoNota.index') }}" class="btn btn-secondary">Atrás</a>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </div>
    </form>
</div>
@endsection
