@extends('master')

@section('encabezado')
    <h2>Articulos</h2>

@stop

@section('contenido')

<ul>
    <li><a href="{{URL::to('a')}}">Agregar nuevo Articulo</a></li>
    @foreach($articulos as $articulo)
        <li> {{ $articulo->titulo }} </li>
    @endforeach
</ul>

@stop