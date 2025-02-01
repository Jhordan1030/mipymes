@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-center">Editar Producto</h2>

        <!-- Formulario para editar un producto -->
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
                    <option value="Paquete" {{ $producto->tipoempaque == 'Paquete' ? 'selected' : '' }}>Paquete</option>
                    <option value="Caja" {{ $producto->tipoempaque == 'Caja' ? 'selected' : '' }}>Caja</option>
                    <option value="Unidad" {{ $producto->tipoempaque == 'Unidad' ? 'selected' : '' }}>Unidad</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" style="background-color: #88022D">Actualizar</button>
            <a href="{{ route('producto.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
