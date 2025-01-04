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
                            <h3>Lista Facturas Compras</h3>
                        </div>
                        <div class="pull-right">
                            <div class="btn-group">
                                <a href="{{ route('factura_compra.create') }}" class="btn btn-info">Añadir Factura Compra</a>

                            </div>
                        </div>
                        <div class="table-container">
                            <table id="mytable" class="table table-bordered">
                                <thead>
                                    <th>Fecha Factura Compra</th>
                                    <th>Codigo Factura Compra</th>
                                    <th>Total Factura Compra</th>
                                    <th>Provedor</th>
                                    <th>Editar</th>
                                    <th>Eliminar</th>
                                </thead>
                                <tbody>
                                    @if ($factura_compras->count())
                                        @foreach ($factura_compras as $factura_compra)
                                            <tr>
                                                <td>{{ $factura_compra->fechafacturacompra }}</td>
                                                <td>{{ $factura_compra->codigofacturacompra }}</td>
                                                <td>{{ $factura_compra->totalfacturacompra }}</td>
                                                <td>{{ $factura_compra->proveedor->nombre_proveedor ?? 'N/A' }}</td>
                                                <td>
                                                    <a class="btn btn-primary btn-xs"
                                                        href="{{ route('factura_compra.edit', $factura_compra->idfacturacompra) }}">
                                                        <span class="glyphicon glyphicon-pencil"></span>
                                                    </a>
                                                </td>
                                                <td>
                                                    <form
                                                        action="{{ route('factura_compra.destroy', $factura_compra->idfacturacompra) }}"
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
                                            <td colspan="8">No hay registro !!</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div class="d-flex justify-content-center">
                    {{ $factura_compras->links() }}
                </div>
            </div>
        </section>
    @endsection
