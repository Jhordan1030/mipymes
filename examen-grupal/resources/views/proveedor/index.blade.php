@extends('plantilla.plantilla')
@section('content')
<div class="row">
  <section class="content">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="pull-left"><h3>Lista Proveedores</h3></div>
          <div class="pull-right">
            <div class="btn-group">
              <a href="{{ route('proveedor.create') }}" class="btn btn-info" >Añadir Proveedor</a>
              <a href="{{url('/home')}}" class="btn btn-primary" style="margin-left: 10px;">Home</a>
            </div>
          </div>
          <div class="table-container">
            <table id="mytable" class="table table-bordred table-striped">
             <thead>
               <th>Nombre Proveedor</th>
               <th>Descripción Proveedor</th>
               <th>Dirección Proveedor </th>
               <th>Telefono Proveedor</th>
               
               <th>Editar</th>
               <th>Eliminar</th>
             </thead>
             <tbody>
              @if($proveedores->count())  
              @foreach($proveedores as $proveedor)  
              <tr>
                <td>{{$proveedor->nombre_proveedor}}</td>
                <td>{{$proveedor->descripcion_proveedor}}</td>
                <td>{{$proveedor->direccion_proveedor}}</td>
                <td>{{$proveedor->telefono_proveedor}}</td>
                
                <td><a class="btn btn-primary btn-xs" href="{{ route('proveedor.edit', $proveedor->id) }}" ><span class="glyphicon glyphicon-pencil"></span></a></td>
                <td>
                  <form action="{{ route('proveedor.destroy', $proveedor->id)}}" method="post">
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
            <p>Creado por: Jhordan Huera</p>
        </div>
        </div>
      </div>
      {{ $proveedores->links() }}
    </div>
  </div>
</section>

@endsection