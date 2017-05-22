@extends('master')

@include('shared.estilos')

@section('title')
    Historia Clínica - {!! $paciente->apellido . "," . $paciente->nombre !!} - {{ isset($consulta) ? 'Editar':'Nueva'}} Consulta
@endsection

@section('content')


<h3 class="page-title">Historia Clínica
                        de <b>{!! $paciente->apellido . ", " . $paciente->nombre . " (H.C.:" . $paciente->id_hc . ")"!!}</b>  </h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{ URL::to('/') }}/">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{ action('Panel\PanelHistoriasController@index') }}">Historias Clínicas</a>
            <i class="fa fa-angle-right"></i>
        </li>
         <li>
            <a href="{{ action('Panel\PanelHistoriasController@verHistoria', $paciente->id) }}">Paciente</a>
            <i class="fa fa-angle-right"></i>
         </li>
        <li>
            <a href="#">Consulta</a>
          </li>
    </ul>
</div>

   
    <div class="portlet box grey-cascade"  >
        <div class="portlet-title">

             <div class="actions btn-set">
                <a href="{{ action('Panel\PanelHistoriasController@verHistoria', $paciente->id) }}" type="button" name="back" class="btn default"><i class="fa fa-angle-left"></i> Atras</a>
            </div>

            
        </div>
        <div class="portlet-body">
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

            @if($errors->has())
                <ul class="list-group alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li class="list-group-item">{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <div class="tabbable-custom nav-justified">
                <ul class="nav nav-tabs nav-justified">
                    <li class="active"><a href="#consulta-tab" data-toggle="tab">Motivo de consulta</a></li>
                    <li><a href="#sintomas" data-toggle="tab">S&iacute;ntomas</a></li>
                    <li><a href="#patologia" data-toggle="tab">Patolog&iacute;a</a></li>
                   <!--- <li><a href="#eventos" data-toggle="tab">Eventos</a></li>-->
                    <li><a href="#estudios" data-toggle="tab">Estudios Solicitados</a></li>
                    <li><a href="#tratamientos" data-toggle="tab">Tratamientos</a></li>
                  <!---  <li><a href="#grupo-clinico" data-toggle="tab">Grupo Cl&iacute;nico</a></li>-->
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
                        <div class="form-group">
                            <label for="content" class="col-lg-2 control-label">Pr&oacute;xima Cita</label>
                            <div class="col-lg-2">
                                <input type="text" class="form-control datepicker" id="proxima_cita" name="proxima_cita" value="{!! isset($consulta->proxima_cita) ? \Carbon\Carbon::parse($consulta->proxima_cita)->format('d/m/Y') : '' !!}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="content" class="col-lg-2 control-label">Frecuencia Cardíaca</label>
                            <div class="col-lg-2">
                                <input type="number" class="form-control" id="frecuencia_cardiaca" name="frecuencia_cardiaca" value="{!! $consulta->frecuencia_cardiaca ?? '' !!}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="content" class="col-lg-2 control-label">Presión Sistólica</label>
                            <div class="col-lg-2">
                                <input type="number" class="form-control" id="presion_sistolica" name="presion_sistolica" value="{!! $consulta->presion_sistolica ?? '' !!}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="content" class="col-lg-2 control-label">Presión Diastólica</label>
                            <div class="col-lg-2">
                                <input type="number" class="form-control" id="presion_diastolica" name="presion_diastolica" value="{!! $consulta->presion_diastolica ?? '' !!}">
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="tab-pane" id="sintomas">
                    <h3>S&iacute;ntomas</h3>
                    <div class="well well bs-component">
                        <fieldset id="sintomas-fieldset">
                            <legend>Sintomas detectados</legend>
                            <div>
                                <select class="chosen-select" multiple name="sintomas[]" id="select-sintomas">
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
                    <div class="well well bs-component">
                        <fieldset id="patologias-fieldset">
                            <legend>Patologías detectadas</legend>
                            <div>
                                <select class="chosen-select" multiple name="patologias[]" id="select-patologias">
                                    @if(isset($patologiasSeleccionadas))
                                        @foreach($patologias as $patologia)
                                            <option value="{!! $patologia->id !!}" @if(in_array($patologia->id, $patologiasSeleccionadas))
                                            selected="selected" @endif> {!! $patologia->nombre !!}</option>
                                        @endforeach
                                    @else
                                        @foreach($patologias as $patologia)
                                            <option value="{!! $patologia->id !!}"> {!! $patologia->nombre !!}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </fieldset>
                    </div>
                </div>
               <!--- <div class="tab-pane" id="eventos">
                    <h3>Eventos</h3>
                </div>-->
                <div class="tab-pane" id="estudios">
                    <h3>Estudios Solicitados</h3>

                    <div class="well well bs-component">
                        <fieldset id="patologias-fieldset">
                             <div>
                                <select class="chosen-select" multiple name="estudios[]" id="select-estudios">
                                    @if(isset($estudiosSeleccionadas))
                                        @foreach($estudios as $estudio)
                                            <option value="{!! $estudio->id !!}" @if(in_array($estudio->id, $estudiosSeleccionadas))
                                            selected="selected" @endif> {!! $estudio->nombre !!}</option>
                                        @endforeach
                                    @else
                                        @foreach($estudios as $estudio)
                                            <option value="{!! $estudio->id !!}"> {!! $estudio->nombre !!}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="tab-pane" id="tratamientos">
                    <h3>Tratamientos</h3>
                    <div class="well well bs-component">
                        <fieldset id="patologias-fieldset">
                             <div>

                                <select class="chosen-select" multiple name="tratamientos[]" id="select-tratamientos">
                                    @if(isset($tratamientosSeleccionadas))
                                        @foreach($tratamientos as $tratamiento)
                                            <option value="{!! $tratamiento->id !!}" @if(in_array($tratamiento->id, $tratamientosSeleccionadas))
                                            selected="selected" @endif> {!! $tratamiento->droga !!}</option>
                                        @endforeach
                                    @else
                                        @foreach($tratamientos as $tratamiento)
                                            <option value="{!! $tratamiento->id !!}"> {!! $tratamiento->droga !!}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <!--<div class="tab-pane" id="grupo-clinico">
                    <h3>Grupo Cl&iacute;nico</h3>
                </div>-->
 
   
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

        
    </script>

@endsection

@section('scripts')

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

        $(".chosen-select").chosen({
            no_results_text: "No se encontraron resultados para las palabras ingresadas",
            width: "95%",
            placeholder_text_multiple: "Seleccione del listado los campos o escriba para reducir los resultados "
        });
    });

    $.datepicker.setDefaults($.datepicker.regional['es']);

    $(function() {
        $(".datepicker").datepicker();
    });
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
