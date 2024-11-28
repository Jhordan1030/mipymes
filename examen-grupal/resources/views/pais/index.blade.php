@extends('plantilla.plantilla')
@section('content')
<div class="row">
  <section class="content">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="pull-left"><h3>Lista Paises</h3></div>
          <div class="pull-right">
            <div class="btn-group">
              <a href="{{ route('pais.create') }}" class="btn btn-info" >Añadir País</a>
            </div>
          </div>
          <div class="table-container">
            <table id="mytable" class="table table-bordred table-striped">
             <thead>
               <th>Codigo País</th>
               <th>Nombre Pais</th>
               <th>Editar</th>
               <th>Eliminar</th>
             </thead>
             <tbody>
              @if($paises->count())  
              @foreach($paises as $pais)  
              <tr>
                <td>{{$pais->codigo_pais}}</td>
                <td>{{$pais->nombre_pais}}</td>
                <td><a class="btn btn-primary btn-xs" href="{{ route('pais.edit', $pais->id) }}" ><span class="glyphicon glyphicon-pencil"></span></a></td>
                <td>
                  <form action="{{ route('pais.destroy', $pais->id)}}" method="post">
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
        </div>
      </div>
      {{ $paises->links() }}
    </div>
  </div>
</section>

@endsection