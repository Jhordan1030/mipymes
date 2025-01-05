@extends('layouts.app')

@section('content')
    <div class="row">
        <section class="content">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Detalle de Ubicación</h3>
                    </div>
                    <div class="panel-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Error!</strong> Revise los campos obligatorios.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('detalle_ubicacion.store') }}" role="form">
                            @csrf
                            <div class="form-group">
                                <label for="idubicacion">Ubicación</label>
                                <select name="idubicacion" class="form-control" required>
                                    <option value="">Seleccione una ubicación</option>
                                    @foreach ($ubicaciones as $ubicacion)
                                        <option value="{{ $ubicacion->idubicacion }}">{{ $ubicacion->nombreUbicacion }}</option>
                                    @endforeach
                                </select>
                                
                            </div>

                            <div class="form-group">
                                <label for="idproducto">Producto</label>
                                <select name="idproducto" class="form-control" required>
                                    <option value="">Seleccione un producto</option>
                                    @foreach ($productos as $producto)
                                        <option value="{{ $producto->idproducto }}">{{ $producto->nombreproducto }}</option>
                                    @endforeach
                                </select>
                                
                            </div>

                            <div class="form-group">
                                <label for="especificacionesdetalleubicacion">Especificacion Detalle Ubicación</label>
                                <input type="text" name="especificacionesdetalleubicacion" class="form-control" placeholder="Ingrese Detalles de la Ubicación" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="fechaingresodetalleproducto">Fecha Ingreso de Detalle</label>
                                <input type="date" name="fechaingresodetalleproducto" class="form-control" required>
                            </div>                            

                            <button type="submit" class="btn btn-success">Guardar</button>
                            <a href="{{ route('factura_compra.index') }}" class="btn btn-secondary">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
