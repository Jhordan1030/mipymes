@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Crear Nuevo Tipo de Estado</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tipo_estado.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nombre_estado" class="form-label">Nombre</label>
            <input type="text" name="nombre_estado" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="descripcion_estado" class="form-label">Descripción</label>
            <textarea name="descripcion_estado" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('tipo_estado.index') }}" class="btn btn-secondary">Atrás</a>
    </form>
</div>
@endsection
