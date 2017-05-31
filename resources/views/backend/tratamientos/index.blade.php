@extends('master')
@section('title', 'Todos los tratamientos')
@section('content')

    <div class="container col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2> Todos los tratamientos </h2>
            </div>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if ($tratamientos->isEmpty())
                <p> No hay tratamientos creados.</p>
            @else
                <table class="table" id="myTable">
                    <thead>
                        <tr>
                            <th>Titulo</th>
                            <th>Descripci&oacute;n</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($tratamientos as $tratamiento)
                        <tr>
                            <td>
                                <a href="{!! action('Admin\TratamientosController@edit', $tratamiento->id) !!}">{!! $tratamiento->titulo !!} </a>
                            </td>
                            <td>{!! $tratamiento->descripcion !!}</td>
                            <td><a class="btn btn-default btn-xs"   href="{!! action('Admin\TratamientosController@show', $tratamiento->id) !!}">Ver</a></td>
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