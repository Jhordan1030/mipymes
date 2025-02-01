@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="text-center">Editar Producto</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('producto.update', $producto->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="codigo">Código</label>
                <input type="text" name="codigo" class="form-control" value="{{ $producto->codigo }}" required>
            </div>

            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control" value="{{ $producto->nombre }}" required>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" class="form-control" required>{{ $producto->descripcion }}</textarea>
            </div>

            <div class="form-group">
                <label for="cantidad">Cantidad</label>
                <input type="number" name="cantidad" class="form-control" value="{{ $producto->cantidad }}" required>
            </div>

            <div class="form-group">
                <label for="tipoempaque">Tipo de Empaque</label>
                <select name="tipoempaque" class="form-control">
                    <option value="">Seleccione un tipo de empaque</option>
                    @foreach ($tipoempaques as $tipo)
                        <option value="{{ $tipo }}" {{ $producto->tipoempaque == $tipo ? 'selected' : '' }}>{{ $tipo }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
@endsection
