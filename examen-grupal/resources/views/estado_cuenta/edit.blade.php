@extends('layouts.app')

@section('content')
<div class="row">
    <section class="content">
        <div class="col-md-8 col-md-offset-2">
            <form method="POST" action="{{ route('estado_cuenta.update', $estado_cuenta->idestadocuenta) }}">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PATCH">
                <div class="form-group">
                    <input type="text" name="nombreestadocuenta" class="form-control" value="{{ $estado_cuenta->nombreestadocuenta }}">
                </div>
                <div class="form-group">
                    <textarea name="descripcionestadocuenta" class="form-control">{{ $estado_cuenta->descripcionestadocuenta }}</textarea>
                </div>
                <div class="form-group">
                    <input type="submit" value="Actualizar" class="btn btn-success btn-block">
                    <a href="{{ route('estado_cuenta.index') }}" class="btn btn-info btn-block">Atrás</a>
                </div>
            </form>
        </div>
    </section>
@endsection