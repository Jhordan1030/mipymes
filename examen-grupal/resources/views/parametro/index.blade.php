@extends('plantilla.plantilla')

@section('content')
<div class="row">
  <section class="content">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="pull-left"><h3>Lista de Parámetros</h3></div>
          <div class="pull-right">
            <div class="btn-group">
              <a href="{{ route('parametro.create') }}" class="btn btn-info">Añadir Parámetro</a>
            </div>
          </div>
          <div class="table-container">
            <table id="mytable" class="table table-bordered table-striped">
              <thead>
                <th>Código de Parámetro</th>
                <th>Nombre de Parámetro</th>
                <th>Valor de Parámetro</th>
                <th>Descripción de Parámetro</th>
                <th>Editar</th>
                <th>Eliminar</th>
              </thead>
              <tbody>
                @if($parametros->count())  
                @foreach($parametros as $parametro)  
                  <tr>
                    <td>{{ $parametro->codigo_parametro }}</td>
                    <td>{{ $parametro->nombre_parametro }}</td>
                    <td>{{ $parametro->valor_parametro }}</td>
                    <td>{{ $parametro->descripcion_parametro }}</td>
                    <td>
                      <a class="btn btn-primary btn-xs" href="{{ route('parametro.edit', $parametro->id_parametro) }}">
                        <span class="glyphicon glyphicon-pencil"></span>
                      </a>
                    </td>
                    <td>
                      <form action="{{ route('parametro.destroy', $parametro->id_parametro) }}" method="POST">
                        {{ csrf_field() }}
                        <input name="_method" type="hidden" value="DELETE">
                        <button class="btn btn-danger btn-xs" type="submit">
                          <span class="glyphicon glyphicon-trash"></span>
                        </button>
                      </form>
                    </td>
                  </tr>
                @endforeach 
                @else
                  <tr>
                    <td colspan="6">No hay registros</td>
                  </tr>
                @endif
              </tbody>
            </table>
          </div>
        </div>
        {{ $parametros->links() }}
      </div>
    </div>
  </section>
</div>
@endsection
