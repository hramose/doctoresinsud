@extends('master')
@section('title', 'All users')
@section('content')

    <div class="container col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2> Usuarios </h2>
            </div>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if ($users->isEmpty())
                <p> No hay usuarios en el sistema.</p>
            @else
                <table class="table" id="myTable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Fecha de Alta</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{!! $user->id !!}</td>
                            <td>
                                <a href="{!! action('Admin\UsersController@edit', $user->id) !!}">{!! $user->name !!} </a>
                            </td>
                            <td>{!! $user->email !!}</td>
                            <td>{!! $user->created_at !!}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
<div class="form-group">
        <div class="col-lg-10 col-lg-offset-2">
            <a href="{!! action('Admin\PagesController@home') !!}" class="btn btn-primary"> <- Volver a panel de administración</a>
            
        </div>
    </div>
@endsection