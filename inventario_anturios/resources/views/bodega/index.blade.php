@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-center">Listado De Bodegas</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif



        <!-- Formulario de creación de bodega -->
        <div class="row">
            <section class="content">
                <div class="col-md-8 col-md-offset-2">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Error!</strong> Revise los campos obligatorios.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Nueva Bodega</h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-container">
                                <form method="POST" action="{{ route('bodega.store') }}" role="form">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <!-- Campo Código de la Bodega -->
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="idbodega">Código de la Bodega</label>
                                                <input type="text" name="idbodega" id="idbodega"
                                                    class="form-control input-sm" placeholder="Código de la Bodega">
                                            </div>
                                        </div>
                                        <!-- Campo Nombre de la Bodega -->
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="nombrebodega">Nombre de la Bodega</label>
                                                <input type="text" name="nombrebodega" id="nombrebodega"
                                                    class="form-control input-sm" placeholder="Nombre de la Bodega">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <!-- Botones de acción -->
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <button type="submit" class="btn btn-success btn-block">Guardar</button>

                                        </div>
                                    </div><br>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- Formulario de búsqueda -->
        <form action="{{ route('bodega.index') }}" method="GET" class="mb-3">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Buscar por ID bodega"
                        value="{{ request()->search }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100" style="background-color: #88022D">Buscar</button>
                </div>
            </div>
        </form>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Código Bodega</th>
                    <th>Nombre Bodega</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bodegas as $bodega)
                    <tr>
                        <td>{{ $bodega->idbodega }}</td>
                        <td>{{ $bodega->nombrebodega }}</td>
                        <td>
                            <a href="{{ route('bodega.edit', $bodega->idbodega) }}" class="btn btn-sm btn-primary">Editar</a>
                            <form action="{{ route('bodega.destroy', $bodega->idbodega) }}" method="POST"
                                class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('¿Estás seguro de eliminar esta bodega?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No hay bodega registrada</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Paginación -->
        <div class="mt-3">
            {{ $bodegas->links() }}
        </div>
    </div>


@endsection