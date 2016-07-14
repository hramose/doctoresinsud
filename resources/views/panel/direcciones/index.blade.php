@extends('master')

@section('title')
    Historia Clínica - {!! $paciente->apellido . "," . $paciente->nombre !!} - Direcciones
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
        <div class="panel-heading">
            <div class="row">
                <div class="col-lg-9">
                    <h2 class="text-left" style="border-radius: 0">Direcciones de
                        {!! $paciente->apellido . ", " . $paciente->nombre . " (H.C.:" . $paciente->id_hc . ")"!!}
                    </h2>
                </div>
                <div class="col-lg-3">
                    <a href="{{ action('Panel\PanelHistoriasController@verHistoria', $paciente->id) }}"
                       class="btn btn-raised btn-default" style="background-color: #EEEEEE">Volver a Historia
                        Clinica</a>
                </div>
            </div>
        </div>
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
                    <input type="hidden" name="id_paciente" value="{!! $paciente->id !!}">
                    <fieldset>
                        <legend>Agregar nueva dirección</legend>
                        <div class="row">
                            <label for="calle" class="col-lg-2 control-label">Calle</label>
                            <div class="col-lg-5">
                                <input type="text" class="form-control" id="calle" name="calle"
                                       value="{!! old('calle') !!}">
                            </div>
                            <label for="altura" class="col-lg-2 control-label">Altura</label>
                            <div class="col-lg-2">
                                <input type="number" class="form-control" id="altura" name="altura"
                                       value="{!! old('altura') !!}">
                            </div>
                        </div>
                        <div class="row">
                            <label for="piso" class="col-lg-2 control-label">Piso</label>
                            <div class="col-lg-2">
                                <input type="number" class="form-control" id="piso" name="piso"
                                       value="{!! old('piso') !!}">
                            </div>
                            <label for="departamento" class="col-lg-2 control-label">Departamento</label>
                            <div class="col-lg-2">
                                <input type="text" class="form-control" id="departamento" name="departamento"
                                       value="{!! old('departamento') !!}">
                            </div>
                            <label for="codigo_postal" class="col-lg-2 control-label">Código Postal</label>
                            <div class="col-lg-2">
                                <input type="text" class="form-control" id="codigo_postal" name="codigo_postal"
                                       value="{!! old('codigo_postal') !!}">
                            </div>
                        </div>
                        <div class="row">
                            <label for="localidad" class="col-lg-2 control-label">Localidad</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="localidad" name="localidad"
                                       value="{!! old('localidad') !!}">
                            </div>
                        </div>
                        <div class="row">
                            <label for="provincia" class="col-lg-2 control-label">Provincia</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="provincia" name="provincia"
                                       value="{!! old('provincia') !!}">
                            </div>
                        </div>
                        <div class="row">
                            <label for="pais" class="col-lg-2 control-label">Pais</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="pais" name="pais"
                                       value="{!! old('pais') !!}">
                            </div>
                        </div>
                        <div class="row">
                            <label for="activo" class="col-lg-2 control-label">Activo</label>
                            <div class="col-lg-2">
                                {!! Form::checkbox('activo', old('activo',2), in_array(old('activo'), array('on', 2)) ?  true : false, ['class'=>'form-control', 'id'=>'activo']) !!}
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
        <div class="container col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                @if ($direcciones->isEmpty())
                    <p>El paciente no posee direcciones.</p>
                @else
                    <div class="table-responsive">
                        <table class="table" id="direcciones">
                            <thead>
                            <tr>
                                <th>Calle</th>
                                <th>Altura</th>
                                <th>Piso</th>
                                <th>Departamento</th>
                                <th>Cod. Postal</th>
                                <th>Localidad</th>
                                <th>Provincia</th>
                                <th>País</th>
                                <th>Activo</th>
                                <th>Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($direcciones as $direccion)
                                <tr>
                                    <td>{!! $direccion->calle !!}</td>
                                    <td>{!! $direccion->altura !!}</td>
                                    <td>{!! $direccion->piso !!}</td>
                                    <td>{!! $direccion->departamento !!}</td>
                                    <td>{!! $direccion->codigo_postal !!}</td>
                                    <td>{!! $direccion->localidad !!}</td>
                                    <td>{!! $direccion->provincia !!}</td>
                                    <td>{!! $direccion->pais !!}</td>
                                    <td>{!! $direccion->activo == 2 ? 'Si' : 'No' !!}</td>
                                    <td>
                                        <a href="{!! action('Panel\DireccionesController@edit', ['id_p' => $paciente->id, 'id_d' => $direccion->id]) !!}"
                                           class="btn btn-xs btn-primary">Editar</a>
                                        <a href="{!! action('Panel\DireccionesController@showForDelete', ['id_p' => $paciente->id, 'id_d' => $direccion->id]) !!}"
                                           class="btn btn-xs btn-danger">Borrar</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection