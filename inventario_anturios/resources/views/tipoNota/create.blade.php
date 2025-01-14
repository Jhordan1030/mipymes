@extends('layout.app')
@section('content')
<div class="container">
    <h3>Crear Nuevo Tipo de Nota</h3>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('tipoNota.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="tiponota" class="form-label">Tipo Nota</label>
            <input type="text" name="tiponota" id="tiponota" class="form-control" placeholder="Tipo Nota (máx. 10 caracteres)" maxlength="10" required>
        </div>
        <div class="mb-3">
            <label for="responsable" class="form-label">Responsable</label>
            <input type="text" name="responsable" id="responsable" class="form-control" placeholder="Responsable (máx. 20 caracteres)" maxlength="20" required>
        </div>
        <div class="mb-3">
            <label for="fechanota" class="form-label">Fecha Nota</label>
            <input type="date" name="fechanota" id="fechanota" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="detalle" class="form-label">Detalle</label>
            <input type="text" name="detalle" id="detalle" class="form-control" placeholder="Detalle (máx. 50 caracteres)" maxlength="50" required>
        </div>
        <div class="mb-3">
            <label for="responsableentrega" class="form-label">Responsable Entrega</label>
            <input type="text" name="responsableentrega" id="responsableentrega" class="form-control" placeholder="Responsable Entrega (máx. 20 caracteres)" maxlength="20" required>
        </div>
        <div class="mb-3">
            <label for="fechaentrega" class="form-label">Fecha Entrega</label>
            <input type="date" name="fechaentrega" id="fechaentrega" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('tipoNota.index') }}" class="btn btn-secondary">Atrás</a>
    </form>
</div>
@endsection
