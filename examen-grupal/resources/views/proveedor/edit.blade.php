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
                    <h3 class="panel-title">Actualización Proveedor</h3>
                </div>
                <div class="panel-body">                    
                    <div class="table-container">
                        <form method="POST" action="{{ route('proveedor.update',$proveedor->id) }}"  role="form">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="PATCH">
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="nombre_proveedor" id="nombre_proveedor" class="form-control input-sm" value="{{$proveedor->nombre_proveedor}}">
                                    </div>
                                </div>
                                
                            </div>

                            <div class="form-group">
                                <textarea name="descripcion_proveedor" class="form-control input-sm"  placeholder="Descripcion Proveedor">{{$proveedor->descripcion_proveedor}}</textarea>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="direccion_proveedor" id="direccion_proveedor" class="form-control input-sm" value="{{$proveedor->direccion_proveedor}}">
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="telefono_proveedor" id="telefono_proveedor" class="form-control input-sm" value="{{$proveedor->telefono_proveedor}}">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <input type="submit"  value="Actualizar" class="btn btn-success btn-block">
                                    <a href="{{ route('proveedor.index') }}" class="btn btn-info btn-block" >Atrás</a>
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