@extends('master')
@section('title', 'Todos los pacientes')
@section('content')

    <div class="container col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2> Todos los pacientes </h2>
            </div>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if ($pacientes->isEmpty())
                <p> No hay pacientes creados.</p>
            @else
                <table class="table" id="myTable">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Teléfonos</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($pacientes as $paciente)
                        <tr>
                            <td>
                                <a href="{!! action('Admin\PacientesController@edit', $paciente->id) !!}">{!! $paciente->apellido .', '.$paciente->nombre !!} </a>
                            </td>
                            <td>{!! $paciente->telefono !!}</td>
                            <td><a class="btn btn-default btn-xs"   href="{!! action('Admin\PacientesController@show', $paciente->id) !!}">Ver</a></td>
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