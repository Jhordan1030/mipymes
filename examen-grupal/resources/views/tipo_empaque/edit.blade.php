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
                    <h3 class="panel-title">Editar Tipo de Empaque</h3>
                </div>
                <div class="panel-body">                    
                    <form method="POST" action="{{ route('tipo_empaque.update', $tipoEmpaque->id_tipo__empaque) }}">
                        {{ csrf_field() }}
                        <input name="_method" type="hidden" value="PATCH">
                        <div class="form-group">
                            <input type="text" name="descripcion_tipo__empaque" class="form-control" value="{{ $tipoEmpaque->descripcion_tipo__empaque }}">
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <input type="submit" value="Actualizar" class="btn btn-success btn-block">
                                <a href="{{ route('tipo_empaque.index') }}" class="btn btn-info btn-block">Atrás</a>
                            </div>    
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
