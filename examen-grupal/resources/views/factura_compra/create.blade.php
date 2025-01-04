@extends('layouts.app')

@section('content')
    <div class="row">
        <section class="content">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Nueva Factura de Compra</h3>
                    </div>
                    <div class="panel-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Error!</strong> Revise los campos obligatorios.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('factura_compra.store') }}" role="form">
                            @csrf

                            <div class="form-group">
                                <label for="fechafacturacompra">Fecha de la Factura</label>
                                <input type="date" name="fechafacturacompra" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="codigofacturacompra">Código de Factura</label>
                                <input type="text" name="codigofacturacompra" class="form-control" placeholder="Ingrese el código" required>
                            </div>

                            <div class="form-group">
                                <label for="totalfacturacompra">Total de la Factura</label>
                                <input type="number" step="0.01" name="totalfacturacompra" class="form-control" placeholder="Ingrese el total" required>
                            </div>

                            <div class="form-group">
                                <label for="idproveedor">Proveedor</label>
                                <select name="idproveedor" class="form-control" required>
                                    <option value="">Seleccione un proveedor</option>
                                    @foreach ($proveedores as $proveedor)
                                        <option value="{{ $proveedor->idproveedor }}">{{ $proveedor->nombre_proveedor }}</option>
                                    @endforeach
                                </select>
                                
                            </div>

                            <button type="submit" class="btn btn-success">Guardar</button>
                            <a href="{{ route('factura_compra.index') }}" class="btn btn-secondary">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
