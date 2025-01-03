@extends('layouts.app')
@section('content')
    <div class="row">
        <section class="content">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="pull-left">
                            <h3>Lista de Tipos de Cliente</h3>
                        </div>
                        <div class="pull-right">
                            <div class="btn-group">
                                <a href="{{ route('tipocliente.create') }}" class="btn btn-info">Añadir Tipo de Cliente</a>
                            </div>
                        </div>
                        <div class="table-container">
                            <table class="table table-bordered">
                                <thead>
                                    <th>Código</th>
                                    <th>Descripción</th>
                                    <th>Editar</th>
                                    <th>Eliminar</th>
                                </thead>
                                <tbody>
                                    @if ($tipoClientes->count())
                                        @foreach ($tipoClientes as $tipoCliente)
                                            <tr>
                                                <td>{{ $tipoCliente->codigo_tipo_Cliente }}</td>
                                                <td>{{ $tipoCliente->descripcion_tipo_Cliente }}</td>
                                                <td><a class="btn btn-primary btn-xs"
                                                        href="{{ route('tipocliente.edit', $tipoCliente->id_tipo_Cliente) }}">Editar</a>
                                                </td>
                                                <td>
                                                    <form
                                                        action="{{ route('tipocliente.destroy', $tipoCliente->id_tipo_Cliente) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-xs"
                                                            type="submit">Eliminar</button>
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
                            <div class="footer">
                                <p>Creado por: Giuliana Espinoza</p>
                            </div>
                        </div>
                        {{ $tipoClientes->links() }}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
