@extends('layouts.app')
@section('content')
<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
      <div class="panel-body">
        <h3>Editar Tipo de Cliente</h3>
        <form action="{{ route('tipocliente.update', $tipoCliente->id_tipo_Cliente) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="form-group">
            <label for="codigo_tipo_Cliente">Código</label>
            <input type="text" name="codigo_tipo_Cliente" class="form-control" value="{{ $tipoCliente->codigo_tipo_Cliente }}" required>
          </div>
          <div class="form-group">
            <label for="descripcion_tipo_Cliente">Descripción</label>
            <input type="text" name="descripcion_tipo_Cliente" class="form-control" value="{{ $tipoCliente->descripcion_tipo_Cliente }}" required>
          </div>
          <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
      </div>
    </div>
  </div>
  <div class="footer">
    <p>Creado por: Giuliana Espinoza</p>
</div>
</div>
@endsection
