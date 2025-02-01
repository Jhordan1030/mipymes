@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="text-center">Crear Producto</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('producto.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="codigo">Código</label>
                <input type="text" name="codigo" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label for="cantidad">Cantidad</label>
                <input type="number" name="cantidad" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="tipoempaque">Tipo de Empaque</label>
                <select name="tipoempaque" class="form-control">
                    <option value="">Seleccione un tipo de empaque</option>
                    @foreach ($tipoempaques as $tipo)
                        <option value="{{ $tipo }}">{{ $tipo }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
@endsection
