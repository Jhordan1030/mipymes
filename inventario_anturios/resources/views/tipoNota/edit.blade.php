@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="text-center">Editar Nota</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tipoNota.update', $tipoNota->idtiponota) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="tiponota">Tipo</label>
                <select name="tiponota" id="tiponota" class="form-control" required>
                    <option value="ENVIO" {{ $tipoNota->tiponota === 'ENVIO' ? 'selected' : '' }}>Envío</option>
                    <option value="DEVOLUCION" {{ $tipoNota->tiponota === 'DEVOLUCION' ? 'selected' : '' }}>Devolución</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="responsable">Solicitante</label>
                <select name="responsable" id="responsable" class="form-control" required>
                    @foreach ($empleados as $empleado)
                        <option value="{{ $empleado->idempleado }}" {{ $tipoNota->responsable == $empleado->idempleado ? 'selected' : '' }}>
                            {{ $empleado->nombreemp }} {{ $empleado->apellidoemp }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="codigoproducto">Código del Producto</label>
                <input type="text" name="codigoproducto" id="codigoproducto" value="{{ $tipoNota->codigoproducto }}" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="cantidad">Cantidad</label>
                <input type="number" name="cantidad" id="cantidad" value="{{ $tipoNota->cantidad }}" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="fechanota">Fecha de Solicitud</label>
                <input type="date" name="fechanota" id="fechanota" value="{{ $tipoNota->fechanota }}" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="idbodega">Bodega</label>
                <select name="idbodega" id="idbodega" class="form-control" required>
                    @foreach ($bodegas as $bodega)
                        <option value="{{ $bodega->idbodega }}" {{ $tipoNota->idbodega == $bodega->idbodega ? 'selected' : '' }}>
                            {{ $bodega->nombrebodega }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('tipoNota.index') }}" class="btn btn-secondary">Atrás</a>
            <button type="submit" class="btn btn-success">Guardar Cambios</button>
        </div>
    </form>
</div>
@endsection
