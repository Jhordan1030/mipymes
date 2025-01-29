@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="text-center">Editar Tipo de Nota</h3>

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

        <div class="mb-3">
            <label for="codigo" class="form-label">Código de Nota</label>
            <input type="text" name="codigo" id="codigo" class="form-control" value="{{ $tipoNota->codigo }}" readonly>
        </div>

        <div class="mb-3">
            <label for="tiponota" class="form-label">Tipo</label>
            <select name="tiponota" id="tiponota" class="form-control" required>
                <option value="ENVIO" {{ $tipoNota->tiponota == 'ENVIO' ? 'selected' : '' }}>Envío</option>
                <option value="DEVOLUCION" {{ $tipoNota->tiponota == 'DEVOLUCION' ? 'selected' : '' }}>Devolución</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="idempleado" class="form-label">Solicitante</label>
            <select name="idempleado" id="idempleado" class="form-control" required>
                @foreach ($empleados as $empleado)
                    <option value="{{ $empleado->idempleado }}" {{ $tipoNota->idempleado == $empleado->idempleado ? 'selected' : '' }}>
                        {{ $empleado->nombreemp }} {{ $empleado->apellidoemp }}
                    </option>
                @endforeach
            </select>
        </div>

        <div id="productos-container">
            <div class="producto-row row mb-3">
                <div class="col-md-4">
                    <label for="codigoproducto" class="form-label">Código de Producto</label>
                    <select name="codigoproducto" class="form-control" required>
                        @foreach ($productos as $producto)
                            <option value="{{ $producto->codigo }}" {{ $tipoNota->codigoproducto == $producto->codigo ? 'selected' : '' }}>
                                {{ $producto->codigo }} - {{ $producto->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="cantidad" class="form-label">Cantidad</label>
                    <input type="number" name="cantidad" class="form-control" value="{{ $tipoNota->cantidad }}" required>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="codigotipoempaque" class="form-label">Tipo de Empaque</label>
            <select name="codigotipoempaque" id="codigotipoempaque" class="form-control" required>
                @foreach ($tipoempaques as $tipoEmpaque)
                    <option value="{{ $tipoEmpaque->codigotipoempaque }}" {{ $tipoNota->codigotipoempaque == $tipoEmpaque->codigotipoempaque ? 'selected' : '' }}>
                        {{ $tipoEmpaque->nombretipoempaque }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="idbodega" class="form-label">Bodega</label>
            <select name="idbodega" id="idbodega" class="form-control" required>
                @foreach ($bodegas as $bodega)
                    <option value="{{ $bodega->idbodega }}" {{ $tipoNota->idbodega == $bodega->idbodega ? 'selected' : '' }}>
                        {{ $bodega->nombrebodega }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('tipoNota.index') }}" class="btn btn-secondary">Atrás</a>
            <button type="submit" class="btn btn-success">Actualizar</button>
        </div>
    </form>
</div>
@endsection