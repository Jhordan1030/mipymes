@extends('layouts.app')
@section('content')
    <div class="row">
        <section class="content">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">

                        <!-- Mensaje de éxito -->
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="pull-left">
                            <h3>Lista de Detalles de Ubicación</h3>
                        </div>
                        <div class="pull-right">
                            <div class="btn-group">
                                <a href="{{ route('detalle_ubicacion.create') }}" class="btn btn-info">Añadir Detalle</a>
                            </div>
                        </div>
                        <div class="table-container">
                            <table id="mytable" class="table table-bordered">
                                <thead>
                                    <th>Ubicación</th>
                                    <th>Producto</th>
                                    <th>Especificaciones</th>
                                    <th>Fecha Ingreso</th>
                                    <th>Editar</th>
                                    <th>Eliminar</th>
                                </thead>
                                <tbody>
                                    @if ($detalleUbicaciones->count())
                                        @foreach ($detalleUbicaciones as $detalleUbicacion)
                                            <tr>
                                                <td>{{ $detalleUbicacion->ubicacion->nombreUbicacion ?? 'N/A' }}</td>
                                                <td>{{ $detalleUbicacion->producto->nombreproducto ?? 'N/A' }}</td>
                                                <td>{{ $detalleUbicacion->especificacionesdetalleubicacion }}</td>
                                                <td>{{ $detalleUbicacion->fechaingresodetalleproducto }}</td>
                                                <td>
                                                    <a class="btn btn-primary btn-xs"
                                                        href="{{ route('detalle_ubicacion.edit', $detalleUbicacion->iddetalleubicacion) }}">
                                                        <span class="glyphicon glyphicon-pencil"></span>
                                                    </a>
                                                </td>
                                                <td>
                                                    <form
                                                        action="{{ route('detalle_ubicacion.destroy', $detalleUbicacion->iddetalleubicacion) }}"
                                                        method="post">
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
                                            <td colspan="8">No hay registros!!</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center">
                            {{ $detalleUbicaciones->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endsection
