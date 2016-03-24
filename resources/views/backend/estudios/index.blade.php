@extends('master')
@section('title', 'Todos los estudios')
@section('content')

    <div class="container col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2> Todos los estudios </h2>
            </div>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if ($estudios->isEmpty())
                <p> No hay estudios creados.</p>
            @else
                <table class="table" id="myTable">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($estudios as $estudio)
                        <tr>
                            <td>
                                <a href="{!! action('Admin\EstudiosController@edit', $estudio->id) !!}">{!! $estudio->nombre !!} </a>
                            </td>
                            <td><a class="btn btn-default btn-xs"   href="{!! action('Admin\EstudiosController@show', $estudio->id) !!}">Ver</a></td>
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