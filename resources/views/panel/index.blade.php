@extends('master')

@include('shared.estilos')

@section('title', 'Panel de Historias Clínicas')

@section('content')

{{--    <div class="aa-header">
        <h2 class="text-center">Panel de Historias Clínicas</h2>
    </div>--}}

    <div class="panel panel-primary" style="margin-top: -20px   ">
        <div class="panel-heading">
            <h2 class="text-center" style="border-radius: 0">Panel de Historias Clínicas</h2>
        </div>
        <div class="panel-body">
            <a href="#" class="btn btn-info">Cargar nueva Historia Clínica</a>
        </div>
    </div>

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
     {{--       @if ($pacientes->isEmpty())
                <p> No hay pacientes cargados.</p>
            @else--}}
                <table class="table" id="myTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>ID Historia Clinica</th>
                            <th>Apellido</th>
                            <th>Nombre</th>
                            <th>Fecha de Ingreso</th>
                            <th>Fecha de Ultima Consulta</th>
                            {{--<th>Opciones</th>--}}
                        </tr>
                    </thead>
{{--                    <tbody>
                    @foreach($pacientes as $paciente)
                        <tr>
                            <td><a href="{!! action('Panel\PanelHistoriasController@verHistoria', $paciente->id) !!}">{!! $paciente->id_hc !!}</a></td>
                            <td>
                                <a href="{!! action('Panel\PanelHistoriasController@verHistoria', $paciente->id) !!}">{!! $paciente->apellido .', '.$paciente->nombre !!} </a>
                            </td>
                            <td>{!! \Carbon\Carbon::parse($paciente->fecha_alta)->format('d/m/Y') !!}</td>
                            <td>{!! \Carbon\Carbon::parse($paciente->fecha_ult_consulta)->format('d/m/Y') !!}</td>
                            <td><a class="btn btn-default btn-xs" href="#">Visualizar</a></td>
                        </tr>
                    @endforeach
                    </tbody>--}}
                </table>
            {{--@endif--}}
        </div>
    </div>

@endsection

@section('script_datatables')
    ,"ajax": {
        "url":"/panel/ajax/hhcc",
        "dataSrc": ""
    },
    "columns": [
        { "data": "id" },
        { "data": "id_hc" },
        { "data": "apellido" },
        { "data": "nombre" },
        { "data": "fecha_alta" },
        { "data": "fecha_ult_consulta"}
    ]
@endsection