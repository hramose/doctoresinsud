@extends('master')
@section('title', 'Crea una nueva patología')

@section('content')


<h3 class="page-title">Crea una nueva <b>patologia</b>  </h3>
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
            <a href="{!! action('Admin\PatologiasController@index') !!}">Patologias</a>
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
                <a href="{!! action('Admin\PatologiasController@index') !!}" type="button" name="back" class="btn default"><i class="fa fa-angle-left"></i> Atras</a>
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
                        <label for="patologia" class="col-lg-2 control-label">Patologia</label>
                        <div class="col-lg-10">
                            <input type="text" value="{{$patologia->nombre}}" class="form-control" id="patologia" name="nombre">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="descripcion" class="col-lg-2 control-label">Descripción</label>
                        <div class="col-lg-10">
                            <input type="text"  value="{{$patologia->descripcion}}" class="form-control" id="descripcion" name="descripcion">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="estado" class="col-lg-2 control-label">Estado</label>
                        <div class="col-lg-10">
                            <select name="estado" class="form-control" id="estado">
                                <option value="0" @if($patologia->estado==0) selected  @endif >Inactivo</option>
                                <option value="1" @if($patologia->estado==1) selected  @endif>Activo</option>
                            </select>
                             
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="reset" class="btn btn-default">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection 