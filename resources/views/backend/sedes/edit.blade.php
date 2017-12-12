@extends('master')
@section('name', 'Edita Sede')

@section('content')
<h3 class="page-title">Editar <b>Sede</b>  </h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{ URL::to('/') }}/">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{!! action('Admin\PagesController@home') !!}">Admin</a>
            <i class="fa fa-angle-right"></i>
        </li>

        <li>
            <a href="{!! action('Admin\SedesController@index') !!}">Sedes</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="#">Editar</a>
         </li>
    </ul>
</div>

  <div class="portlet box grey-cascade"  >
        <div class="portlet-title">

             <div class="actions btn-set">
                <a href="{!! action('Admin\SedesController@index') !!}" type="button" name="back" class="btn default"><i class="fa fa-angle-left"></i> Atras</a>
            </div>

        </div>
        <div class="portlet-body">

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
                             <a class="btn btn-danger"   href="{!! action('Admin\SedesController@index') !!}">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Confirmar Edición</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection