@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="text-center">Editar Nota: {{ $tipoNota->codigo }}</h3>

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
            <label for="tiponota" class="form-label">Tipo de Nota</label>
            <select name="tiponota" class="form-control" required>
                <option value="ENVIO" {{ $tipoNota->tiponota == 'ENVIO' ? 'selected' : '' }}>Envío</option>
                <option value="DEVOLUCION" {{ $tipoNota->tiponota == 'DEVOLUCION' ? 'selected' : '' }}>Devolución</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="idempleado" class="form-label">Solicitante</label>
            <select name="idempleado" class="form-control" required>
                @foreach ($empleados as $empleado)
                    <option value="{{ $empleado->idempleado }}" {{ $tipoNota->idempleado == $empleado->idempleado ? 'selected' : '' }}>
                        {{ $empleado->nombreemp }} {{ $empleado->apellidoemp }}
                    </option>
                @endforeach
            </select>
        </div>

        <div id="productos-container">
            @foreach ($tipoNota->detalles as $detalle)
                <div class="producto-row row mb-3">
                    <div class="col-md-4">
                        <label for="codigoproducto[]" class="form-label">Producto</label>
                        <select name="codigoproducto[]" class="form-control" required>
                            @foreach ($productos as $producto)
                                <option value="{{ $producto->codigo }}" {{ $detalle->codigoproducto == $producto->codigo ? 'selected' : '' }}>
                                    {{ $producto->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="cantidad[]" class="form-label">Cantidad</label>
                        <input type="number" name="cantidad[]" class="form-control" value="{{ $detalle->cantidad }}" required>
                    </div>
                    <div class="col-md-3">
                        <label for="codigotipoempaque[]" class="form-label">Tipo de Empaque</label>
                        <select name="codigotipoempaque[]" class="form-control">
                            <option value="">Sin Empaque</option>
                            @foreach ($tipoempaques as $tipoEmpaque)
                                <option value="{{ $tipoEmpaque->codigotipoempaque }}" {{ $detalle->codigotipoempaque == $tipoEmpaque->codigotipoempaque ? 'selected' : '' }}>
                                    {{ $tipoEmpaque->nombretipoempaque }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-success">Actualizar Nota</button>
    </form>
</div>
@endsection
