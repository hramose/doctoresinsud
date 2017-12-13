@extends('infopage')

@section('title')
    Historia Clínica - {!! $paciente->apellido . "," . $paciente->nombre !!} - Eliminar dirección
@endsection

@section('estilos')
    <style>
        textarea {
            /*max-width: 100%;*/
            resize: none;
        }

        label {
            margin-top: 5px;
        }
    </style>
@endsection

@section('scripts')

@endsection

@section('content')
    <div class="panel panel-primary" style="margin-top: -20px   ">
         
        <div class="container col-md-8 col-md-offset-2">
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

                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">

                    <fieldset>
                        <legend>Eliminar dirección</legend>

                         <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <a href="{!! action('Panel\DireccionesController@index', $paciente->id) !!}" class="btn btn-default">Cancelar</a>
                                <button type="submit" class="btn btn-danger">Confirmar</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="calle" class="col-lg-2 control-label">Calle</label>
                            <div class="col-lg-5">
                                <input type="text" class="form-control" id="calle" name="calle"
                                       value="{!! old('calle', $direccion->calle) !!}" readonly>
                            </div>
                            <label for="altura" class="col-lg-2 control-label">Altura</label>
                            <div class="col-lg-2">
                                <input type="number" class="form-control" id="altura" name="altura"
                                       value="{!! old('altura', $direccion->altura) !!}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="piso" class="col-lg-2 control-label">Piso</label>
                            <div class="col-lg-2">
                                <input type="number" class="form-control" id="piso" name="piso"
                                       value="{!! old('piso', $direccion->piso) !!}" readonly>
                            </div>
                            <label for="departamento" class="col-lg-2 control-label">Departamento</label>
                            <div class="col-lg-2">
                                <input type="text" class="form-control" id="departamento" name="departamento"
                                       value="{!! old('departamento', $direccion->departamento) !!}" readonly>
                            </div>
                            <label for="codigo_postal" class="col-lg-2 control-label">Código Postal</label>
                            <div class="col-lg-2">
                                <input type="text" class="form-control" id="codigo_postal" name="codigo_postal"
                                       value="{!! old('codigo_postal', $direccion->codigo_postal) !!}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="localidad" class="col-lg-2 control-label">Localidad</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="localidad" name="localidad"
                                       value="{!! old('localidad', $direccion->localidad) !!}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="provincia" class="col-lg-2 control-label">Provincia</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="provincia" name="provincia"
                                       value="{!! old('provincia', $direccion->provincia) !!}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pais" class="col-lg-2 control-label">Pais</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="pais" name="pais"
                                       value="{!! old('pais', $direccion->pais) !!}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="activo" class="col-xs-2 control-label">Activo</label>
                            <div class="col-xs-2">
                                {!! Form::checkbox('activo', old('activo'), in_array(old('activo', $direccion->activo), array('on', 2)) ?  true : false, ['class'=>'form-control', 'id'=>'activo', 'disabled'=>'disabled']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <a href="{!! action('Panel\DireccionesController@index', $paciente->id) !!}" class="btn btn-default">Cancelar</a>
                                <button type="submit" class="btn btn-danger">Confirmar</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@endsection