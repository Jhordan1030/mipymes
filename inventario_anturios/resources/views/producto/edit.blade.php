@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center">Editar Producto</h2>

    <!-- Alertas de validación -->
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

    <!-- Formulario -->
    <form action="{{ route('producto.update', $producto->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row mb-3">
            <div class="col-md-6 col-sm-12">
                <label for="codigo" class="form-label">Código</label>
                <input type="text" name="codigo" id="codigo" class="form-control" value="{{ $producto->codigo }}" required>
            </div>
            <div class="col-md-6 col-sm-12">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $producto->nombre }}" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-12 col-sm-12">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control" rows="3" required>{{ $producto->descripcion }}</textarea>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6 col-sm-12">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" name="cantidad" id="cantidad" class="form-control" value="{{ $producto->cantidad }}" required>
            </div>
            <div class="col-md-6 col-sm-12">
                <label for="codigotipoempaque" class="form-label">Tipo de Empaque</label>
                <select name="codigotipoempaque" id="codigotipoempaque" class="form-control">
                    <option value="">Seleccione un tipo de empaque</option>
                    @foreach ($tipoempaques as $tipoEmpaque)
                    <option value="{{ $tipoEmpaque->codigotipoempaque }}" {{ $producto->codigotipoempaque == $tipoEmpaque->codigotipoempaque ? 'selected' : '' }}>
                        {{ $tipoEmpaque->nombretipoempaque }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Botones -->
        <div class="d-flex justify-content-between mt-3">
            <a href="{{ route('producto.index') }}" class="btn btn-info">Atrás</a>
            <button type="submit" class="btn btn-success">Actualizar</button>
        </div>
    </form>
</div>
@endsection
