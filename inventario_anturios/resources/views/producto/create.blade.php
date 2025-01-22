@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center">Crear Nuevo Producto</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Error!</strong> Hay problemas con los datos ingresados.<br><br>
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
            <input type="text" name="codigo" id="codigo" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control" rows="3" required></textarea>
        </div>

        <div class="form-group">
            <label for="cantidad">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="codigotipoempaque">Tipo de Empaque</label>
            <select name="codigotipoempaque" id="codigotipoempaque" class="form-control">
                <option value="">Seleccione un tipo de empaque</option>
                @foreach ($tipoempaques as $tipoEmpaque)
                <option value="{{ $tipoEmpaque->codigotipoempaque }}">{{ $tipoEmpaque->nombretipoempaque }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success mt-3">Guardar</button>
        <a href="{{ route('producto.index') }}" class="btn btn-info mt-3">Atrás</a>
    </form>
</div>
@endsection
