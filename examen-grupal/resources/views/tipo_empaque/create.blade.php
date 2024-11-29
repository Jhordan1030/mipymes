@extends('plantilla.plantilla')

@section('content')
<div class="row">
    <section class="content">
        <div class="col-md-8 col-md-offset-2">
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Error!</strong> Revise los campos obligatorios.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Nuevo Tipo de Empaque</h3>
                </div>
                <div class="panel-body">                    
                    <form method="POST" action="{{ route('tipo_empaque.store') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="text" name="descripcion_tipo__empaque" class="form-control" placeholder="Descripción del Tipo de Empaque" value="{{ old('descripcion_tipo__empaque') }}">
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <input type="submit" value="Guardar" class="btn btn-success btn-block">
                                <a href="{{ route('tipo_empaque.index') }}" class="btn btn-info btn-block">Atrás</a>
                            </div>    
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
