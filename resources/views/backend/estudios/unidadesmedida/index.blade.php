@extends('master')
@section('title', 'Unidades de Medida')
@section('content')

    <div class="container col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2> Unidades de Medida </h2>
            </div>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if ($unidadesMedida->isEmpty())
                <p> No hay unidades de medida creadas.</p>
            @else
                <table class="table" id="myTable">
                    <thead>
                    <tr>
                        <th>Unidad</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($unidadesMedida as $unidadMedida)
                        <tr>
                            <td>{!! $unidadMedida->unidad !!}</td>
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