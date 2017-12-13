@extends('master')
@section('title', 'Crea un nuevo Estudio')

@section('content')
<div class="container col-md-8 col-md-offset-2" ng-app="CamposBaseApp" ng-controller="CamposBaseController">
    
        <div class="well well bs-component">

            <form class="form-horizontal" method="post" action="/admin/estudios/create">

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
                    <legend>Crea un nuevo estudio</legend>

                    <!-- Nombre -->
                    <div class="form-group">
                        <label for="nombre" class="col-lg-2 control-label">Nombre</label>
                        <div class="col-lg-10">
                            <input type="name" class="form-control" id="nombre" name="nombre">
                        </div>
                    </div>

                    <!-- Nombre -->
                    <!-- Observaciones -->
                    <div class="form-group">
                        <label for="observaciones" class="col-lg-2 control-label">Observaciones</label>
                        <div class="col-lg-10">
                            <input type="textarea" class="form-control" id="observaciones" name="observaciones">
                        </div>
                    </div>

                    
                    <!-- Observaciones -->
                    <button type="button" id="tombo">+ campos</button>
                    <hr>
                    <div class="form-group" style="display:none;" id="campos">

                        <div class="col-lg-10">
                        <label for="select" class="col-lg-2 control-label">Campo</label>
                        <button type="button" class="elimina" onclick="$(this).parent().remove();">x</button>
                        <select class="form-control selectCampos" id="camposbase" name="campobase[]" >
                            @foreach($camposbase as $campobase)
                                <option value="{!! $campobase->id !!}"  >{!! $campobase->nombre !!} </option>
                            @endforeach
                        </select>
                        <button type="button" class="agrega btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" onclick="">+</button>
                        </div>

                        
                    </div>
                    <div id="cont"></div>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="reset" class="btn btn-default">Cancel</button>
                            <button type="submit" class="btn btn-primary">Guardar Datos</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
        </div>
    

<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Agregar nuevo campo base</h4>
      </div>
      <div class="modal-body">
              

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
                            <input type='text' ng-model="camposbase.nombre">
                            
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="descripcion" class="col-lg-2 control-label">Descripción</label>
                        <div class="col-lg-10">

                            <input type="descripcion" id="descripcion" class="form-control"  ng-model="camposbase.descripcion">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tipo" class="col-lg-2 control-label">Tipo</label>
                        <div class="col-lg-10">
                            <select class="form-control" id="tipo" ng-model="camposbase.tipo">
                                    <option value="texto">Texto</option>
                                    <option value="número entero">Número entero</option>
                                    <option value="número con decimales">Número con decimales</option>
                                    
                            </select>
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="select" class="col-lg-2 control-label">U.Medida</label>

                        <div class="col-lg-10">
                            <select class="form-control" ng-model="camposbase.id_unidad" ng-change="chequeaCampos()">
                                <option value="" id="vacio"></option>
                                
                                @foreach($unidadesMedida as $unidadMedida)
                                <option value="{!! $unidadMedida->id !!}">
                                    {!! $unidadMedida->unidad !!}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                   
                    <div class="form-group">
                        <label for="ref_min" class="col-lg-2 control-label">Ref. Mín</label>
                        <div class="col-lg-10">
                            <input type="ref_min" id="ref_min" class="form-control" ng-model="camposbase.ref_min">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ref_max" class="col-lg-2 control-label">Ref. Máx</label>
                        <div class="col-lg-10">
                            <input type="ref_max" id="ref_max" class="form-control" ng-model="camposbase.ref_max">
                        </div>
                    </div>
                </fieldset>
               
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">CERRAR</button>
        <button type="button" class="btn btn-primary" ng-click="addCampoBase()">GRABAR</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

    
@endsection 