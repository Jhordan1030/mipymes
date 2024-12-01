@extends('plantilla.plantilla')
@section('content')
<div class="row">
  <section class="content">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="pull-left"><h3>Lista Empleados</h3></div>
          <div class="pull-right">
            <div class="btn-group">
              <a href="{{ route('empleado.create') }}" class="btn btn-info" >Añadir Empleado</a>
              <a href="{{url('/home')}}" class="btn btn-primary" style="margin-left: 10px;">Home</a>
            </div>
          </div>
          <div class="table-container">
            <table id="mytable" class="table table-bordred table-striped">
             <thead>
               <th>Cédula</th>
               <th>Nombres</th>
               <th>Apellidos</th>                 
               <th>Dirección</th>
               <th>Teléfono</th>
               <th>Editar</th>
               <th>Eliminar</th>
             </thead>
             <tbody>
              @if($empleados->count())  
              @foreach($empleados as $empleado)  
              <tr>              
                <td>{{$empleado->cedula_empleado}}</td>
                <td>{{$empleado->nombre_empleado}}</td>                  
                <td>{{$empleado->apellidos_empleado}}</td>                  
                <td>{{$empleado->direccion_empleado}}</td>                  
                <td>{{$empleado->telefono_empleado}}</td>
                <td><a class="btn btn-primary btn-xs" href="{{ route('empleado.edit', $empleado->id) }}" ><span class="glyphicon glyphicon-pencil"></span></a></td>
                <td>
                  <form action="{{ route('empleado.destroy', $empleado->id)}}" method="post">
                   {{csrf_field()}}
                   <input name="_method" type="hidden" value="DELETE">

                   <button class="btn btn-danger btn-xs" type="submit"><span class="glyphicon glyphicon-trash"></span></button>
                  </form>
                 </td>
               </tr>
               @endforeach 
               @else
               <tr>
                <td colspan="8">No hay registro !!</td>
              </tr>
              @endif
            </tbody>

          </table>
          <div class="footer"> 
            <p>Creado por: Deysi Guevara</p> 
          </div>
        </div>
      </div>
      {{ $empleados->links() }}
    </div>
  </div>
</section>

@endsection
