@extends('master')

@section('encabezado')
    <h2>Administración del Blog</h2>
@stop

@section('contenido')
    <ul>
        <li><a href="{{ URL::to('/admin/articulos/crear') }}">Creación de nuevo Articulo</a></li>
        <li><a href="{{ URL::to('admin/categorias/crear') }}">Creación de nueva Categoría</a></li>
    </ul>
@stop