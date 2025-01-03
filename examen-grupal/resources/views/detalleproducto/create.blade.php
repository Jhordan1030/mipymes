@extends('plantilla.plantilla')
@section('content')
    <div class="row">
        <section class="content">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Nuevo Detalle de Producto</h3>
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="{{ route('detalleproducto.store') }}">
                            @csrf
                            <div class="form-group">
                                <label>Producto</label>
                                <select name="idproducto" class="form-control">
                                    <option value="">Seleccione un producto</option>
                                    @foreach ($productos as $producto)
                                        <option value="{{ $producto->idproducto }}">{{ $producto->nombreproducto }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Especificaciones</label>
                                <input type="text" name="especificacionesproducto" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Precio</label>
                                <input type="number" name="preciodetalleproducto" class="form-control" step="0.01">
                            </div>
                            <div class="form-group">
                                <label>Fecha de Ingreso</label>
                                <input type="date" name="fechaingresodetalleproducto" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-success">Guardar</button>
                            <a href="{{ route('detalleproducto.index') }}" class="btn btn-secondary">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
