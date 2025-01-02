@extends('plantilla.plantilla')
@section('content')
<div class="row">
    <section class="content">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Editar Producto</h3>
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route('producto.update', $producto->idproducto) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Nombre del Producto</label>
                            <input type="text" name="nombreproducto" class="form-control" value="{{ $producto->nombreproducto }}">
                        </div>
                        <div class="form-group">
                            <label>Descripción</label>
                            <textarea name="descripcionproducto" class="form-control">{{ $producto->descripcionproducto }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Cantidad Mínima</label>
                            <input type="number" name="cantidadminimaproducto" class="form-control" value="{{ $producto->cantidadminimaproducto }}">
                        </div>
                        <div class="form-group">
                            <label>Cantidad Máxima</label>
                            <input type="number" name="cantidadmaximaproducto" class="form-control" value="{{ $producto->cantidadmaximaproducto }}">
                        </div>
                        <div class="form-group">
                            <label>Tipo Empaque</label>
                            <select name="id_tipo__empaque" class="form-control">
                                <option value="">Sin empaque</option>
                                @foreach ($tipoEmpaques as $empaque)
                                    <option value="{{ $empaque->id_tipo__empaque }}" 
                                        {{ $producto->id_tipo__empaque == $empaque->id_tipo__empaque ? 'selected' : '' }}>
                                        {{ $empaque->descripcion_tipo__empaque }}
                                    </option>
                                @endforeach
                            </select>
                        </div>                        
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <a href="{{ route('producto.index') }}" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
