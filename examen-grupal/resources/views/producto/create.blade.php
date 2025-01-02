@extends('plantilla.plantilla')
@section('content')
    <div class="row">
        <section class="content">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Nuevo Producto</h3>
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="{{ route('producto.store') }}">
                            @csrf
                            <div class="form-group">
                                <label>Nombre del Producto</label>
                                <input type="text" name="nombreproducto" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Descripción</label>
                                <textarea name="descripcionproducto" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Cantidad Mínima</label>
                                <input type="number" name="cantidadminimaproducto" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Cantidad Máxima</label>
                                <input type="number" name="cantidadmaximaproducto" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Tipo Empaque</label>
                                <select name="id_tipo__empaque" class="form-control">
                                    <option value="">Seleccione un tipo de empaque</option>
                                    @foreach ($tipoEmpaques as $tipoEmpaque)
                                        <option value="{{ $tipoEmpaque->id_tipo__empaque }}">{{ $tipoEmpaque->descripcion_tipo__empaque }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">Guardar</button>
                            <a href="{{ route('producto.index') }}" class="btn btn-secondary">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
