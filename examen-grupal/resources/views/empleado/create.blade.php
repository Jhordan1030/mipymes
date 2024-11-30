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
                    <h3 class="panel-title">Nuevo Empleado</h3>
                </div>
                <div class="panel-body">                    
                    <div class="table-container">
                        <form method="POST" action="{{ route('empleado.store') }}"  role="form">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="cedula_empleado" id="cedula_empleado" class="form-control input-sm" placeholder="Cédula del empleado">
                                    </div>
                                </div>
                              <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="telefono_empleado" id="telefono_empleado" class="form-control input-sm" placeholder="Teléfono del empleado">
                                    </div>
                                </div>
                                </div>   
                            <div class="form-group">
                                        <input type="text" name="nombre_empleado" id="nombre_empleado" class="form-control input-sm" placeholder="Nombre del empleado">
                                    </div>
                            <div class="form-group">
                                        <input type="text" name="apellidos_empleado" id="apellidos_empleado" class="form-control input-sm" placeholder="Apellidos del empleado">
                                    </div>
                            <div class="form-group">
                                        <input type="text" name="direccion_empleado" id="direccion_empleado" class="form-control input-sm" placeholder="Dirección del empleado">
                                    </div>
                            <div class="row">

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <input type="submit"  value="Guardar" class="btn btn-success btn-block">
                                    <a href="{{ route('empleado.index') }}" class="btn btn-info btn-block" >Atrás</a>
                                </div>    

                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <div class="footer"> 
            <p>Creado por: Deysi Guevara</p> 
          </div>
        </div>
    </section>
    @endsection
