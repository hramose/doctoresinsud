@extends('master')
@section('title', 'Crea un nuevo síntoma')

@section('content')

<h3 class="page-title">Crear un nuevo <b>síntoma</b>  </h3>
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
            <a href="{!! action('Admin\SintomasController@index') !!}">Sintomas</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="#">Borrar</a>
         </li>
    </ul>
</div>

     <div class="portlet box grey-cascade"  >
        <div class="portlet-title">

             <div class="actions btn-set">
                <a href="{!! action('Admin\SintomasController@index') !!}" type="button" name="back" class="btn default"><i class="fa fa-angle-left"></i> Atras</a>
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
                        <label for="sintoma" class="col-lg-2 control-label">Síntoma</label>
                        <div class="col-lg-10">
                            <input type="text" value="{{$sintoma->nombre}}" class="form-control" id="sintoma" name="nombre" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="descripcion" class="col-lg-2 control-label">Descripción</label>
                        <div class="col-lg-10">
                            <input type="text" value="{{$sintoma->descripcion}}" class="form-control" id="descripcion" name="descripcion" disabled>
                        </div>
                    </div>
                      <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <a class="btn btn-primary"   href="{!! action('Admin\SintomasController@index') !!}">cancelar</a>
                           <a class="btn btn-danger"   href="{!! action('Admin\SintomasController@destroy', $sintoma->id) !!}">Confirmar borrado</a>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection 