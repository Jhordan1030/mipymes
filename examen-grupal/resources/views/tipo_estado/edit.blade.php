@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Editar Tipo de Estado</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tipo_estado.update', $tipoEstado->id_estado) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label for="nombre_estado" class="form-label">Nombre</label>
            <input type="text" name="nombre_estado" class="form-control" value="{{ $tipoEstado->nombre_estado }}" required>
        </div>
        <div class="mb-3">
            <label for="descripcion_estado" class="form-label">Descripción</label>
            <textarea name="descripcion_estado" class="form-control" required>{{ $tipoEstado->descripcion_estado }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('tipo_estado.index') }}" class="btn btn-secondary">Atrás</a>
    </form>
</div>
@endsection