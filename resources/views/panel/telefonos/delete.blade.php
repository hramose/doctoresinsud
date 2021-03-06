@extends('infopage')

@section('title')
    Historia Clínica - {!! $paciente->apellido . "," . $paciente->nombre !!} - Eliminar teléfono
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
                        <legend>Eliminar teléfono</legend>
                        <div class="form-group">
                            <label for="etiqueta" class="col-lg-2 control-label">Etiqueta</label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" id="etiqueta" name="etiqueta"
                                       value="{!! old('etiqueta', $telefono->etiqueta) !!}" readonly>
                            </div>
                            <label for="telefono" class="col-lg-2 control-label">Teléfono</label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" id="telefono" name="telefono"
                                       value="{!! old('telefono', $telefono->telefono) !!}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="activo" class="col-xs-2 control-label">Activo</label>
                            <div class="col-xs-2">
                                {!! Form::checkbox('activo', old('activo',2), in_array(old('activo', $telefono->activo), array('on', 2)) ?  true : false, ['class'=>'form-control', 'id'=>'activo', 'disabled'=>'disabled']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <a href="{!! action('Panel\TelefonosController@index', $paciente->id) !!}" class="btn btn-default">Cancelar</a>
                                <button type="submit" class="btn btn-danger">Confirmar</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@endsection