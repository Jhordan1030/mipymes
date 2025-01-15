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
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nombreprod">Nombre del Producto</label>
                    <input type="text" name="nombreprod" id="nombreprod" class="form-control" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="descripcionprod">Descripción del Producto</label>
                    <input type="text" name="descripcionprod" id="descripcionprod" class="form-control" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="precio">Precio</label>
                    <input type="number" name="precio" id="precio" class="form-control" step="0.01" required>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="estadodisponibilidad">Disponibilidad</label>
                    <select name="estadodisponibilidad" id="estadodisponibilidad" class="form-control" required>
                        <option value="Disponible">Disponible</option>
                        <option value="No Disponible">No Disponible</option>
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="cantidadmin">Cantidad Mínima</label>
                    <input type="number" name="cantidadmin" id="cantidadmin" class="form-control" required>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="idtipoempaque">Tipo de Empaque</label>
            <select name="idtipoempaque" id="idtipoempaque" class="form-control">
                <option value="">Seleccione un tipo de empaque</option>
                @foreach ($tipoempaques as $tipoEmpaque)
                <option value="{{ $tipoEmpaque->idtipoempaque }}">{{ $tipoEmpaque->nombretipoempaque }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success mt-3">Guardar</button>
        <a href="{{ route('producto.index') }}" class="btn btn-info mt-3">Atrás</a>
    </form>
</div>
@endsection
