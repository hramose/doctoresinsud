@extends('master')
@section('name', 'Edita Sede')

@section('content')
    <div class="container col-md-6 col-md-offset-3">
        <div class="well well bs-component">

            <form class="form-horizontal" method="post">

                @foreach ($errors->all() as $error)
                    <p class="alert alert-danger">{{ $error }}</p>
                @endforeach

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                {!! csrf_field() !!}

                <fieldset>
                    <legend>Editar Sede</legend>
                    <div class="form-group">
                        <label for="nombre" class="col-lg-2 control-label">Nombre</label>

                        <div class="col-lg-10">
                            <input type="name" class="form-control" id="nombre" placeholder="Nombre" name="nombre"
                                   value="{{ $sede->nombre }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="telefonos" class="col-lg-2 control-label">Teléfonos</label>

                        <div class="col-lg-10">
                            <input type="phone" class="form-control" id="telefonos" placeholder="Telefono/s" name="telefonos"
                                   value="{{ $sede->telefonos }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                             <a class="btn btn-danger"   href="{!! action('Admin\SedesController@index') !!}">cancelar</a>
                            <button type="submit" class="btn btn-primary">Confirmar Edición</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection