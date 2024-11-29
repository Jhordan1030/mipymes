@extends('plantilla.plantilla')

@section('content')
<div class="row">
  <section class="content">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="pull-left"><h3>Lista de Tipos de Empaque</h3></div>
          <div class="pull-right">
            <div class="btn-group">
              <a href="{{ route('tipo_empaque.create') }}" class="btn btn-info">Añadir Tipo de Empaque</a>
            </div>
          </div>
          <div class="table-container">
            <table id="mytable" class="table table-bordered table-striped">
              <thead>
                <th>Descripción del Tipo de Empaque</th>
                <th>Editar</th>
                <th>Eliminar</th>
              </thead>
              <tbody>
                @if($tiposEmpaque->count())  
                @foreach($tiposEmpaque as $tipoEmpaque)  
                  <tr>
                    <td>{{ $tipoEmpaque->descripcion_tipo__empaque }}</td>
                    <td><a class="btn btn-primary btn-xs" href="{{ route('tipo_empaque.edit', $tipoEmpaque->id_tipo__empaque) }}"><span class="glyphicon glyphicon-pencil"></span></a></td>
                    <td>
                      <form action="{{ route('tipo_empaque.destroy', $tipoEmpaque->id_tipo__empaque) }}" method="POST">
                        {{ csrf_field() }}
                        <input name="_method" type="hidden" value="DELETE">
                        <button class="btn btn-danger btn-xs" type="submit"><span class="glyphicon glyphicon-trash"></span></button>
                      </form>
                    </td>
                  </tr>
                @endforeach 
                @else
                  <tr>
                    <td colspan="3">No hay registros</td>
                  </tr>
                @endif
              </tbody>
            </table>
          </div>
        </div>
        {{ $tiposEmpaque->links() }}
      </div>
    </div>
  </section>
</div>
@endsection
