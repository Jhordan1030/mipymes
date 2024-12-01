@extends('plantilla.plantilla')

@section('content')
<div class="row">
  <section class="content">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="pull-left"><h3>Lista de Tipos de Identificación</h3></div>
          <div class="pull-right">
            <div class="btn-group">
              <a href="{{ route('tipoidentificacion.create') }}" class="btn btn-info">Añadir Tipo de Identificación</a>
            </div>
          </div>
          <div class="table-container">
            <table class="table table-bordred table-striped">
             <thead>
               <th>Código</th>
               <th>Nombre</th>
               <th>Editar</th>
               <th>Eliminar</th>
             </thead>
             <tbody>
              @foreach($tipoIdentificaciones as $tipoIdentificacion)  
              <tr>
                <td>{{ $tipoIdentificacion->codigo_tipo_identificacion }}</td>
                <td>{{ $tipoIdentificacion->nombre_tipo_identificacion }}</td>
                <td><a class="btn btn-primary btn-xs" href="{{ route('tipoidentificacion.edit', $tipoIdentificacion->id_tipo_identificacion) }}"><span class="glyphicon glyphicon-pencil"></span></a></td>
                <td>
                  <form action="{{ route('tipoidentificacion.destroy', $tipoIdentificacion->id_tipo_identificacion) }}" method="POST">
                   @csrf
                   @method('DELETE')
                   <button class="btn btn-danger btn-xs" type="submit"><span class="glyphicon glyphicon-trash"></span></button>
                  </form>
                </td>
              </tr>
              @endforeach 
            </tbody>
          </table>
          <div class="footer">
            <p>Creado por: Giuliana Espinoza</p>
        </div>
          {{ $tipoIdentificaciones->links() }}
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
