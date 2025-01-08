@extends('layouts.app')

@section('content')
<div class="row">
    <section class="content">
        <div class="col-md-8 col-md-offset-2">
            <form method="POST" action="{{ route('estado_cuenta.store') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="text" name="nombreestadocuenta" class="form-control" placeholder="Nombre del Estado de Cuenta">
                </div>
                <div class="form-group">
                    <textarea name="descripcionestadocuenta" class="form-control" placeholder="Descripción"></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" value="Guardar" class="btn btn-success btn-block">
                    <a href="{{ route('estado_cuenta.index') }}" class="btn btn-info btn-block">Atrás</a>
                </div>
            </form>
        </div>
    </section>
@endsection