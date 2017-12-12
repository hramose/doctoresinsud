@extends('infopage')

@section('title')
    Historia Clínica - {!! $paciente->apellido . "," . $paciente->nombre !!} - Teléfonos
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
                    <input type="hidden" name="id_paciente" value="{!! $paciente->id !!}">
                    <fieldset>
                        <legend>Agregar nuevo teléfono</legend>
                        <div class="form-group">
                            <label for="calle" class="col-lg-2 control-label">Etiqueta</label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" id="etiqueta" name="etiqueta"
                                       value="{!! old('etiqueta') !!}">
                            </div>
                            <label for="telefono" class="col-lg-2 control-label">Teléfono</label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" id="telefono" name="telefono"
                                       value="{!! old('telefono') !!}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="activo" class="col-xs-2 control-label">Activo</label>
                            <div class="col-xs-2">
                                {!! Form::checkbox('activo', old('activo',2), in_array(old('activo'), array('on', 2)) ?  true : false, ['class'=>'form-control', 'id'=>'activo']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                 <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
        <div class="container col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                @if ($telefonos->isEmpty())
                    <p>El paciente no posee teléfonos.</p>
                @else
                    <div class="table-responsive">
                        <table class="table" id="telefonos">
                            <thead>
                            <tr>
                                <th>Etiqueta</th>
                                <th>Teléfono</th>
                                <th>Activo</th>
                                <th>Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($telefonos as $telefono)
                                <tr>
                                    <td>{!! $telefono->etiqueta !!}</td>
                                    <td>{!! $telefono->telefono !!}</td>
                                    <td>{!! $telefono->activo == 2 ? 'Si' : 'No' !!}</td>
                                    <td>
                                        <a href="{!! action('Panel\TelefonosController@edit', ['id_p' => $paciente->id, 'id_t' => $telefono->id]) !!}"
                                           class="btn btn-xs btn-primary">Editar</a>
                                        <a href="{!! action('Panel\TelefonosController@showForDelete', ['id_p' => $paciente->id, 'id_t' => $telefono->id]) !!}"
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