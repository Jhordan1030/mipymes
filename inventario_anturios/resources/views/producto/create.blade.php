@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="text-center">Crear Producto</h3>

        <!-- Mostrar error general del trigger si ocurre -->
        @if (session('error'))
            <div class="alert alert-danger">
                <strong>Error:</strong> {{ session('error') }}
            </div>
        @endif

        <!-- Mostrar mensaje de éxito -->
        @if (session('success'))
            <div class="alert alert-success">
                <strong>Éxito:</strong> {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('producto.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="codigo">Código</label>
                <input type="text" name="codigo" class="form-control @error('codigo') is-invalid @enderror"
                       required value="{{ old('codigo') }}">
                @error('codigo')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror"
                       required value="{{ old('nombre') }}">
                @error('nombre')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" required>{{ old('descripcion') }}</textarea>
                @error('descripcion')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="cantidad">Cantidad</label>
                <input type="number" name="cantidad" class="form-control @error('cantidad') is-invalid @enderror"
                       required value="{{ old('cantidad') }}" min="1">
                @error('cantidad')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="tipoempaque">Tipo de Empaque</label>
                <select name="tipoempaque" class="form-control @error('tipoempaque') is-invalid @enderror">
                    <option value="">Seleccione un tipo de empaque</option>
                    @foreach ($tipoempaques as $tipo)
                        <option value="{{ $tipo }}" {{ old('tipoempaque') == $tipo ? 'selected' : '' }}>
                            {{ $tipo }}
                        </option>
                    @endforeach
                </select>
                @error('tipoempaque')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
@endsection
