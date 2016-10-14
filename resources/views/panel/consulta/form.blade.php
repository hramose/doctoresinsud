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

            <h1 style="margin: 0 0 20px 0">{{ isset($consulta) ? 'Editar':'Nueva'}} consulta</h1>

            <ul class="list-group alert alert-danger">
            @foreach ($errors->all() as $error)
                <li class="list-group-item">{{ $error }}</li>
            @endforeach
            </ul>

            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#consulta-tab" data-toggle="tab">Motivo de consulta</a></li>
                    <li><a href="#sintomas" data-toggle="tab">S&iacute;ntomas</a></li>
                    <li><a href="#patologia" data-toggle="tab">Patolog&iacute;a</a></li>
                    <li><a href="#eventos" data-toggle="tab">Eventos</a></li>
                    <li><a href="#estudios" data-toggle="tab">Estudios Solicitados</a></li>
                    <li><a href="#tratamientos" data-toggle="tab">Tratamientos</a></li>
                    <li><a href="#grupo-clinico" data-toggle="tab">Grupo Cl&iacute;nico</a></li>
                </ul>
            </div>

            <div class="clearfix"></div>

            <div class="tab-content">
                <div class="tab-pane active" id="consulta-tab">
                    <h3>Motivo de consulta</h3>
                    <fieldset>

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

                    </fieldset>
                </div>
                <div class="tab-pane" id="sintomas">
                    <h3>S&iacute;ntomas</h3>
                    <div class="well well bs-component">
                        <fieldset id="sintomas-fieldset">
                            <legend>Sintomas detectados</legend>
                            <div id="ui_campo_1">
                                <select class="chosen-select-sintomas" multiple name="sintomas[]" id="select-sintomas">
                                    @if(isset($sintomasSeleccionados))
                                        @foreach($sintomas as $sintoma)
                                            <option value="{!! $sintoma->id !!}" @if(in_array($sintoma->id, $sintomasSeleccionados))
                                            selected="selected" @endif> {!! $sintoma->nombre !!}</option>
                                        @endforeach
                                    @else
                                        @foreach($sintomas as $sintoma)
                                            <option value="{!! $sintoma->id !!}"> {!! $sintoma->nombre !!}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="tab-pane" id="patologia">
                    <h3>Patolog&iacute;a</h3>
                </div>
                <div class="tab-pane" id="eventos">
                    <h3>Eventos</h3>
                </div>
                <div class="tab-pane" id="estudios">
                    <h3>Estudios Solicitados</h3>
                </div>
                <div class="tab-pane" id="tratamientos">
                    <h3>Tratamientos</h3>
                </div>
                <div class="tab-pane" id="grupo-clinico">
                    <h3>Grupo Cl&iacute;nico</h3>
                </div>


            </div>

                <button type="submit" class="btn btn-success pull-right" id="submitConsulta_editar">Guardar</button>
                <a href="{{ action('Panel\PanelHistoriasController@verHistoria', $paciente->id) }}" class="btn btn-danger pull-right">Cancelar</a>
            </form>
            <div class="clearfix"></div>
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

@section('scripts')
<style>
    .nav-tabs > li.active > a {
        border-radius: 0;
        height: 39px;
        background-color: #03af9f !important
    }
</style>
<script>
    $(document).on('ready', function() {
        var hash = window.location.hash;
        hash && $('ul.nav a[href="' + hash + '"]').tab('show');

        $('.nav-tabs a').click(function (e) {
          $(this).tab('show');
          var scrollmem = $('body').scrollTop() || $('html').scrollTop();
          window.location.hash = this.hash;
          $('html,body').scrollTop(scrollmem);
        });

        $(".chosen-select-sintomas").chosen({
            no_results_text: "No se encontraron resultados para las palabras ingresadas",
            width: "95%",
            placeholder_text_multiple: "Seleccione del listado los campos o escriba para reducir los resultados "
        });
    })
</script>

{{--<script>
    $(document).ready(function () {
        $(".chosen-select").chosen({
            no_results_text: "No se encontraron resultados para las palabras ingresadas",
            width: "95%",
            placeholder_text_multiple: "Seleccione del listado los campos o escriba para reducir los resultados "
        });
    });
</script>--}}
@endsection
