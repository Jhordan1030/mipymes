@extends('layout')

@section('title', 'Home')

@section('content')
    <h1>Home</h1>
    <p>Bienvenido {{ $nombre ?? 'Invitado' }}</p>
@endsection
