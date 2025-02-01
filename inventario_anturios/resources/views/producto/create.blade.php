@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-center">Crear Nuevo Producto</h2>

        <!-- Formulario para crear un producto -->
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
                    <option value="Paquete">Paquete</option>
                    <option value="Caja">Caja</option>
                    <option value="Unidad">Unidad</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" style="background-color: #88022D">Guardar</button>
            <a href="{{ route('producto.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
