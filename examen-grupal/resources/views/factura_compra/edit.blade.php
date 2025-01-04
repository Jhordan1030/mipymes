@extends('layouts.app')

@section('content')
    <div class="row">
        <section class="content">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Editar Factura de Compra</h3>
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

                        <form method="POST" action="{{ route('factura_compra.update', $factura_compra->idfacturacompra) }}" role="form">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="fechafacturacompra">Fecha de la Factura</label>
                                <input type="date" name="fechafacturacompra" class="form-control"
                                    value="{{ old('fechafacturacompra', $factura_compra->fechafacturacompra) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="codigofacturacompra">Código de Factura</label>
                                <input type="text" name="codigofacturacompra" class="form-control"
                                    value="{{ old('codigofacturacompra', $factura_compra->codigofacturacompra) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="totalfacturacompra">Total de la Factura</label>
                                <input type="number" step="0.01" name="totalfacturacompra" class="form-control"
                                    value="{{ old('totalfacturacompra', $factura_compra->totalfacturacompra) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="id">Proveedor</label>
                                <select name="id" class="form-control" required>
                                    <option value="">Seleccione un proveedor</option>
                                    @foreach ($proveedores as $proveedor)
                                        <option value="{{ $proveedor->idproveedor }}" 
                                            {{ $factura_compra->idproveedor == $proveedor->idproveedor ? 'selected' : '' }}>
                                            {{ $proveedor->nombre_proveedor }}
                                        </option>
                                    @endforeach
                                </select>

                                
                            </div>

                            <button type="submit" class="btn btn-success">Actualizar</button>
                            <a href="{{ route('factura_compra.index') }}" class="btn btn-secondary">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
