@extends('plantilla.plantilla')

@section('content')
<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
      <div class="panel-body">
        <h3>Añadir Tipo de Cliente</h3>
        <form action="{{ route('tipocliente.store') }}" method="POST">
          @csrf
          <div class="form-group">
            <label for="codigo_tipo_Cliente">Código</label>
            <input type="text" name="codigo_tipo_Cliente" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="descripcion_tipo_Cliente">Descripción</label>
            <input type="text" name="descripcion_tipo_Cliente" class="form-control" required>
          </div>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
      </div>
    </div>
  </div>
  <div class="footer">
    <p>Creado por: Giuliana Espinoza</p>
</div>
</div>
@endsection
