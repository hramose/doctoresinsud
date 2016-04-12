@extends('master')
@section('title', 'Roles')
@section('content')

    <div class="container col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2> Roles </h2>
            </div>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if ($roles->isEmpty())
                <p> No hay roles en el sistema.</p>
            @else
                <table class="table" id="myTable">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Nombre para mostrar</th>
                        <th>Descripción</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td>{!! $role->name !!}</td>
                            <td>{!! $role->display_name !!}</td>
                            <td>{!! $role->description !!}</td>

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