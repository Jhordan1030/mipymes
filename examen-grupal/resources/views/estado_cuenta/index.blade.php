@extends('layouts.app')

@section('content')
<div class="row">
  <section class="content">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="pull-left"><h3>Lista de Estados de Cuenta</h3></div>
          <div class="pull-right">
            <div class="btn-group">
              <a href="{{ route('estado_cuenta.create') }}" class="btn btn-info">Añadir Estado de Cuenta</a>
            </div>
          </div>
          <div class="table-container">
            <table id="mytable" class="table table-bordred table-striped">
              <thead>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Editar</th>
                <th>Eliminar</th>
              </thead>
              <tbody>
                @foreach($estado_cuentas as $estado)
                <tr>
                  <td>{{ $estado->nombreestadocuenta }}</td>
                  <td>{{ $estado->descripcionestadocuenta }}</td>
                  <td><a class="btn btn-primary btn-xs" href="{{ route('estado_cuenta.edit', $estado->idestadocuenta) }}"><span class="glyphicon glyphicon-pencil"></span></a></td>
                  <td>
                    <form action="{{ route('estado_cuenta.destroy', $estado->idestadocuenta) }}" method="post">
                      {{ csrf_field() }}
                      <input name="_method" type="hidden" value="DELETE">
                      <button class="btn btn-danger btn-xs" type="submit"><span class="glyphicon glyphicon-trash"></span></button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        {{ $estado_cuentas->links() }}
      </div>
    </div>
  </section>
</div>
@endsection
