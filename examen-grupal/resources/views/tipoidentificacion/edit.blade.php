@extends('plantilla.plantilla')

@section('content')
<div class="row">
  <section class="content">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-body">
          <h3>Editar Tipo de Identificación</h3>
          <form action="{{ route('tipoidentificacion.update', $tipoIdentificacion->id_tipo_identificacion) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="codigo_tipo_identificacion">Código:</label>
              <input type="text" class="form-control" name="codigo_tipo_identificacion" value="{{ $tipoIdentificacion->codigo_tipo_identificacion }}" required>
            </div>
            <div class="form-group">
              <label for="nombre_tipo_identificacion">Nombre:</label>
              <input type="text" class="form-control" name="nombre_tipo_identificacion" value="{{ $tipoIdentificacion->nombre_tipo_identificacion }}" required>
            </div>
            <button type="submit" class="btn btn-success">Actualizar</button>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
