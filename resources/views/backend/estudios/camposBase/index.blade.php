@extends('master')
@section('title', 'Campos Base')
@section('content')

    <div class="container col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2> Campos base </h2>
            </div>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if ($camposBase->isEmpty())
                <p> No hay campos base creados.</p>
            @else
                <table class="table" id="myTable">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Tipo</th>
                        <th>Unidad</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($camposBase as $campoBase)
                        <tr>
                            <td>{!! $campoBase->nombre !!}</td>
                            <td>{!! $campoBase->descripcion !!}</td>
                            <td>{!! $campoBase->tipo !!}</td>
                            <td>{!! $campoBase->unidad !!}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
<div class="form-group">
        <div class="col-lg-10 col-lg-offset-2">
            <a href="{!! action('Admin\PagesController@home') !!}" class="btn btn-primary"> <- Volver al hub de admin</a>
            
        </div>
    </div>
@endsection