@extends('plantilla.plantilla')
@section('content')
    <div class="row">
        <section class="content">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Detalle de Productos</h3>
                    </div>
                    <div class="panel-body">
                        <a href="{{ route('detalleproducto.create') }}" class="btn btn-success">Nuevo Detalle de Producto</a>
                        <br> <br>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Especificaciones</th>
                                    <th>Precio</th>
                                    <th>Fecha Ingreso</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detalleProductos as $detalle)
                                    <tr>
                                        <td>{{ $detalle->producto->nombreproducto }}</td>
                                        <td>{{ $detalle->especificacionesproducto }}</td>
                                        <td>{{ $detalle->preciodetalleproducto }}</td>
                                        <td>{{ $detalle->fechaingresodetalleproducto }}</td>
                                        <td>
                                            <a href="{{ route('detalleproducto.edit', $detalle->iddetalleproducto) }}"
                                                class="btn btn-primary">Editar</a>
                                            <form
                                                action="{{ route('detalleproducto.destroy', $detalle->iddetalleproducto) }}"
                                                method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="footer">
                            <p>Creado por: Marcelo Chiriboga</p>
                        </div>
                        {{ $detalleProductos->links() }}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
