@extends('master')

@include('shared.estilos')

@section('title')
    Historia Clínica - {!! $paciente[0]->apellido . "," . $paciente[0]->nombre !!} - Editar Consulta
@endsection

@section('content')
    <div class="panel panel-primary" style="margin-top: -20px">
        <div class="panel-heading">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="text-left" style="border-radius: 0">Historia Clínica
                        de {!! $paciente[0]->apellido . ", " . $paciente[0]->nombre . " (H.C.:" . $paciente[0]->id_hc . ")"!!}</h2>
                </div>
                {{--                <div class="col-lg-2">
                                    <a href="#" class="btn btn-raised btn-success pull-right">Editar Historia</a>
                                </div>--}}
            </div>
        </div>
    </div>
    <div class="container">
        <div class="well well-lg">
            <form id="form-editar-consulta" method="post"
                  action="{{ URL::action('Panel\PanelHistoriasController@guardarConsulta') }}" class="form-horizontal">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <fieldset>
                    <legend>Editar consulta</legend>

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

                    <input type="hidden" id="id_paciente" name="id_paciente" value="{{ $paciente[0]->id }}">
                    <input type="hidden" id="id_consulta" name="id_consulta" value="{{ $consulta->id }}">
                    <input type="hidden" id="hidden_descripcion" name="hidden_descripcion">

                    <div class="form-group">
                        <label for="title" class="col-lg-2 control-label">Titulo</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="titulo" placeholder="Titulo"
                                   name="titulo" data-validation="required" data-validation-length="min4"
                                   value="{!!  $consulta->titulo !!}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="content" class="col-lg-2 control-label">Descripcion</label>
                        <div class="col-lg-10">
                            <textarea class="form-control" rows="3" id="editor_descripcion_edit"
                                      name="descripcion">{!! $consulta->descripcion !!}</textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success" id="submitConsulta_editar" style="float: right;">
                        Guardar
                    </button>
                    <a href="{{ action('Panel\PanelHistoriasController@verHistoria', $paciente[0]->id) }}" class="btn btn-danger" style="float: right;">Cancelar
                    </a>
                </fieldset>
            </form>
        </div>
    </div>
    {{--                <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success" data-dismiss="modal">Guardar</button>
                    </div>--}}
    {{--        </div>
        </div>
    </div>--}}

    <script src="../../../../ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('editor_descripcion_edit', {
            customConfig: '../../../ckeditor/custom_config.js'
        });
    </script>
    <script>
        $.validate({
            form: '#form-editar-consulta',
            lang: 'es',
            /*            onError : function($form) {
             alert('Validation of form '+$form.attr('id')+' failed!');
             },
             onSuccess : function($form) {
             alert('The form '+$form.attr('id')+' is valid!');
             return false; // Will stop the submission of the form
             },*/
        });
    </script>
@endsection
