@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="text-center">Editar Tipo de Nota</h3>

    <!-- Alertas de validación -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulario -->
    <form action="{{ route('tipoNota.update', $tipoNota->idtiponota) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row mb-3">
            <div class="col-md-6 col-sm-12">
                <label for="tiponota" class="form-label">Tipo</label>
                <select name="tiponota" id="tiponota" class="form-control" required>
                    <option value="ENVIO" {{ $tipoNota->tiponota == 'ENVIO' ? 'selected' : '' }}>Envío</option>
                    <option value="DEVOLUCION" {{ $tipoNota->tiponota == 'DEVOLUCION' ? 'selected' : '' }}>Devolución</option>
                </select>
            </div>

            <div class="col-md-6 col-sm-12">
                <label for="idempleado" class="form-label">Solicitante</label>
                <select name="idempleado" id="idempleado" class="form-control" required>
                    <option value="" disabled>Seleccione un solicitante</option>
                    @foreach ($empleados as $empleado)
                        <option value="{{ $empleado->idempleado }}" {{ $tipoNota->idempleado == $empleado->idempleado ? 'selected' : '' }}>
                            {{ $empleado->nombreemp }} {{ $empleado->apellidoemp }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Productos y detalles -->
        <div id="productos-container">
            @foreach ($productos as $producto)
            <div class="form-group row producto-row">
                <div class="col-md-4">
                    <label for="codigoproducto[]" class="form-label">Código del Producto</label>
                    <select name="codigoproducto[]" class="form-control" required>
                        <option value="" disabled>Seleccione un producto</option>
                        @foreach ($productos as $prod)
                            <option value="{{ $prod->codigo }}" {{ $producto->codigo == $prod->codigo ? 'selected' : '' }}>
                                {{ $prod->codigo }} - {{ $prod->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="cantidad[]" class="form-label">Cantidad</label>
                    <input type="number" name="cantidad[]" class="form-control" value="{{ $producto->cantidad }}" required>
                </div>

                <div class="col-md-3">
                    <label for="codigotipoempaque[]" class="form-label">Tipo de Empaque</label>
                    <select name="codigotipoempaque[]" class="form-control" required>
                        @foreach ($tipoempaques as $tipoEmpaque)
                            <option value="{{ $tipoEmpaque->codigotipoempaque }}" {{ $producto->codigotipoempaque == $tipoEmpaque->codigotipoempaque ? 'selected' : '' }}>
                                {{ $tipoEmpaque->nombretipoempaque }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Fechas -->
        <div class="row mb-3 mt-4">
            <div class="col-md-6 col-sm-12">
                <label for="fechanota" class="form-label">Fecha Solicitud</label>
                <input type="date" name="fechanota" id="fechanota" class="form-control" value="{{ $tipoNota->fechanota }}" required readonly>
            </div>
        </div>

        <!-- Bodega -->
        <div class="form-group mb-3">
            <label for="idbodega" class="form-label">Bodega</label>
            <select name="idbodega" id="idbodega" class="form-control" required>
                <option value="" disabled>Seleccione una bodega</option>
                @foreach ($bodegas as $bodega)
                    <option value="{{ $bodega->idbodega }}" {{ $tipoNota->idbodega == $bodega->idbodega ? 'selected' : '' }}>
                        {{ $bodega->nombrebodega }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Botones -->
        <div class="d-flex justify-content-between">
            <a href="{{ route('tipoNota.index') }}" class="btn btn-secondary">Atrás</a>
            <button type="submit" class="btn btn-success">Actualizar</button>
        </div>
    </form>
</div>
@endsection
