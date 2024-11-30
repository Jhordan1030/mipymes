@extends('plantilla.plantilla')
@section('content')
<div class="row">
  <section class="content">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="pull-left"><h3>Lista Cargos</h3></div>
          <div class="pull-right">
            <div class="btn-group">
              <a href="{{ route('cargo.create') }}" class="btn btn-info" >Añadir Cargo</a>
            </div>
          </div>
          <div class="table-container">
            <table id="mytable" class="table table-bordred table-striped">
             <thead>
               <th>Código</th>
               <th>Cargo</th>
               <th>Editar</th>
               <th>Eliminar</th>
             </thead>
             <tbody>
              @if($cargos->count())  
              @foreach($cargos as $cargo)  
              <tr>
                <td>{{$cargo->codigo_cargo}}</td>                  
                <td>{{$cargo->nombre_cargo}}</td>
                <td><a class="btn btn-primary btn-xs" href="{{ route('cargo.edit', $cargo->id) }}" ><span class="glyphicon glyphicon-pencil"></span></a></td>
                <td>
                  <form action="{{ route('cargo.destroy', $cargo->id)}}" method="post">
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
      {{ $cargos->links() }}
    </div>
  </div>
</section>

@endsection
