@extends('master')

@include('shared.estilos')

@section('title')
    Historia Clínica - {!! $paciente->apellido . "," . $paciente->nombre !!} - Nueva Consulta
@endsection

@section('scripts')

    <script src="{{ asset('/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('editor_descripcion', {
            customConfig: '{{ asset('/ckeditor/custom_config.js') }}'
        });
        CKEDITOR.replace('editor_descripcion_edit', {
            customConfig: '{{ asset('/ckeditor/custom_config.js') }}'
        });

        $.validate({
            form: '#form-nueva-consulta',
            lang: 'es',
            {{--            onError : function($form) {
             alert('Validation of form '+$form.attr('id')+' failed!');
             },
             onSuccess : function($form) {
             alert('The form '+$form.attr('id')+' is valid!');
             return false; // Will stop the submission of the form
             },--}}

        });
    </script>

@endsection

@section('content')
    <div class="panel panel-primary" style="margin-top: -20px">
        <div class="panel-heading">
            <div class="row">
                <div class="col-lg-7">
                    <h2 class="text-left" style="border-radius: 0">Historia Clínica
                        de {!! $paciente->apellido . ", " . $paciente->nombre . " (H.C.:" . $paciente->id_hc . ")"!!}</h2>
                </div>
                {{--                <div class="col-lg-2">
                                    <a href="#" class="btn btn-raised btn-success pull-right">Editar Historia</a>
                                </div>--}}
            </div>
        </div>
    </div>


            <div class="container">
                <div class="well well-lg">
                    <form id="form-nueva-consulta" method="post"
                          action="{{ URL::action('Panel\PanelHistoriasController@nuevaConsulta') }}"
                          class="form-horizontal">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                        <fieldset>
                            <legend>Nueva consulta</legend>

                            <div class="form-group" style="vertical-align: middle">
                                <input type="hidden" name="id_usuario" value="{{ Auth::user()->id }}">
                                <label for="medico" class="col-lg-2 control-label"
                                       style="padding-top:0;">Médico</label>
                                <p id="medico" name="medico">
                                    @if(Auth::check())
                                        {{ Auth::user()->name }}
                                    @endif
                                </p>

                            </div>

                            <input type="hidden" id="id_paciente" name="id_paciente" value="{{ $paciente->id }}">
                            <input type="hidden" id="hidden_descripcion" name="hidden_descripcion">

                            <div class="form-group">
                                <label for="title" class="col-lg-2 control-label">Titulo</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="titulo" placeholder="Titulo"
                                           name="titulo" data-validation="required" data-validation-length="min4">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="content" class="col-lg-2 control-label">Descripcion</label>
                                <div class="col-lg-10">
                                        <textarea class="form-control" rows="3" id="editor_descripcion"
                                                  name="descripcion"></textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success" id="submitConsulta" style="float: right;">
                                Guardar
                            </button>
                            <a href="{{ action('Panel\PanelHistoriasController@verHistoria', $paciente->id) }}" class="btn btn-danger" style="float: right;">
                                Cancelar
                            </a>
                        </fieldset>
                    </form>
                </div>
            </div>


@endsection
