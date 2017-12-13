@extends('master')
@section('title', 'Create A New Role')

@section('content')
<h3 class="page-title">Creación de <b>Role</b>  </h3>
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
            <a href="{!! action('Admin\RolesController@index') !!}">Roles</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="#">Creación</a>
         </li>
    </ul>
</div>


   <div class="portlet box grey-cascade"  >
        <div class="portlet-title">

             <div class="actions btn-set">
                <a href="{!! action('Admin\RolesController@index') !!}" type="button" name="back" class="btn default"><i class="fa fa-angle-left"></i> Atras</a>
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
                    <legend>Crear nuevo rol</legend>
                    <div class="form-group">
                        <label for="name" class="col-lg-2 control-label">Nombre</label>
                        <div class="col-lg-10">
                            <input type="name" class="form-control" id="name" name="name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="display_name" class="col-lg-2 control-label">Nombre para mostrar</label>
                        <div class="col-lg-10">
                            <input type="display_name" class="form-control" id="display_name" name="display_name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description" class="col-lg-2 control-label">Descripción</label>
                        <div class="col-lg-10">
                            <textarea class="form-control" rows="3" id="description" name="description"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="reset" class="btn btn-default">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Grabar</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection