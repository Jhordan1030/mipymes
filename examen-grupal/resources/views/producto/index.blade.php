@extends('layouts.app')
@section('content')
    <div class="row">
        <section class="content">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="pull-left">
                            <h3>Lista de Productos</h3>
                        </div>
                        <div class="pull-right">
                            <a href="{{ route('producto.create') }}" class="btn btn-info">Añadir Producto</a>
                        </div>
                        <div class="table-container">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Cantidad Mínima</th>
                                        <th>Cantidad Máxima</th>
                                        <th>Tipo Empaque</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($productos as $producto)
                                        <tr>
                                            <td>{{ $producto->nombreproducto }}</td>
                                            <td>{{ $producto->descripcionproducto }}</td>
                                            <td>{{ $producto->cantidadminimaproducto }}</td>
                                            <td>{{ $producto->cantidadmaximaproducto }}</td>
                                            <td>{{ $producto->tipoEmpaque->descripcion_tipo__empaque ?? 'Sin empaque' }}
                                            </td>
                                            <td>
                                                <a href="{{ route('producto.edit', $producto->idproducto) }}"
                                                    class="btn btn-primary btn-sm">Editar</a>
                                                <form action="{{ route('producto.destroy', $producto->idproducto) }}"
                                                    method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6">No hay productos registrados.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="footer">
                                <p>Creado por: Marcelo Chiriboga</p>
                            </div>
                            {{ $productos->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
