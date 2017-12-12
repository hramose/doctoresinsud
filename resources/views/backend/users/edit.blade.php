@extends('master')
@section('name', 'Edit a user')

@section('content')

<h3 class="page-title">Edición usuario
                        de <b>{!! $user->name !!}</b>  </h3>
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
            <a href="{!! action('Admin\UsersController@index') !!}">Usuarios</a>
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
                <a href="{!! action('Admin\UsersController@index') !!}" type="button" name="back" class="btn default"><i class="fa fa-angle-left"></i> Atras</a>
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
                    <legend>Editar usuario</legend>
                    <div class="form-group">
                        <label for="name" class="col-lg-2 control-label">Nombre</label>

                        <div class="col-lg-10">
                            <input type="name" class="form-control" id="name" placeholder="Nombre" name="name"
                                   value="{{ $user->name }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-lg-2 control-label">Email</label>

                        <div class="col-lg-10">
                            <input type="email" class="form-control" id="email" placeholder="Email" name="email"
                                   value="{{ $user->email }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="select" class="col-lg-2 control-label">Rol</label>

                        <div class="col-lg-10">
                            <select class="form-control" id="role" name="role[]" multiple>
                                @foreach($roles as $role)
                                    <option value="{!! $role->id !!}"  @if(in_array($role->id, $selectedRoles))
                                            selected="selected" @endif >{!! $role->display_name !!}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="select" class="col-lg-2 control-label">Sedes</label>
            
                        <div class="col-lg-10">
                            <select class="form-control" id="sede" name="sede[]" multiple>
                                @foreach($sedes as $sede)
                                    <option value="{!! $sede->id !!}"  @if(in_array($sede->id, $selectedSedes))
                                            selected="selected" @endif >{!! $sede->nombre !!}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-lg-2 control-label">Contraseña</label>

                        <div class="col-lg-10">
                            <input type="password" class="form-control" name="password">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-lg-2 control-label">Confirmar contraseña</label>

                        <div class="col-lg-10">
                            <input type="password" class="form-control" name="password_confirmation">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-2">
                            <a href="{!! action('Admin\UsersController@index') !!}" class="btn btn-success btn-raised"> <- Volver a Usuarios</a>
                        </div>

                        <div class="col-lg-5 col-lg-offset-5">
                            <button type="reset" class="btn btn-default">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Grabar</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection