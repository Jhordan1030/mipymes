@extends('plantilla.plantilla')
@section('content')
    <div class="row">
        <section class="content">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="pull-left">
                            <h3>Lista Tipos de Pago</h3>
                        </div>
                        <div class="pull-right">
                            <div class="btn-group">
                                <a href="{{ route('tpago.create') }}" class="btn btn-info">Añadir Tipo de Pago</a>
                            </div>
                        </div>
                        <div class="table-container">
                            <table id="mytable" class="table table-bordred table-striped">
                                <thead>
                                    <th>Código</th>
                                    <th>Nombre </th>
                                    <th>Descripción</th>
                                    <th>Editar</th>
                                    <th>Eliminar</th>
                                </thead>
                                <tbody>
                                    @if ($tpagos->count())
                                        @foreach ($tpagos as $tpago)
                                            <tr>
                                                <td>{{ $tpago->codigo_tipo_pago }}</td>
                                                <td>{{ $tpago->nombre_tipo_pago }}</td>
                                                <td>{{ $tpago->descripcion_tipo_pago }}</td>
                                                <td><a class="btn btn-primary btn-xs"
                                                        href="{{ route('tpago.edit', $tpago->id) }}"><span
                                                            class="glyphicon glyphicon-pencil"></span></a></td>
                                                <td>
                                                    <form action="{{ route('tpago.destroy', $tpago->id) }}" method="post">
                                                        {{ csrf_field() }}
                                                        <input name="_method" type="hidden" value="DELETE">

                                                        <button class="btn btn-danger btn-xs" type="submit"><span
                                                                class="glyphicon glyphicon-trash"></span></button>
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
                    {{ $tpagos->links() }}
                </div>
            </div>
        </section>

    @endsection
