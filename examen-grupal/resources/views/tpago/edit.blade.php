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
            @if(Session::has('success'))
            <div class="alert alert-info">
                {{Session::get('success')}}
            </div>
            @endif

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Actualizar Tipo de Pago</h3>
                </div>
                <div class="panel-body">                    
                    <div class="table-container">
                        <form method="POST" action="{{ route('tpago.update',$tpago->id) }}"  role="form">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="PATCH">
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="codigo_tipo_pago" id="codigo_tipo_pago" class="form-control input-sm" value="{{$tpago->codigo_tipo_pago}}">
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="nombre_tipo_pago" id="nombre_tipo_pago" class="form-control input-sm" value="{{$tpago->nombre_tipo_pago}}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <textarea name="descripcion_tipo_pago" class="form-control input-sm"  placeholder="Resumen">{{$tpago->descripcion_tipo_pago}}</textarea>
                            </div>
                            
                            <div class="row">

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <input type="submit"  value="Actualizar" class="btn btn-success btn-block">
                                    <a href="{{ route('tpago.index') }}" class="btn btn-info btn-block" >Atrás</a>
                                </div>    

                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <div class="footer">
                <p>Creado por: Jhordan Huera</p>
            </div>
        </div>
    </section>
    @endsection