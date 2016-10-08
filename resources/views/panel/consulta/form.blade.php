@extends('master')

@include('shared.estilos')

@section('title')
    Historia Clínica - {!! $paciente->apellido . "," . $paciente->nombre !!} - {{ isset($consulta) ? 'Editar':'Nueva'}} Consulta
@endsection

@section('content')
    <div class="panel panel-primary" style="margin-top: -20px">
        <div class="panel-heading">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="text-left" style="border-radius: 0">Historia Clínica
                        de {!! $paciente->apellido . ", " . $paciente->nombre . " (H.C.:" . $paciente->id_hc . ")"!!}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="well well-lg">
            @if( isset($consulta) )
            <form id="consulta" method="post"  class="form-horizontal"
                  action="{{ action('Panel\PanelHistoriasController@guardarConsulta') }}">
                <input type="hidden" id="id_consulta" name="id_consulta" value="{{ $consulta->id }}">
            @else
            <form id="consulta" method="post"  class="form-horizontal"
                  action="{{ action('Panel\PanelHistoriasController@nuevaConsulta') }}">
            @endif

            <input type="hidden" id="id_paciente" name="id_paciente" value="{{ $paciente->id }}">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">

                <fieldset>
                    <legend>{{ isset($consulta) ? 'Editar':'Nueva'}} consulta</legend>

                    <div class="form-group" style="vertical-align: middle">
                        <input type="hidden" name="id_usuario" value="{{ Auth::user()->id }}">
                        <label for="medico" class="col-lg-2 control-label" style="padding-top:0;">Médico</label>
                        <p id="medico" name="medico">
                            @if(Auth::check())
                                {{ Auth::user()->name }}
                            @endif
                        </p>
                    </div>

                    <div class="form-group">
                        <label for="title" class="col-lg-2 control-label">Titulo</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="titulo" placeholder="Titulo"
                                   name="titulo" data-validation="required" data-validation-length="min4"
                                   value="{!! $consulta->titulo ?? '' !!}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="content" class="col-lg-2 control-label">Descripcion</label>
                        <div class="col-lg-10">
                            <textarea class="form-control" rows="3" id="descripcion"
                                      name="descripcion">{!! $consulta->descripcion ?? '' !!}</textarea>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success pull-right" id="submitConsulta_editar">Guardar</button>
                    <a href="{{ action('Panel\PanelHistoriasController@verHistoria', $paciente->id) }}" class="btn btn-danger pull-right">Cancelar</a>
                </fieldset>
            </form>
        </div>
    </div>

    <script src="{{ asset('/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('descripcion', {
            customConfig: '{{ asset('/ckeditor/custom_config.js') }}'
        });

        $.validate({
            form: '#consulta',
            lang: 'es'
        });
    </script>

@endsection
