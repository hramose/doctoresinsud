@extends('master')
@section('title', 'Crea una nueva Sede')

@section('content')

<h3 class="page-title">Crear una <b>Sede</b>  </h3>
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
            <a href="#">Crear</a>
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

                <input type="hidden" name="_token" value="{!! csrf_token() !!}">

                <fieldset>
                     <div class="form-group">
                        <label for="nombre" class="col-lg-2 control-label">Nombre</label>
                        <div class="col-lg-10">
                            <input type="name" class="form-control" id="nombre" name="nombre">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="telefonos" class="col-lg-2 control-label">Telefonos</label>
                        <div class="col-lg-10">
                            <input type="phone" class="form-control" id="telefonos" name="telefonos">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <a href="/admin" class="btn btn-default">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection 