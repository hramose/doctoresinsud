@extends('master')

@section('title')
    Historia Clínica - {!! $paciente->apellido . "," . $paciente->nombre !!} - Datos Familiares, Epidemiológicos y Socio-económicos
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
    <script src="{{url('/')."/js/vue.js"}}"></script>
    <script>
        $.datepicker.setDefaults($.datepicker.regional['es']);

        $(function() {
            $(".datepicker").datepicker();
        });

        var valCantHabitCasa = $('#cant_habit_casa').val();
        var valCantPersCasa = $('#cant_pers_casa').val();
        var valCantConvivTrabajan = $('#cant_conviv_trabajan').val();

        new Vue({
            el: 'body',
            data: {
                cantHabitCasa: valCantHabitCasa,
                cantPersCasa: valCantPersCasa,
                cantConvivTrabajan: valCantConvivTrabajan,
            },
            computed: {
                indiceHacinamiento: function () {
                    return this.cantPersCasa/this.cantHabitCasa;
                },
                indiceTrabConv: function () {
                    return this.cantConvivTrabajan/this.cantPersCasa;
                }
            }
        });
    </script>
@endsection

@section('content')
    <div class="panel panel-primary" style="margin-top: -20px   ">
        <div class="panel-heading">
            <div class="row">
                <div class="col-lg-8">
                    <h2 class="text-left" style="border-radius: 0">Historia Clínica
                        de {!! $paciente->apellido . ", " . $paciente->nombre . " (H.C.:" . $paciente->id_hc . ")"!!}
                    </h2>
                </div>
                <div class="col-lg-4">
                    <div class="btn-group btn-group-justified btn-group-raised">
                        <a href="{{ URL::previous() }}" class="btn btn-raised btn-default" style="background-color: #EEEEEE">Cancelar</a>
                        <label for="submit-guardar" class="btn btn-raised btn-success">Guardar Datos</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">
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
                <input type="hidden" name="epidemiologia_id" value="{!! $paciente->epidemiologia->id !!}">

                {{--Primera sección--}}
                <div class="row">
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-lg-12">
                                {{--Datos Personales--}}
                                <div class="panel panel-default">
                                    <div class="panel-heading">Datos Personales</div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <label for="sexo"
                                                   class="col-lg-8 text-left">Sexo</label>
                                            <div class="col-lg-4">
                                                <select class="form-control" id="sexo" name="sexo">
                                                    <option value=""></option>
                                                    <option value="M" @if($paciente->epidemiologia->sexo=="M") selected @endif>Masculino</option>
                                                    <option value="F" @if($paciente->epidemiologia->sexo=="F") selected @endif>Femenino</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="estado_civil"
                                                   class="col-lg-8 text-left">Estado Civil</label>
                                            <div class="col-lg-4">
                                                <select class="form-control" id="estado_civil" name="estado_civil">
                                                    <option value=""></option>
                                                    <option value="S" @if($paciente->epidemiologia->estado_civil=="S") selected @endif>Soltero</option>
                                                    <option value="C" @if($paciente->epidemiologia->estado_civil=="C") selected @endif>Casado</option>
                                                    <option value="J" @if($paciente->epidemiologia->estado_civil=="J") selected @endif>Concuvino</option>
                                                    <option value="V" @if($paciente->epidemiologia->estado_civil=="V") selected @endif>Viudo</option>
                                                    <option value="D" @if($paciente->epidemiologia->estado_civil=="D") selected @endif>Divorciado</option>
                                                    {{--Opción dejada para conservar datos históricos no categorizados--}}
                                                    @if(! in_array($paciente->epidemiologia->estado_civil, array("S", "C", "J", "V", "D", "")))<option value="{!! $paciente->epidemiologia->estado_civil!!}" selected>{!! $paciente->epidemiologia->estado_civil !!}</option>@endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                {{--Sangre--}}
                                <div class="panel panel-default">
                                    <div class="panel-heading">Sangre</div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <label for="embarazo"
                                                   class="col-lg-8 text-left">¿Está embarazada?</label>
                                            <div class="col-lg-4">
                                                {!! Form::checkbox('embarazo', old('embarazo'), in_array(old('embarazo', $paciente->epidemiologia->embarazo), array('on', 2)) ?  true : false, ['class'=>'form-control', 'id'=>'embarazo']) !!}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="dador_sangre"
                                                   class="col-lg-8 text-left">¿Donó sangre?</label>
                                            <div class="col-lg-4">
                                                <select class="form-control" id="dador_sangre" name="dador_sangre">
                                                    <option value=""></option>
                                                    <option value="S" @if($paciente->epidemiologia->dador_sangre=="S") selected @endif>Si</option>
                                                    <option value="N" @if($paciente->epidemiologia->dador_sangre=="N") selected @endif>No</option>
                                                    @if(! in_array($paciente->epidemiologia->dador_sangre, array("S", "N", "")))<option value="{!! $paciente->epidemiologia->dador_sangre!!}" selected>{!! $paciente->epidemiologia->dador_sangre !!}</option>@endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="dador_sangre_cant"
                                                   class="col-lg-8 text-left">¿Cuántas veces donó sangre?</label>
                                            <div class="col-lg-4">
                                                <input type="number" class="form-control" id="dador_sangre_cant" name="dador_sangre_cant" value="{!! old('dador_sangre_cant', $paciente->epidemiologia->dador_sangre_cant) !!}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="dador_sangre_hosp"
                                                   class="col-lg-8 text-left">¿En qué hospital/es donó?</label>
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control" id="dador_sangre_hosp" name="dador_sangre_hosp" value="{!! old('dador_sangre_hosp', $paciente->epidemiologia->dador_sangre_hosp) !!}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="recep_sangre"
                                                   class="col-lg-8 text-left">¿Cuántas veces recibió sangre?</label>
                                            <div class="col-lg-4">
                                                <input type="number" class="form-control" id="recep_sangre" name="recep_sangre" value="{!! old('recep_sangre', $paciente->epidemiologia->recep_sangre) !!}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="recep_sangre_hosp"
                                                   class="col-lg-8 text-left">¿En qué hospital/es recibió sangre?</label>
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control" id="recep_sangre_hosp" name="recep_sangre_hosp" value="{!! old('recep_sangre_hosp', $paciente->epidemiologia->recep_sangre_hosp) !!}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="recep_sangre_motivo"
                                                   class="col-lg-8 text-left">Motivo de la transfusión</label>
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control" id="recep_sangre_motivo" name="recep_sangre_motivo" value="{!! old('recep_sangre_motivo', $paciente->epidemiologia->recep_sangre_motivo) !!}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-lg-12">
                                {{--Lugar de Nacimiento--}}
                                <div class="panel panel-default">
                                    <div class="panel-heading">Lugar de Nacimiento</div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <label for="localidad_nac" style="vertical-align: bottom;"
                                                   class="col-lg-3 text-left">Localidad</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" id="localidad_nac" name="localidad_nac" value="{!! old('localidad_nac', $paciente->epidemiologia->localidad_nac) !!}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="provincia_nac"
                                                   class="col-lg-3 text-left">Provincia</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" id="provincia_nac" name="provincia_nac" value="{!! old('provincia_nac', $paciente->epidemiologia->provincia_nac) !!}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="pais_nac"
                                                   class="col-lg-3 text-left">País</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" id="pais_nac" name="pais_nac" value="{!! old('pais_nac', $paciente->epidemiologia->pais_nac) !!}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                {{--Preguntas de Chagas--}}
                                <div class="panel panel-default">
                                    <div class="panel-heading">Preguntas de Chagas</div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <label for="conoce_vinchuca"
                                                   class="col-lg-8 text-left">¿Conoce vinchuca?</label>
                                            <div class="col-lg-4">
                                                <select class="form-control" id="conoce_vinchuca" name="conoce_vinchuca">
                                                    <option value=""></option>
                                                    <option value="S" @if($paciente->epidemiologia->conoce_vinchuca=="S") selected @endif>Si</option>
                                                    <option value="N" @if($paciente->epidemiologia->conoce_vinchuca=="N") selected @endif>No</option>
                                                    @if(! in_array($paciente->epidemiologia->conoce_vinchuca, array("S", "N", "")))<option value="{!! $paciente->epidemiologia->conoce_vinchuca!!}" selected>{!! $paciente->epidemiologia->conoce_vinchuca !!}</option>@endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="puerta_entrada"
                                                   class="col-lg-8 text-left">¿Cuál fue la puerta de entrada?</label>
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control" id="puerta_entrada" name="puerta_entrada" value="{!! old('puerta_entrada', $paciente->epidemiologia->puerta_entrada) !!}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="sabe_chagasico"
                                                   class="col-lg-8 text-left">¿Se sabe chagásico?</label>
                                            <div class="col-lg-4">
                                                <select class="form-control" id="sabe_chagasico" name="sabe_chagasico">
                                                    <option value=""></option>
                                                    <option value="S" @if($paciente->epidemiologia->sabe_chagasico=="S") selected @endif>Si</option>
                                                    <option value="N" @if($paciente->epidemiologia->sabe_chagasico=="N") selected @endif>No</option>
                                                    @if(! in_array($paciente->epidemiologia->sabe_chagasico, array("S", "N", "")))<option value="{!! $paciente->epidemiologia->sabe_chagasico!!}" selected>{!! $paciente->epidemiologia->sabe_chagasico !!}</option>@endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="motivo_det_chagas"
                                                   class="col-lg-8 text-left">¿Motivo por el cual detectan Chagas?</label>
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control" id="motivo_det_chagas" name="motivo_det_chagas" value="{!! old('motivo_det_chagas', $paciente->epidemiologia->motivo_det_chagas) !!}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="fecha_det_chagas" class="col-lg-8 text-left">Fecha de detección de Chagas</label>
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control datepicker" id="fecha_det_chagas"
                                                       name="fecha_det_chagas"
                                                       value="@if($paciente->epidemiologia->fecha_det_chagas){!! old('fecha_det_chagas',$paciente->epidemiologia->fecha_det_chagas->format('d/m/Y')) !!}@endif">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="confirmacion_chagas"
                                                   class="col-lg-8 text-left">Confirmación de Chagas</label>
                                            <div class="col-lg-4">
                                                <select class="form-control" id="confirmacion_chagas" name="confirmacion_chagas">
                                                    <option value=""></option>
                                                    <option value="S" @if($paciente->epidemiologia->confirmacion_chagas=="S") selected @endif>Si</option>
                                                    <option value="N" @if($paciente->epidemiologia->confirmacion_chagas=="N") selected @endif>No</option>
                                                    @if(! in_array($paciente->epidemiologia->confirmacion_chagas, array("S", "N", "")))<option value="{!! $paciente->epidemiologia->confirmacion_chagas!!}" selected>{!! $paciente->epidemiologia->confirmacion_chagas !!}</option>@endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        {{--Datos Endémicos--}}
                        <div class="panel panel-default">
                            <div class="panel-heading">Datos Endémicos</div>
                            <div class="panel-body">
                                <div class="row">
                                    <label for="lugar_nac_urbanizado"
                                           class="col-lg-8 text-left">¿Lugar de nacimiento urbanizado?</label>
                                    <div class="col-lg-4">
                                        <select class="form-control" id="lugar_nac_urbanizado" name="lugar_nac_urbanizado">
                                            <option value=""></option>
                                            <option value="R" @if($paciente->epidemiologia->lugar_nac_urbanizado=="R") selected @endif>Rural</option>
                                            <option value="U" @if($paciente->epidemiologia->lugar_nac_urbanizado=="U") selected @endif>Urbano</option>
                                            <option value="?" @if($paciente->epidemiologia->lugar_nac_urbanizado=="?") selected @endif>No se sabe</option>
                                            @if(! in_array($paciente->epidemiologia->lugar_nac_urbanizado, array("R", "U", "?", "")))<option value="{!! $paciente->epidemiologia->lugar_nac_urbanizado!!}" selected>{!! $paciente->epidemiologia->lugar_nac_urbanizado !!}</option>@endif
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="tipo_vivienda_nac"
                                           class="col-lg-8 text-left">Tipo de vivienda donde nació</label>
                                    <div class="col-lg-4">
                                        <select class="form-control" id="tipo_vivienda_nac" name="tipo_vivienda_nac">
                                            <option value=""></option>
                                            <option value="P" @if($paciente->epidemiologia->tipo_vivienda_nac=="P") selected @endif>Precario</option>
                                            <option value="M" @if($paciente->epidemiologia->tipo_vivienda_nac=="M") selected @endif>Material</option>
                                            <option value="?" @if($paciente->epidemiologia->tipo_vivienda_nac=="?") selected @endif>No se sabe</option>
                                            @if(! in_array($paciente->epidemiologia->tipo_vivienda_nac, array("P", "M", "?", "")))<option value="{!! $paciente->epidemiologia->tipo_vivienda_nac!!}" selected>{!! $paciente->epidemiologia->tipo_vivienda_nac !!}</option>@endif
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="anios_area_endemica"
                                           class="col-lg-8 text-left">Años de residencia en área endémica</label>
                                    <div class="col-lg-4">
                                        <input type="number" class="form-control" id="anios_area_endemica" name="anios_area_endemica" value="{!! old('anios_area_endemica', $paciente->epidemiologia->anios_area_endemica) !!}">
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="tipo_residencia_ende"
                                           class="col-lg-8 text-left">Tipo de residencia en área endémica</label>
                                    <div class="col-lg-4">
                                        <select class="form-control" id="tipo_residencia_ende" name="tipo_residencia_ende">
                                            <option value=""></option>
                                            <option value="P" @if($paciente->epidemiologia->tipo_residencia_ende=="P") selected @endif>Permanente</option>
                                            <option value="A" @if($paciente->epidemiologia->tipo_residencia_ende=="A") selected @endif>Aislada</option>
                                            <option value="N" @if($paciente->epidemiologia->tipo_residencia_ende=="N") selected @endif>No residió</option>
                                            <option value="?" @if($paciente->epidemiologia->tipo_residencia_ende=="?") selected @endif>No se sabe</option>
                                            @if(! in_array($paciente->epidemiologia->tipo_residencia_ende, array("P", "A", "N", "?", "")))<option value="{!! $paciente->epidemiologia->tipo_residencia_ende!!}" selected>{!! $paciente->epidemiologia->tipo_residencia_ende !!}</option>@endif
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="volvio_area_ende"
                                           class="col-lg-8 text-left">¿Volvió a área endémica?</label>
                                    <div class="col-lg-4">
                                        <select class="form-control" id="volvio_area_ende" name="volvio_area_ende">
                                            <option value=""></option>
                                            <option value="S" @if($paciente->epidemiologia->volvio_area_ende=="S") selected @endif>Si</option>
                                            <option value="N" @if($paciente->epidemiologia->volvio_area_ende=="N") selected @endif>No</option>
                                            <option value="?" @if($paciente->epidemiologia->volvio_area_ende=="?") selected @endif>No se sabe</option>
                                            @if(! in_array($paciente->epidemiologia->volvio_area_ende, array("S", "N", "?", "")))<option value="{!! $paciente->epidemiologia->volvio_area_ende!!}" selected>{!! $paciente->epidemiologia->volvio_area_ende !!}</option>@endif
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="volvio_reciente_ende"
                                           class="col-lg-8 text-left">¿Volvió recientemente?</label>
                                    <div class="col-lg-4">
                                        <select class="form-control" id="volvio_reciente_ende" name="volvio_reciente_ende">
                                            <option value=""></option>
                                            <option value="S" @if($paciente->epidemiologia->volvio_reciente_ende=="S") selected @endif>Si</option>
                                            <option value="N" @if($paciente->epidemiologia->volvio_reciente_ende=="N") selected @endif>No</option>
                                            <option value="?" @if($paciente->epidemiologia->volvio_reciente_ende=="?") selected @endif>No se sabe</option>
                                            @if(! in_array($paciente->epidemiologia->volvio_reciente_ende, array("S", "N", "?", "")))<option value="{!! $paciente->epidemiologia->volvio_reciente_ende!!}" selected>{!! $paciente->epidemiologia->volvio_reciente_ende !!}</option>@endif
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="fecha_cuando_volvio_ende" class="col-lg-8 text-left">¿Cuándo volvió a área endémica?</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control datepicker" id="fecha_cuando_volvio_ende"
                                               name="fecha_cuando_volvio_ende"
                                               value="@if($paciente->epidemiologia->fecha_cuando_volvio_ende){!! old('fecha_cuando_volvio_ende',$paciente->epidemiologia->fecha_cuando_volvio_ende->format('d/m/Y')) !!}@endif">
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="otras_areas_ende"
                                           class="col-lg-8 text-left">¿Otras áreas?</label>
                                    <div class="col-lg-4">
                                        <select class="form-control" id="otras_areas_ende" name="otras_areas_ende">
                                            <option value=""></option>
                                            <option value="S" @if($paciente->epidemiologia->otras_areas_ende=="S") selected @endif>Si</option>
                                            <option value="N" @if($paciente->epidemiologia->otras_areas_ende=="N") selected @endif>No</option>
                                            <option value="?" @if($paciente->epidemiologia->otras_areas_ende=="?") selected @endif>No se sabe</option>
                                            @if(! in_array($paciente->epidemiologia->otras_areas_ende, array("S", "N", "?", "")))<option value="{!! $paciente->epidemiologia->otras_areas_ende!!}" selected>{!! $paciente->epidemiologia->otras_areas_ende !!}</option>@endif
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="otras_areas_ende_lugar" style="vertical-align: bottom;"
                                           class="col-lg-5 text-left">¿Cuáles otras áreas?</label>
                                    <div class="col-lg-7">
                                        <input type="text" class="form-control" id="otras_areas_ende_lugar" name="otras_areas_ende_lugar" value="{!! old('otras_areas_ende_lugar', $paciente->epidemiologia->otras_areas_ende_lugar) !!}">
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="otras_areas_ende_tiempo"
                                           class="col-lg-8 text-left">Tiempo que residió en otras áreas</label>
                                    <div class="col-lg-4">
                                        <input type="number" class="form-control" id="otras_areas_ende_tiempo" name="otras_areas_ende_tiempo" value="{!! old('otras_areas_ende_tiempo', $paciente->epidemiologia->otras_areas_ende_tiempo) !!}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--Fin Primera sección--}}
                {{--Segunda Sección--}}
                <div class="row">
                    <div class="col-lg-12">
                        {{--Antecedentes Familiares--}}
                        <div class="panel panel-default">
                            <div class="panel-heading">Antecedentes Familiares</div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-4">
                                        {{--Muerte Subita--}}
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Muerte Súbita</div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <label for="antefam_muerte_sub_no"
                                                           class="col-lg-8 text-left">No</label>
                                                    <div class="col-lg-4">
                                                        {!! Form::checkbox('antefam_muerte_sub_no', old('antefam_muerte_sub_no'), in_array(old('antefam_muerte_sub_no', $paciente->epidemiologia->antefam_muerte_sub_no), array('on', 2)) ?  true : false, ['class'=>'form-control', 'id'=>'antefam_muerte_sub_no']) !!}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label for="antefam_muerte_sub_ns"
                                                           class="col-lg-8 text-left">No sabe</label>
                                                    <div class="col-lg-4">
                                                        {!! Form::checkbox('antefam_muerte_sub_ns', old('antefam_muerte_sub_ns'), in_array(old('antefam_muerte_sub_ns', $paciente->epidemiologia->antefam_muerte_sub_ns), array('on', 2)) ?  true : false, ['class'=>'form-control', 'id'=>'antefam_muerte_sub_ns']) !!}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label for="antefam_muerte_sub_padre"
                                                           class="col-lg-8 text-left">Padre</label>
                                                    <div class="col-lg-4">
                                                        {!! Form::checkbox('antefam_muerte_sub_padre', old('antefam_muerte_sub_padre'), in_array(old('antefam_muerte_sub_padre', $paciente->epidemiologia->antefam_muerte_sub_padre), array('on', 2)) ?  true : false, ['class'=>'form-control', 'id'=>'antefam_muerte_sub_padre']) !!}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label for="antefam_muerte_sub_madre"
                                                           class="col-lg-8 text-left">Madre</label>
                                                    <div class="col-lg-4">
                                                        {!! Form::checkbox('antefam_muerte_sub_madre', old('antefam_muerte_sub_madre'), in_array(old('antefam_muerte_sub_madre', $paciente->epidemiologia->antefam_muerte_sub_madre), array('on', 2)) ?  true : false, ['class'=>'form-control', 'id'=>'antefam_muerte_sub_madre']) !!}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label for="antefam_muerte_sub_hermano"
                                                           class="col-lg-8 text-left">Hermano</label>
                                                    <div class="col-lg-4">
                                                        {!! Form::checkbox('antefam_muerte_sub_hermano', old('antefam_muerte_sub_hermano'), in_array(old('antefam_muerte_sub_hermano', $paciente->epidemiologia->antefam_muerte_sub_hermano), array('on', 2)) ?  true : false, ['class'=>'form-control', 'id'=>'antefam_muerte_sub_hermano']) !!}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label for="antefam_muerte_sub_hijo"
                                                           class="col-lg-8 text-left">Hijo</label>
                                                    <div class="col-lg-4">
                                                        {!! Form::checkbox('antefam_muerte_sub_hijo', old('antefam_muerte_sub_hijo'), in_array(old('antefam_muerte_sub_hijo', $paciente->epidemiologia->antefam_muerte_sub_hijo), array('on', 2)) ?  true : false, ['class'=>'form-control', 'id'=>'antefam_muerte_sub_hijo']) !!}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label for="antefam_muerte_sub_otros"
                                                           class="col-lg-8 text-left">Otro familiar</label>
                                                    <div class="col-lg-4">
                                                        {!! Form::checkbox('antefam_muerte_sub_otros', old('antefam_muerte_sub_otros'), in_array(old('antefam_muerte_sub_otros', $paciente->epidemiologia->antefam_muerte_sub_otros), array('on', 2)) ?  true : false, ['class'=>'form-control', 'id'=>'antefam_muerte_sub_otros']) !!}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label for="antefam_muerte_sub_desc"
                                                           class="col-lg-8 text-left">Desconocido</label>
                                                    <div class="col-lg-4">
                                                        {!! Form::checkbox('antefam_muerte_sub_desc', old('antefam_muerte_sub_desc'), in_array(old('antefam_muerte_sub_desc', $paciente->epidemiologia->antefam_muerte_sub_desc), array('on', 2)) ?  true : false, ['class'=>'form-control', 'id'=>'antefam_muerte_sub_desc']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        {{--Afección Cardíaca--}}
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Afección Cardíaca</div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <label for="antefam_afcardi_sub_no"
                                                           class="col-lg-8 text-left">No</label>
                                                    <div class="col-lg-4">
                                                        {!! Form::checkbox('antefam_afcardi_sub_no', old('antefam_afcardi_sub_no'), in_array(old('antefam_afcardi_sub_no', $paciente->epidemiologia->antefam_afcardi_sub_no), array('on', 2)) ?  true : false, ['class'=>'form-control', 'id'=>'antefam_afcardi_sub_no']) !!}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label for="antefam_afcardi_sub_ns"
                                                           class="col-lg-8 text-left">No sabe</label>
                                                    <div class="col-lg-4">
                                                        {!! Form::checkbox('antefam_afcardi_sub_ns', old('antefam_afcardi_sub_ns'), in_array(old('antefam_afcardi_sub_ns', $paciente->epidemiologia->antefam_afcardi_sub_ns), array('on', 2)) ?  true : false, ['class'=>'form-control', 'id'=>'antefam_afcardi_sub_ns']) !!}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label for="antefam_afcardi_sub_padre"
                                                           class="col-lg-8 text-left">Padre</label>
                                                    <div class="col-lg-4">
                                                        {!! Form::checkbox('antefam_afcardi_sub_padre', old('antefam_afcardi_sub_padre'), in_array(old('antefam_afcardi_sub_padre', $paciente->epidemiologia->antefam_afcardi_sub_padre), array('on', 2)) ?  true : false, ['class'=>'form-control', 'id'=>'antefam_afcardi_sub_padre']) !!}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label for="antefam_afcardi_sub_madre"
                                                           class="col-lg-8 text-left">Madre</label>
                                                    <div class="col-lg-4">
                                                        {!! Form::checkbox('antefam_afcardi_sub_madre', old('antefam_afcardi_sub_madre'), in_array(old('antefam_afcardi_sub_madre', $paciente->epidemiologia->antefam_afcardi_sub_madre), array('on', 2)) ?  true : false, ['class'=>'form-control', 'id'=>'antefam_afcardi_sub_madre']) !!}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label for="antefam_afcardi_sub_hermano"
                                                           class="col-lg-8 text-left">Hermano</label>
                                                    <div class="col-lg-4">
                                                        {!! Form::checkbox('antefam_afcardi_sub_hermano', old('antefam_afcardi_sub_hermano'), in_array(old('antefam_afcardi_sub_hermano', $paciente->epidemiologia->antefam_afcardi_sub_hermano), array('on', 2)) ?  true : false, ['class'=>'form-control', 'id'=>'antefam_afcardi_sub_hermano']) !!}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label for="antefam_afcardi_sub_hijo"
                                                           class="col-lg-8 text-left">Hijo</label>
                                                    <div class="col-lg-4">
                                                        {!! Form::checkbox('antefam_afcardi_sub_hijo', old('antefam_afcardi_sub_hijo'), in_array(old('antefam_afcardi_sub_hijo', $paciente->epidemiologia->antefam_afcardi_sub_hijo), array('on', 2)) ?  true : false, ['class'=>'form-control', 'id'=>'antefam_afcardi_sub_hijo']) !!}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label for="antefam_afcardi_sub_otros"
                                                           class="col-lg-8 text-left">Otro familiar</label>
                                                    <div class="col-lg-4">
                                                        {!! Form::checkbox('antefam_afcardi_sub_otros', old('antefam_afcardi_sub_otros'), in_array(old('antefam_afcardi_sub_otros', $paciente->epidemiologia->antefam_afcardi_sub_otros), array('on', 2)) ?  true : false, ['class'=>'form-control', 'id'=>'antefam_afcardi_sub_otros']) !!}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label for="antefam_afcardi_sub_desc"
                                                           class="col-lg-8 text-left">Desconocido</label>
                                                    <div class="col-lg-4">
                                                        {!! Form::checkbox('antefam_afcardi_sub_desc', old('antefam_afcardi_sub_desc'), in_array(old('antefam_afcardi_sub_desc', $paciente->epidemiologia->antefam_afcardi_sub_desc), array('on', 2)) ?  true : false, ['class'=>'form-control', 'id'=>'antefam_afcardi_sub_desc']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        {{--Chagas--}}
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Chagas</div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <label for="antefam_chagas_sub_no"
                                                           class="col-lg-8 text-left">No</label>
                                                    <div class="col-lg-4">
                                                        {!! Form::checkbox('antefam_chagas_sub_no', old('antefam_chagas_sub_no'), in_array(old('antefam_chagas_sub_no', $paciente->epidemiologia->antefam_chagas_sub_no), array('on', 2)) ?  true : false, ['class'=>'form-control', 'id'=>'antefam_chagas_sub_no']) !!}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label for="antefam_chagas_sub_ns"
                                                           class="col-lg-8 text-left">No sabe</label>
                                                    <div class="col-lg-4">
                                                        {!! Form::checkbox('antefam_chagas_sub_ns', old('antefam_chagas_sub_ns'), in_array(old('antefam_chagas_sub_ns', $paciente->epidemiologia->antefam_chagas_sub_ns), array('on', 2)) ?  true : false, ['class'=>'form-control', 'id'=>'antefam_chagas_sub_ns']) !!}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label for="antefam_chagas_sub_padre"
                                                           class="col-lg-8 text-left">Padre</label>
                                                    <div class="col-lg-4">
                                                        {!! Form::checkbox('antefam_chagas_sub_padre', old('antefam_chagas_sub_padre'), in_array(old('antefam_chagas_sub_padre', $paciente->epidemiologia->antefam_chagas_sub_padre), array('on', 2)) ?  true : false, ['class'=>'form-control', 'id'=>'antefam_chagas_sub_padre']) !!}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label for="antefam_chagas_sub_madre"
                                                           class="col-lg-8 text-left">Madre</label>
                                                    <div class="col-lg-4">
                                                        {!! Form::checkbox('antefam_chagas_sub_madre', old('antefam_chagas_sub_madre'), in_array(old('antefam_chagas_sub_madre', $paciente->epidemiologia->antefam_chagas_sub_madre), array('on', 2)) ?  true : false, ['class'=>'form-control', 'id'=>'antefam_chagas_sub_madre']) !!}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label for="antefam_chagas_sub_hermano"
                                                           class="col-lg-8 text-left">Hermano</label>
                                                    <div class="col-lg-4">
                                                        {!! Form::checkbox('antefam_chagas_sub_hermano', old('antefam_chagas_sub_hermano'), in_array(old('antefam_chagas_sub_hermano', $paciente->epidemiologia->antefam_chagas_sub_hermano), array('on', 2)) ?  true : false, ['class'=>'form-control', 'id'=>'antefam_chagas_sub_hermano']) !!}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label for="antefam_chagas_sub_hijo"
                                                           class="col-lg-8 text-left">Hijo</label>
                                                    <div class="col-lg-4">
                                                        {!! Form::checkbox('antefam_chagas_sub_hijo', old('antefam_chagas_sub_hijo'), in_array(old('antefam_chagas_sub_hijo', $paciente->epidemiologia->antefam_chagas_sub_hijo), array('on', 2)) ?  true : false, ['class'=>'form-control', 'id'=>'antefam_chagas_sub_hijo']) !!}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label for="antefam_chagas_sub_otros"
                                                           class="col-lg-8 text-left">Otro familiar</label>
                                                    <div class="col-lg-4">
                                                        {!! Form::checkbox('antefam_chagas_sub_otros', old('antefam_chagas_sub_otros'), in_array(old('antefam_chagas_sub_otros', $paciente->epidemiologia->antefam_chagas_sub_otros), array('on', 2)) ?  true : false, ['class'=>'form-control', 'id'=>'antefam_chagas_sub_otros']) !!}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label for="antefam_chagas_sub_desc"
                                                           class="col-lg-8 text-left">Desconocido</label>
                                                    <div class="col-lg-4">
                                                        {!! Form::checkbox('antefam_chagas_sub_desc', old('antefam_chagas_sub_desc'), in_array(old('antefam_chagas_sub_desc', $paciente->epidemiologia->antefam_chagas_sub_desc), array('on', 2)) ?  true : false, ['class'=>'form-control', 'id'=>'antefam_chagas_sub_desc']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        {{--Campo Descripción Antecedentes Familiares--}}
                                        <div class="row">
                                            <label for="antefam_descrip" style="vertical-align: bottom;"
                                                   class="col-lg-2 text-left">Descripción antecedentes</label>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" id="antefam_descrip" name="antefam_descrip" value="{!! old('antefam_descrip', $paciente->epidemiologia->antefam_descrip) !!}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--Fin Segunda Sección--}}
                {{--Tercera Sección--}}
                <div class="row">
                    <div class="col-lg-4">
                        {{--Composición de Vivienda--}}
                        <div class="panel panel-default">
                            <div class="panel-heading">Composición de Vivienda</div>
                            <div class="panel-body">
                                <div class="row">
                                    <label for="conyuge"
                                           class="col-lg-8 text-left">¿Vive con su esposo/a?</label>
                                    <div class="col-lg-4">
                                        <select class="form-control" id="conyuge" name="conyuge">
                                            <option value=""></option>
                                            <option value="S" @if($paciente->epidemiologia->conyuge=="S") selected @endif>Si</option>
                                            <option value="N" @if($paciente->epidemiologia->conyuge=="N") selected @endif>No</option>
                                            @if(! in_array($paciente->epidemiologia->conyuge, array("S", "N", "")))<option value="{!! $paciente->epidemiologia->conyuge!!}" selected>{!! $paciente->epidemiologia->conyuge !!}</option>@endif
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="cant_hijos"
                                           class="col-lg-8 text-left">¿Cuántos hijos tiene?</label>
                                    <div class="col-lg-4">
                                        <input type="number" class="form-control" id="cant_hijos" name="cant_hijos" value="{!! old('cant_hijos', $paciente->epidemiologia->cant_hijos) !!}">
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="cant_pers_casa"
                                           class="col-lg-8 text-left">Cantidad de personas en vivienda</label>
                                    <div class="col-lg-4">
                                        <input type="number" class="form-control" id="cant_pers_casa" v-model="cantPersCasa" name="cant_pers_casa" value="{!! old('cant_pers_casa', $paciente->epidemiologia->cant_pers_casa) !!}">
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="cant_habit_casa"
                                           class="col-lg-8 text-left">Nro. de habitaciones (dormitorios y comedor)</label>
                                    <div class="col-lg-4">
                                        <input type="number" class="form-control" id="cant_habit_casa" v-model="cantHabitCasa" name="cant_habit_casa" value="{!! old('cant_habit_casa', $paciente->epidemiologia->cant_habit_casa) !!}">
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="indice_hacinamiento" style="vertical-align: bottom;"
                                           class="col-lg-8 text-left">Indice de hacinamiento</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" id="indice_hacinamiento" value="@{{ indiceHacinamiento }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-lg-12">
                                {{--Servicios--}}
                                <div class="panel panel-default">
                                    <div class="panel-heading">Servicios</div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <label for="agua"
                                                   class="col-lg-8 text-left">Agua</label>
                                            <div class="col-lg-4">
                                                <select class="form-control" id="agua" name="agua">
                                                    <option value=""></option>
                                                    <option value="A" @if($paciente->epidemiologia->agua=="A") selected @endif>Agua corriente</option>
                                                    <option value="B" @if($paciente->epidemiologia->agua=="B") selected @endif>Bomba</option>
                                                    <option value="P" @if($paciente->epidemiologia->agua=="P") selected @endif>Pozo</option>
                                                    <option value="?" @if($paciente->epidemiologia->agua=="?") selected @endif>No se sabe</option>
                                                    @if(! in_array($paciente->epidemiologia->agua, array("A", "B", "P", "?", "")))<option value="{!! $paciente->epidemiologia->agua!!}" selected>{!! $paciente->epidemiologia->agua !!}</option>@endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="canieria"
                                                   class="col-lg-8 text-left">¿Tiene cañería dentro de la vivienda?</label>
                                            <div class="col-lg-4">
                                                <select class="form-control" id="canieria" name="canieria">
                                                    <option value=""></option>
                                                    <option value="S" @if($paciente->epidemiologia->canieria=="S") selected @endif>Si</option>
                                                    <option value="N" @if($paciente->epidemiologia->canieria=="N") selected @endif>No</option>
                                                    <option value="?" @if($paciente->epidemiologia->canieria=="?") selected @endif>No se sabe</option>
                                                    @if(! in_array($paciente->epidemiologia->canieria, array("N", "S", "?", "")))<option value="{!! $paciente->epidemiologia->canieria!!}" selected>{!! $paciente->epidemiologia->canieria !!}</option>@endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="sanitario"
                                                   class="col-lg-8 text-left">¿Tiene sanitario dentro de la vivienda?</label>
                                            <div class="col-lg-4">
                                                <select class="form-control" id="sanitario" name="sanitario">
                                                    <option value=""></option>
                                                    <option value="S" @if($paciente->epidemiologia->sanitario=="S") selected @endif>Si</option>
                                                    <option value="N" @if($paciente->epidemiologia->sanitario=="N") selected @endif>No</option>
                                                    <option value="?" @if($paciente->epidemiologia->sanitario=="?") selected @endif>No se sabe</option>
                                                    @if(! in_array($paciente->epidemiologia->sanitario, array("N", "S", "?", "")))<option value="{!! $paciente->epidemiologia->sanitario!!}" selected>{!! $paciente->epidemiologia->sanitario !!}</option>@endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                {{--Estudios--}}
                                <div class="panel panel-default">
                                    <div class="panel-heading">Estudios</div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <label for="escolaridad"
                                                   class="col-lg-8 text-left">Nivel de escolaridad</label>
                                            <div class="col-lg-4">
                                                <select class="form-control" id="escolaridad" name="escolaridad">
                                                    <option value=""></option>
                                                    <option value="AN" @if($paciente->epidemiologia->escolaridad=="AN") selected @endif>Analfabeto</option>
                                                    <option value="AL" @if($paciente->epidemiologia->escolaridad=="AL") selected @endif>Alfabeto</option>
                                                    <option value="PI" @if($paciente->epidemiologia->escolaridad=="PI") selected @endif>Primiario Incompleto</option>
                                                    <option value="PC" @if($paciente->epidemiologia->escolaridad=="PC") selected @endif>Primiario Completo</option>
                                                    <option value="SI" @if($paciente->epidemiologia->escolaridad=="SI") selected @endif>Secundario Incompleto</option>
                                                    <option value="SC" @if($paciente->epidemiologia->escolaridad=="SC") selected @endif>Secundario Completo</option>
                                                    <option value="TI" @if($paciente->epidemiologia->escolaridad=="TI") selected @endif>Terciario Incompleto</option>
                                                    <option value="TC" @if($paciente->epidemiologia->escolaridad=="TC") selected @endif>Terciario Completo</option>
                                                    <option value="UI" @if($paciente->epidemiologia->escolaridad=="UI") selected @endif>Universitario Incompleto</option>
                                                    <option value="UC" @if($paciente->epidemiologia->escolaridad=="UC") selected @endif>Universitario Completo</option>
                                                    <option value="?" @if($paciente->epidemiologia->escolaridad=="?") selected @endif>No se sabe</option>
                                                    @if(! in_array($paciente->epidemiologia->escolaridad, array("AN", "AL", "PI", "PC", "SI", "SC", "TI", "TC", "UI", "UC", "?", "")))<option value="{!! $paciente->epidemiologia->escolaridad!!}" selected>{!! $paciente->epidemiologia->escolaridad !!}</option>@endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="grados_aprobados" style="vertical-align: bottom;"
                                                   class="col-lg-8 text-left">Cantidad de grados aprobados</label>
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control" id="grados_aprobados" name="grados_aprobados" value="{!! old('puerta_entrada', $paciente->epidemiologia->grados_aprobados) !!}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        {{--Situación laboral--}}
                        <div class="panel panel-default">
                            <div class="panel-heading">Situación Laboral</div>
                            <div class="panel-body">
                                <div class="row">
                                    <label for="trabajo"
                                           class="col-lg-8 text-left">¿Trabaja?</label>
                                    <div class="col-lg-4">
                                        <select class="form-control" id="trabajo" name="trabajo">
                                            <option value=""></option>
                                            <option value="S" @if($paciente->epidemiologia->trabajo=="S") selected @endif>Si</option>
                                            <option value="N" @if($paciente->epidemiologia->trabajo=="N") selected @endif>No</option>
                                            <option value="NOAC" @if($paciente->epidemiologia->trabajo=="NOAC") selected @endif>No, ama de casa</option>
                                            <option value="NOJU" @if($paciente->epidemiologia->trabajo=="NOJU") selected @endif>No, jubilado</option>
                                            <option value="NOES" @if($paciente->epidemiologia->trabajo=="NOES") selected @endif>No, estudiante</option>
                                            <option value="NODE" @if($paciente->epidemiologia->trabajo=="NODE") selected @endif>No, desocupado</option>
                                            <option value="?" @if($paciente->epidemiologia->trabajo=="?") selected @endif>No se sabe</option>
                                            @if(! in_array($paciente->epidemiologia->trabajo, array("S", "N", "NOAC", "NOJU", "NOES", "NODE", "?", "")))<option value="{!! $paciente->epidemiologia->trabajo!!}" selected>{!! $paciente->epidemiologia->trabajo !!}</option>@endif
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="tipo_trabajo"
                                           class="col-lg-4 text-left">Tipo de trabajo</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="tipo_trabajo" name="tipo_trabajo" value="{!! old('tipo_trabajo', $paciente->epidemiologia->tipo_trabajo) !!}">
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="rechazado_empleo_chagas"
                                           class="col-lg-8 text-left">¿Fue rechazado de algún empleo por Chagas?</label>
                                    <div class="col-lg-4">
                                        <select class="form-control" id="rechazado_empleo_chagas" name="rechazado_empleo_chagas">
                                            <option value=""></option>
                                            <option value="S" @if($paciente->epidemiologia->rechazado_empleo_chagas=="S") selected @endif>Si</option>
                                            <option value="N" @if($paciente->epidemiologia->rechazado_empleo_chagas=="N") selected @endif>No</option>
                                            <option value="?" @if($paciente->epidemiologia->rechazado_empleo_chagas=="?") selected @endif>No se sabe</option>
                                            @if(! in_array($paciente->epidemiologia->rechazado_empleo_chagas, array("S", "N", "?", "")))<option value="{!! $paciente->epidemiologia->rechazado_empleo_chagas!!}" selected>{!! $paciente->epidemiologia->rechazado_empleo_chagas !!}</option>@endif
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="nombre_empresa_rech"
                                           class="col-lg-6 text-left">¿Qué empresa lo rechazó?</label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="nombre_empresa_rech" name="nombre_empresa_rech" value="{!! old('nombre_empresa_rech', $paciente->epidemiologia->nombre_empresa_rech) !!}">
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="obra_social"
                                           class="col-lg-6 text-left">Nombre Obra Social</label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="obra_social" name="obra_social" value="{!! old('obra_social', $paciente->epidemiologia->obra_social) !!}">
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="cant_conviv_trabajan"
                                           class="col-lg-8 text-left">Cant. Familiares convivientes que trabajan</label>
                                    <div class="col-lg-4">
                                        <input type="number" class="form-control" id="cant_conviv_trabajan" v-model="cantConvivTrabajan" name="cant_conviv_trabajan" value="{!! old('cant_conviv_trabajan', $paciente->epidemiologia->cant_conviv_trabajan) !!}">
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="indice_trab_conv"
                                           class="col-lg-8 text-left">Indice trabajadores/convivientes</label>
                                    <div class="col-lg-4">
                                        <input type="number" step="any" class="form-control" id="indice_trab_conv" name="indice_trab_conv" value="@{{ indiceTrabConv }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--Fin Tercera Sección--}}

                    <input type="submit" class="hidden" name="submit-guardar" id="submit-guardar">
            </form>
        </div>
    </div>
@endsection