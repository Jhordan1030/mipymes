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
                            <h3>Lista Ubicaciones</h3>
                        </div>
                        <div class="pull-right">
                          <div class="btn-group">
                            <a href="{{ route('ubicacion.create') }}" class="btn btn-info">Añadir Ubicación</a>
                            
                        </div>                        
                        </div>
                        <div class="table-container">
                            <table id="mytable" class="table table-bordered">
                                <thead>
                                    <th>Nombre Ubicación</th>
                                    <th>Descripción Ubicación</th>
                                    <th>Editar</th>
                                    <th>Eliminar</th>
                                </thead>
                                <tbody>
                                    @if ($ubicaciones->count())
                                        @foreach ($ubicaciones as $ubicacion)
                                            <tr>
                                                <td>{{ $ubicacion->nombreUbicacion }}</td>
                                                <td>{{ $ubicacion->descripcionUbicacion }}</td>
                                                
                                                <td><a class="btn btn-primary btn-xs"
                                                        href="{{ route('ubicacion.edit', $ubicacion->idubicacion) }}"><span
                                                            class="glyphicon glyphicon-pencil"></span></a></td>
                                                <td>
                                                    <form action="{{ route('ubicacion.destroy', $ubicacion->idubicacion) }}" method="post">
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
                    {{ $ubicaciones->links() }}
                </div>
            </div>
        </section>
    @endsection
