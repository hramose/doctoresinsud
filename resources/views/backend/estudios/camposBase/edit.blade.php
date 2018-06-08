@extends('master')
@section('title', 'Editar campo base')

@section('content')

<h3 class="page-title">Edición de <b>Campo Base</b>  </h3>
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
            <a href="{!! action('Admin\CamposBaseController@index') !!}">Campos Base</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="#">Edición</a>
         </li>
    </ul>
</div>

  <div class="portlet box grey-cascade"  >
        <div class="portlet-title">

             <div class="actions btn-set">
                <a href="{!! action('Admin\CamposBaseController@index') !!}" type="button" name="back" class="btn default"><i class="fa fa-angle-left"></i> Atras</a>
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
                            <input type="nombre" class="form-control" id="nombre" name="nombre" value="{!! $campoBase->nombre !!}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="descripcion" class="col-lg-2 control-label">Descripción</label>
                        <div class="col-lg-10">
                            <input type="descripcion" class="form-control" id="descripcion" name="descripcion" value="{!! $campoBase->descripcion !!}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tipo" class="col-lg-2 control-label">Tipo</label>
                        <div class="col-lg-10">
                            {{--<input type="tipo" class="form-control" id="tipo" name="tipo">--}}
                            <select class="form-control" name="tipo" id="tipo">
                                @foreach($tiposDatos as $tipoDato)
                                    <option value="{!! $tipoDato->tipo !!}" @if($tipoDato->tipo == $campoBase->tipo) selected @endif>
                                        {!! $tipoDato->tipo !!}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="select" class="col-lg-2 control-label">Unidad de Medida</label>

                        <div class="col-lg-10">
                            <select class="form-control" id="id_unidad" name="id_unidad">
                                <option value="" id="vacio"></option>
                                
                                @foreach($unidadesMedida as $unidadMedida)
                                <option value="{!! $unidadMedida->id !!}" @if($unidadMedida->id == $campoBase->id_unidad) selected @endif>
                                    {!! $unidadMedida->unidad !!}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ref_min" class="col-lg-2 control-label">Valor de Referencia Mínimo</label>
                        <div class="col-lg-10">
                            <input type="ref_min" class="form-control" id="ref_min" name="ref_min" value="{!! $campoBase->ref_min !!}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ref_max" class="col-lg-2 control-label">Valor de Referencia Máximo</label>
                        <div class="col-lg-10">
                            <input type="ref_max" class="form-control" id="ref_max" name="ref_max" value="{!! $campoBase->ref_max !!}">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            
                            <button type="reset" class="btn btn-default">Borrar</button>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection