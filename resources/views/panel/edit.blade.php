@extends('master')

@section('title')
    Historia Clínica - {!! $paciente->apellido . "," . $paciente->nombre !!} - Editar
@endsection

@section('estilos')
    <style>
        textarea {
            /*max-width: 100%;*/
            resize: none;
        }
    </style>
@endsection

@section('scripts')
<script>
    $(document).on('ready', function () {
        $('#fecha_nac').change(function (e) {
            fechaNac = new Date($('#fecha_nac').val());
            fechaAlta = new Date($('#fecha_alta').val());
            yFecNac = fechaNac.getFullYear();
            yFecAlta = fechaAlta.getFullYear();
            $('#edad_ing').val(yFecAlta - yFecNac);
        });
    });

    $.datepicker.setDefaults($.datepicker.regional['es']);

    $(function() {
        $(".datepicker").datepicker();
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
                        <a href="{{ action('Panel\PanelHistoriasController@verHistoria', $paciente->id) }}" class="btn btn-raised btn-default" style="background-color: #EEEEEE">Cancelar</a>
                        {{--<a href="javascript:void(0)" class="btn btn-raised btn-success">Guardar Historia</a>--}}
                        <label for="submit-guardar" class="btn btn-raised btn-success">Guardar Historia</label>
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
                {{--Cabecera - Siempre visible--}}
                <div id="cabecera">
                    <div class="row">
                        {{--Columna Documento y Seguimiento--}}
                        {{--<div class="form-group">--}}
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <label for="tipo_doc" class="col-lg-2 text-left{{-- control-label --}} ">Tipo Documento</label>
                                <div class="col-lg-1">
                                    <input type="text" class="form-control" id="tipo_doc" name="tipo_doc"
                                           value="{!! $paciente->tipo_doc !!}">
                                </div>
                                {{--</div>--}}
                                {{--<div class="form-group">--}}
                                <label for="numero_doc" class="col-lg-2 text-left{{-- control-label --}}">Nro. Documento</label>
                                <div class="col-lg-2">
                                    <input type="text" class="form-control" id="numero_doc" name="numero_doc"
                                           value="{!! $paciente->numero_doc !!}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            {{--</div>--}}
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">Seguimiento</div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <label for="fecha_nac" class="col-lg-3 control-label">Fecha Nac.</label>
                                                <div class="col-lg-3">
                                                    <input type="text" class="form-control datepicker" id="fecha_nac" name="fecha_nac"
                                                           value="@if($paciente->fecha_nac){!! $paciente->fecha_nac->format('d/m/Y') !!}@endif">
                                                </div>
                                                <label for="edad_ing" class="col-lg-3 control-label">Edad al ingreso</label>
                                                <div class="col-lg-3">
                                                    <input type="number" class="form-control" id="edad_ing" name="edad_ing"
                                                           value="@if($paciente->fecha_alta and $paciente->fecha_nac){!! $paciente->fecha_alta->diffInYears($paciente->fecha_nac) !!}@else 0 @endif" readonly>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="fecha_alta" class="col-lg-3 control-label">Fecha Ing.</label>
                                                <div class="col-lg-3">
                                                    <input type="text" class="form-control" id="fecha_alta"
                                                           name="fecha_alta"
                                                           value="@if($paciente->fecha_alta){!! $paciente->fecha_alta->format('d/m/Y') !!}@endif" readonly>
                                                </div>
                                                <label for="anios_seg" class="col-lg-3 control-label">Años
                                                    Seguimiento.</label>
                                                <div class="col-lg-3">
                                                    <input type="number" class="form-control" id="anios_seg"
                                                           name="anios_seg"
                                                           value="@if($paciente->fecha_alta){!! \Carbon\Carbon::now()->diffInYears($paciente->fecha_alta) !!}@endif" readonly>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="fecha_ult_consulta" class="col-lg-3 control-label">Fecha Ult.
                                                    Consulta</label>
                                                <div class="col-lg-3">
                                                    <input type="text" class="form-control" id="fecha_ult_consulta"
                                                           name="fecha_ult_consulta"
                                                           {{--value="@if($paciente->fecha_ult_consulta){!! $paciente->fecha_ult_consulta->format('d/m/Y') !!}@endif"--}}
                                                           value="@if($maxConsulta){!! \Carbon\Carbon::parse($maxConsulta)->format('d/m/Y') !!}@elseif($paciente->fecha_ult_consulta){!! $paciente->fecha_ult_consulta->format('d/m/Y') !!}@endif"
                                                           readonly>
                                                </div>
                                                <label for="proxima_cita" class="col-lg-3 control-label">Próxima
                                                    Cita</label>
                                                <div class="col-lg-3">
                                                    <input type="text" class="form-control datepicker" id="proxima_cita"
                                                           name="proxima_cita"
                                                           value="@if($paciente->proxima_cita){!! $paciente->proxima_cita->format('d/m/Y') !!}@endif">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">ECG</div>
                                <div class="panel-body">
                                    <div class="row">
                                        <label for="ecg"
                                               class="col-lg-8 text-left {{--control-label --}}">Consignación</label>
                                        <div class="col-lg-4">
                                            <select class="form-control" id="ecg" name="ecg">
                                                <option value=""></option>
                                                <option value="N" @if($paciente->ecg=="N") selected @endif>Normal</option>
                                                <option value="E" @if($paciente->ecg=="E") selected @endif>Específico</option>
                                                <option value="I" @if($paciente->ecg=="I") selected @endif>Inespecífico</option>
                                                <option value="?" @if($paciente->ecg=="?") selected @endif>?</option>
                                            </select>
{{--                                            <input type="text" class="form-control" id="ecg"
                                                   name="ecg"
                                                   value="@if($paciente->ecg=="N") Normal @elseif($paciente->ecg=="E") Específico @elseif($paciente->ecg == "I") Inespecífico @else {!! $paciente->ecg !!} @endif">--}}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="tipo_ecg"
                                               class="col-lg-8 text-left {{--control-label --}}">Descripción</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control" id="tipo_ecg"
                                                   name="tipo_ecg" value="{!! $paciente->tipo_ecg !!}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="nuevos_cambios_ecg" class="col-lg-8 text-left {{--control-label --}}">Nuevos
                                            cambios</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control" id="nuevos_cambios_ecg"
                                                   name="nuevos_cambios_ecg" value="{!! $paciente->nuevos_cambios_ecg !!}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="fecha_cambios_ecg" class="col-lg-8 text-left {{--control-label --}}">Fecha
                                            del cambio</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control datepicker" id="fecha_cambios_ecg"
                                                   name="fecha_cambios_ecg"
                                                   value="@if($paciente->fecha_cambios_ecg){!! $paciente->fecha_cambios_ecg->format('d/m/Y') !!}@endif">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="tipo_cambio_ecg" class="col-lg-8 text-left {{--control-label --}}">Tipo
                                            de cambio</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control" id="tipo_cambio_ecg"
                                                   name="tipo_cambio_ecg" value="{!! $paciente->tipo_cambio_ecg !!}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="obs_ecg"
                                               class="col-lg-3 text-left {{--control-label --}}">Observación</label>
                                        <div class="col-lg-9">
                                        <textarea class="form-control" name="obs_ecg" id="obs_ecg" cols="30"
                                                  rows="2">{!! $paciente->obs_ecg !!}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            {{--//Columna Grupo Clínico--}}
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Grupo Clínico</div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <label for="grupo_clinico_ing" class="col-lg-8 control-label">Grupo Clínico al
                                                Ingreso</label>
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control" id="grupo_clinico_ing"
                                                       name="grupo_clinico_ing" value="{!! $paciente->grupo_clinico_ing !!}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="cambio_grupo_cli" class="col-lg-8 control-label">Cambio en el Grupo
                                                Clínico</label>
                                            <div class="col-lg-4">
                                                <select class="form-control" id="cambio_grupo_cli" name="cambio_grupo_cli">
                                                    <option value="S" @if($paciente->cambio_grupo_cli=="S") selected @endif>Si</option>
                                                    <option value="N" @if($paciente->cambio_grupo_cli=="N") selected @endif>No</option>
                                                    @if(! in_array($paciente->cambio_grupo_cli, array("S", "N", "")))<option value="{!! $paciente->cambio_grupo_cli !!}" selected>{!! $paciente->cambio_grupo_cli !!}</option>@endif
                                                    <option value="" @if($paciente->cambio_grupo_cli=="") selected @endif></option>
                                                </select>
{{--                                                <input type="text" class="form-control" id="cambio_grupo_cli"
                                                       name="cambio_grupo_cli"
                                                       value="@if($paciente->cambio_grupo_cli=="S") Si @elseif($paciente->cambio_grupo_cli=="N") No @endif">--}}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="fecha_cambio_gcli" class="col-lg-8 control-label">Fecha Cambio Grupo
                                                Clínico</label>
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control datepicker" id="fecha_cambio_gcli"
                                                       name="fecha_cambio_gcli"
                                                       value="@if($paciente->fecha_cambio_gcli){!! $paciente->fecha_cambio_gcli->format('d/m/Y') !!}@endif">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="nuevo_grupo_cli" class="col-lg-8 control-label">Nuevo Grupo
                                                Clínico</label>
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control" id="nuevo_grupo_cli"
                                                       name="nuevo_grupo_cli" value="{!! $paciente->nuevo_grupo_cli !!}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-1">
                            {{--//Columna Estado Paciente--}}
                            <div class="col-lg-12">
                                <div class="row">
                                    <label for="vivo" class="col-lg-12 control-label">¿Vivo?</label>
                                    <div class="col-lg-12">
                                        <select class="form-control" id="vivo" name="vivo">
                                            <option value=""> </option>
                                            <option value="S" @if($paciente->vivo =="S") selected @endif>Si</option>
                                            <option value="N" @if($paciente->vivo =="N") selected @endif>No</option>
                                        </select>
{{--                                        <input type="text" class="form-control" id="vivo" name="vivo"
                                               value="@if($paciente->vivo =="S") Si @elseif($paciente->vivo=="N") No @else {!! $paciente->vivo  !!} @endif">--}}
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="causa_muerte" class="col-lg-12 control-label">¿Causa muerte?</label>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control" id="causa_muerte" name="causa_muerte"
                                               value="{!! $paciente->causa_muerte !!}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--Detalles - Se ocultan y solo se muestran cuando el usuario decide--}}
                <div id="detalles">
                    <div class="row">
                        <div class="col-lg-4">
                            {{--Nuevo--}}
                            <div class="panel panel-default">
                                <div class="panel-heading">Tratamiento con BNZ</div>
                                <div class="panel-body">
                                    <div class="row">
                                        <label for="trat_bnz" class="col-lg-8 text-left {{--control-label --}}">Tratamiento
                                            con Benznidazol</label>
                                        <div class="col-lg-4">
                                            {!! Form::hidden('trat_bnz', 1) !!}
                                            <input type="checkbox" class="form-control" id="trat_bnz"
                                                   name="trat_bnz" @if($paciente->trat_bnz == 2) checked
                                                   @endif>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="fecha_ini_trat_bnz" class="col-lg-8 text-left {{--control-label --}}">Fecha
                                            Inicio Tratamiento</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control datepicker" id="fecha_ini_trat_bnz"
                                                   name="fecha_ini_trat_bnz"
                                                   value="@if($paciente->fecha_ini_trat_bnz){!! $paciente->fecha_ini_trat_bnz->format('d/m/Y') !!}@endif">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="efectos_adv_bnz" class="col-lg-8 text-left {{--control-label --}}">Efectos
                                            Adversos</label>
                                        <div class="col-lg-4">
                                            {!! Form::hidden('efectos_adv_bnz', 1) !!}
                                            <input type="checkbox" class="form-control" id="efectos_adv_bnz"
                                                   name="efectos_adv_bnz" @if($paciente->efectos_adv_bnz == 2) checked
                                                   @endif>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="efec_rash_bnz" class="col-lg-8 text-left {{--control-label --}}">Presenta
                                            rash cutáneo</label>
                                        <div class="col-lg-4">
                                            {!! Form::hidden('efec_rash_bnz', 1) !!}
                                            <input type="checkbox" class="form-control" id="efec_rash_bnz"
                                                   name="efec_rash_bnz" @if($paciente->efec_rash_bnz == 2) checked
                                                   @endif>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="efec_intgas_bnz" class="col-lg-8 text-left {{--control-label --}}">Presenta
                                            intolerancia gástrica/digestiva</label>
                                        <div class="col-lg-4">
                                            {!! Form::hidden('efec_intgas_bnz', 1) !!}
                                            <input type="checkbox" class="form-control" id="efec_intgas_bnz"
                                                   name="efec_intgas_bnz" @if($paciente->efec_intgas_bnz == 2) checked
                                                   @endif>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="efec_afhep_bnz" class="col-lg-8 text-left {{--control-label --}}">Presenta
                                            afectación hepática</label>
                                        <div class="col-lg-4">
                                            {!! Form::hidden('efec_afhep_bnz', 1) !!}
                                            <input type="checkbox" class="form-control" id="efec_afhep_bnz"
                                                   name="efec_afhep_bnz" @if($paciente->efec_afhep_bnz == 2) checked
                                                   @endif>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="efec_afneur_bnz" class="col-lg-8 text-left {{--control-label --}}">Presenta
                                            afectación neurológica</label>
                                        <div class="col-lg-4">
                                            {!! Form::hidden('efec_afneur_bnz', 1) !!}
                                            <input type="checkbox" class="form-control" id="efec_afneur_bnz"
                                                   name="efec_afneur_bnz" @if($paciente->efec_afneur_bnz == 2) checked
                                                   @endif>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="efec_afhem_bnz" class="col-lg-8 text-left {{--control-label --}}">Presenta
                                            afectación hematológica</label>
                                        <div class="col-lg-4">
                                            {!! Form::hidden('efec_afhem_bnz', 1) !!}
                                            <input type="checkbox" class="form-control" id="efec_afhem_bnz"
                                                   name="efec_afhem_bnz" @if($paciente->efec_afhem_bnz == 2) checked
                                                   @endif>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="susp_bnz" class="col-lg-8 text-left {{--control-label --}}">Suspención
                                            del tratamiento</label>
                                        <div class="col-lg-4">
                                            {!! Form::hidden('susp_bnz', 1) !!}
                                            <input type="checkbox" class="form-control" id="susp_bnz"
                                                   name="susp_bnz" @if($paciente->susp_bnz == 2) checked
                                                   @endif>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="efec_otros_bnz" class="col-lg-8 text-left {{--control-label --}}">Otros
                                            efectos adversos</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control" id="efec_otros_bnz"
                                                   name="efec_otros_bnz" value="{!! $paciente->efec_otros_bnz !!}">
                                        </div>
                                    </div>
                                </div>
                                {{--Fin Nuevo--}}
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">Tratamiento con Nifurtimox</div>
                                <div class="panel-body">
                                    <div class="row">
                                        <label for="trat_nifur" class="col-lg-8 text-left {{--control-label --}}">Tratamiento
                                            con Nifurtimox</label>
                                        <div class="col-lg-4">
                                            {!! Form::hidden('trat_nifur', 1) !!}
                                            <input type="checkbox" class="form-control" id="trat_nifur"
                                                   name="trat_nifur" @if($paciente->trat_nifur == 2) checked
                                                   @endif>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="fecha_ini_trat_nifur" class="col-lg-8 text-left {{--control-label --}}">Fecha
                                            Inicio Tratamiento</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control datepicker" id="fecha_ini_trat_nifur"
                                                   name="fecha_ini_trat_nifur"
                                                   value="@if($paciente->fecha_ini_trat_nifur){!! $paciente->fecha_ini_trat_nifur->format('d/m/Y') !!}@endif">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="efectos_adv_nifur" class="col-lg-8 text-left {{--control-label --}}">Efectos
                                            Adversos</label>
                                        <div class="col-lg-4">
                                            {!! Form::hidden('efectos_adv_nifur', 1) !!}
                                            <input type="checkbox" class="form-control" id="efectos_adv_nifur"
                                                   name="efectos_adv_nifur" @if($paciente->efectos_adv_nifur == 2) checked
                                                   @endif>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="efec_rash_nifur" class="col-lg-8 text-left {{--control-label --}}">Presenta
                                            rash cutáneo</label>
                                        <div class="col-lg-4">
                                            {!! Form::hidden('efec_rash_nifur', 1) !!}
                                            <input type="checkbox" class="form-control" id="efec_rash_nifur"
                                                   name="efec_rash_nifur" @if($paciente->efec_rash_nifur == 2) checked
                                                   @endif>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="efec_intgas_nifur" class="col-lg-8 text-left {{--control-label --}}">Presenta
                                            intolerancia gástrica/digestiva</label>
                                        <div class="col-lg-4">
                                            {!! Form::hidden('efec_intgas_nifur', 1) !!}
                                            <input type="checkbox" class="form-control" id="efec_intgas_nifur"
                                                   name="efec_intgas_nifur" @if($paciente->efec_intgas_nifur == 2) checked
                                                   @endif>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="efec_afhep_nifur" class="col-lg-8 text-left {{--control-label --}}">Presenta
                                            afectación hepática</label>
                                        <div class="col-lg-4">
                                            {!! Form::hidden('efec_afhep_nifur', 1) !!}
                                            <input type="checkbox" class="form-control" id="efec_afhep_nifur"
                                                   name="efec_afhep_nifur" @if($paciente->efec_afhep_nifur == 2) checked
                                                   @endif>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="efec_afneur_nifur" class="col-lg-8 text-left {{--control-label --}}">Presenta
                                            afectación neurológica</label>
                                        <div class="col-lg-4">
                                            {!! Form::hidden('efec_afneur_nifur', 1) !!}
                                            <input type="checkbox" class="form-control" id="efec_afneur_nifur"
                                                   name="efec_afneur_nifur" @if($paciente->efec_afneur_nifur == 2) checked
                                                   @endif>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="efec_afhem_nifur" class="col-lg-8 text-left {{--control-label --}}">Presenta
                                            afectación hematológica</label>
                                        <div class="col-lg-4">
                                            {!! Form::hidden('efec_afhem_nifur', 1) !!}
                                            <input type="checkbox" class="form-control" id="efec_afhem_nifur"
                                                   name="efec_afhem_nifur" @if($paciente->efec_afhem_nifur == 2) checked
                                                   @endif>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="susp_nifur" class="col-lg-8 text-left {{--control-label --}}">Suspención
                                            del tratamiento</label>
                                        <div class="col-lg-4">
                                            {!! Form::hidden('susp_nifur', 1) !!}
                                            <input type="checkbox" class="form-control" id="susp_nifur"
                                                   name="susp_nifur" @if($paciente->susp_nifur == 2) checked
                                                   @endif>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="efec_otros_nifur" class="col-lg-8 text-left {{--control-label --}}">Otros
                                            efectos adversos</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control" id="efec_otros_nifur"
                                                   name="efec_otros_nifur" value="{!! $paciente->efec_otros_nifur !!}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            {{--Observaciones Tratamiento Etiológico--}}
                            <div class="panel panel-default">
                                <div class="panel-heading">Otros efectos adversos</div>
                                <div class="panel-body">
                                    <div class="row">
                                <textarea class="form-control" name="trat_etio_obs" id="trat_etio_obs" cols="30"
                                          rows="15">{!! $paciente->trat_etio_obs !!}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">Patologías</div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="row">
                                                <label for="sin_patologia"
                                                       class="col-lg-8 text-left {{--control-label --}}">Paciente sin
                                                    patología asociada</label>
                                                <div class="col-lg-4">
                                                    {!! Form::hidden('sin_patologia', 1) !!}
                                                    <input type="checkbox" class="form-control" id="sin_patologia"
                                                           name="sin_patologia" @if($paciente->sin_patologia == 2) checked
                                                           @endif>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="tuberculosis" class="col-lg-8 text-left {{--control-label --}}">Tuberculosis</label>
                                                <div class="col-lg-4">
                                                    {!! Form::hidden('tuberculosis', 1) !!}
                                                    <input type="checkbox" class="form-control" id="tuberculosis"
                                                           name="tuberculosis" @if($paciente->tuberculosis == 2) checked
                                                           @endif>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="epoc"
                                                       class="col-lg-8 text-left {{--control-label --}}">E.P.O.C.</label>
                                                <div class="col-lg-4">
                                                    {!! Form::hidden('epoc', 1) !!}
                                                    <input type="checkbox" class="form-control" id="epoc"
                                                           name="epoc" @if($paciente->epoc == 2) checked
                                                           @endif>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="dbt"
                                                       class="col-lg-8 text-left {{--control-label --}}">Diabetes</label>
                                                <div class="col-lg-4">
                                                    {!! Form::hidden('dbt', 1) !!}
                                                    <input type="checkbox" class="form-control" id="dbt"
                                                           name="dbt" @if($paciente->dbt == 2) checked
                                                           @endif>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="asintomatico" class="col-lg-8 text-left {{--control-label --}}">Asintomático</label>
                                                <div class="col-lg-4">
                                                    {!! Form::hidden('asintomatico', 1) !!}
                                                    <input type="checkbox" class="form-control" id="asintomatico"
                                                           name="asintomatico" @if($paciente->asintomatico == 2) checked
                                                           @endif>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="palpitaciones"
                                                       class="col-lg-8 text-left {{--control-label --}}">Palpitaciones</label>
                                                <div class="col-lg-4">
                                                    {!! Form::hidden('palpitaciones', 1) !!}
                                                    <input type="checkbox" class="form-control" id="palpitaciones"
                                                           name="palpitaciones" @if($paciente->palpitaciones == 2) checked
                                                           @endif>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="angor"
                                                       class="col-lg-8 text-left {{--control-label --}}">Angor</label>
                                                <div class="col-lg-4">
                                                    {!! Form::hidden('angor', 1) !!}
                                                    <input type="checkbox" class="form-control" id="angor"
                                                           name="angor" @if($paciente->angor == 2) checked
                                                           @endif>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="row">
                                                <label for="colageno" class="col-lg-8 text-left {{--control-label --}}">Colagenopatías</label>
                                                <div class="col-lg-4">
                                                    {!! Form::hidden('colageno', 1) !!}
                                                    <input type="checkbox" class="form-control" id="colageno"
                                                           name="colageno" @if($paciente->colageno == 2) checked
                                                           @endif>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="obesidad" class="col-lg-8 text-left {{--control-label --}}">Obesidad
                                                    mórbida</label>
                                                <div class="col-lg-4">
                                                    {!! Form::hidden('obesidad', 1) !!}
                                                    <input type="checkbox" class="form-control" id="obesidad"
                                                           name="obesidad" @if($paciente->obesidad == 2) checked
                                                           @endif>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="alcoholismo" class="col-lg-8 text-left {{--control-label --}}">Alcoholismo</label>
                                                <div class="col-lg-4">
                                                    {!! Form::hidden('alcoholismo', 1) !!}
                                                    <input type="checkbox" class="form-control" id="alcoholismo"
                                                           name="alcoholismo" @if($paciente->alcoholismo == 2) checked
                                                           @endif>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="acv" class="col-lg-8 text-left {{--control-label --}}">Accidente
                                                    Cerebrovascular</label>
                                                <div class="col-lg-4">
                                                    {!! Form::hidden('acv', 1) !!}
                                                    <input type="checkbox" class="form-control" id="acv"
                                                           name="acv" @if($paciente->acv == 2) checked
                                                           @endif>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="disnea"
                                                       class="col-lg-8 text-left {{--control-label --}}">Disnea</label>
                                                <div class="col-lg-4">
                                                    {!! Form::hidden('disnea', 1) !!}
                                                    <input type="checkbox" class="form-control" id="disnea"
                                                           name="disnea" @if($paciente->disnea == 2) checked
                                                           @endif>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="disnea1" class="col-lg-8 text-left {{--control-label --}}">Disnea
                                                    Clase Funcional I</label>
                                                <div class="col-lg-4">
                                                    {!! Form::hidden('disnea1', 1) !!}
                                                    <input type="checkbox" class="form-control" id="disnea1"
                                                           name="disnea1" @if($paciente->disnea1 == 2) checked
                                                           @endif>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="disnea2" class="col-lg-8 text-left {{--control-label --}}">Disnea
                                                    Clase Funcional II</label>
                                                <div class="col-lg-4">
                                                    {!! Form::hidden('disnea2', 1) !!}
                                                    <input type="checkbox" class="form-control" id="disnea2"
                                                           name="disnea2" @if($paciente->disnea2 == 2) checked
                                                           @endif>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="row">
                                                <label for="disnea3" class="col-lg-8 text-left {{--control-label --}}">Disnea
                                                    Clase Funcional III</label>
                                                <div class="col-lg-4">
                                                    {!! Form::hidden('disnea3', 1) !!}
                                                    <input type="checkbox" class="form-control" id="disnea3"
                                                           name="disnea3" @if($paciente->disnea3 == 2) checked
                                                           @endif>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="disnea4" class="col-lg-8 text-left {{--control-label --}}">Disnea
                                                    Clase Funcional IV</label>
                                                <div class="col-lg-4">
                                                    {!! Form::hidden('disnea4', 1) !!}
                                                    <input type="checkbox" class="form-control" id="disnea4"
                                                           name="disnea4" @if($paciente->disnea4 == 2) checked
                                                           @endif>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="hipotiroidismo"
                                                       class="col-lg-8 text-left {{--control-label --}}">Hipotiroidismo</label>
                                                <div class="col-lg-4">
                                                    {!! Form::hidden('hipotiroidismo', 1) !!}
                                                    <input type="checkbox" class="form-control" id="hipotiroidismo"
                                                           name="hipotiroidismo" @if($paciente->hipotiroidismo == 2) checked
                                                           @endif>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="hipertiroidismo"
                                                       class="col-lg-8 text-left {{--control-label --}}">Hipertiroidismo</label>
                                                <div class="col-lg-4">
                                                    {!! Form::hidden('hipertiroidismo', 1) !!}
                                                    <input type="checkbox" class="form-control" id="hipertiroidismo"
                                                           name="hipertiroidismo"
                                                           @if($paciente->hipertiroidismo == 2) checked
                                                           @endif>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="cardio_congenitas"
                                                       class="col-lg-8 text-left {{--control-label --}}">Cardiopatías
                                                    congénitas</label>
                                                <div class="col-lg-4">
                                                    {!! Form::hidden('cardio_congenitas', 1) !!}
                                                    <input type="checkbox" class="form-control" id="cardio_congenitas"
                                                           name="cardio_congenitas"
                                                           @if($paciente->cardio_congenitas == 2) checked
                                                           @endif>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="valvulopatias"
                                                       class="col-lg-8 text-left {{--control-label --}}">Valvulopatias</label>
                                                <div class="col-lg-4">
                                                    {!! Form::hidden('valvulopatias', 1) !!}
                                                    <input type="checkbox" class="form-control" id="valvulopatias"
                                                           name="valvulopatias" @if($paciente->valvulopatias == 2) checked
                                                           @endif>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="mareos"
                                                       class="col-lg-8 text-left {{--control-label --}}">Mareos</label>
                                                <div class="col-lg-4">
                                                    {!! Form::hidden('mareos', 1) !!}
                                                    <input type="checkbox" class="form-control" id="mareos"
                                                           name="mareos" @if($paciente->mareos == 2) checked
                                                           @endif>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="row">
                                                <label for="cardio_isquemica"
                                                       class="col-lg-8 text-left {{--control-label --}}">Cardiopatía
                                                    isquémica</label>
                                                <div class="col-lg-4">
                                                    {!! Form::hidden('cardio_isquemica', 1) !!}
                                                    <input type="checkbox" class="form-control" id="cardio_isquemica"
                                                           name="cardio_isquemica"
                                                           @if($paciente->cardio_isquemica == 2) checked
                                                           @endif>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="ht_arterial_leve"
                                                       class="col-lg-8 text-left {{--control-label --}}">Hipertensión
                                                    arterial leve</label>
                                                <div class="col-lg-4">
                                                    {!! Form::hidden('ht_arterial_leve', 1) !!}
                                                    <input type="checkbox" class="form-control" id="ht_arterial_leve"
                                                           name="ht_arterial_leve"
                                                           @if($paciente->ht_arterial_leve == 2) checked
                                                           @endif>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="ht_arterial_mode"
                                                       class="col-lg-8 text-left {{--control-label --}}">Hipertensión
                                                    arterial moderada</label>
                                                <div class="col-lg-4">
                                                    {!! Form::hidden('ht_arterial_mode', 1) !!}
                                                    <input type="checkbox" class="form-control" id="ht_arterial_mode"
                                                           name="ht_arterial_mode"
                                                           @if($paciente->ht_arterial_mode == 2) checked
                                                           @endif>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="ht_arterial_severa"
                                                       class="col-lg-8 text-left {{--control-label --}}">Hipertensión
                                                    arterial severa</label>
                                                <div class="col-lg-4">
                                                    {!! Form::hidden('ht_arterial_severa', 1) !!}
                                                    <input type="checkbox" class="form-control" id="ht_arterial_severa"
                                                           name="ht_arterial_severa"
                                                           @if($paciente->ht_arterial_severa == 2) checked
                                                           @endif>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="perdida_conoc"
                                                       class="col-lg-8 text-left {{--control-label --}}">Pérdida de
                                                    conocimiento</label>
                                                <div class="col-lg-4">
                                                    {!! Form::hidden('perdida_conoc', 1) !!}
                                                    <input type="checkbox" class="form-control" id="perdida_conoc"
                                                           name="perdida_conoc" @if($paciente->perdida_conoc == 2) checked
                                                           @endif>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="insuf_cardiaca"
                                                       class="col-lg-8 text-left {{--control-label --}}">Insuficiencia
                                                    cardíaca</label>
                                                <div class="col-lg-4">
                                                    {!! Form::hidden('insuf_cardiaca', 1) !!}
                                                    <input type="checkbox" class="form-control" id="insuf_cardiaca"
                                                           name="insuf_cardiaca" @if($paciente->insuf_cardiaca == 2) checked
                                                           @endif>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="tipo_insuf_card"
                                                       class="col-lg-8 text-left {{--control-label --}}">Tipo de
                                                    insuficiencia cardíaca</label>
                                                <div class="col-lg-4">
                                                    <input type="text" class="form-control" id="tipo_insuf_card"
                                                           name="tipo_insuf_card" value="{!! $paciente->tipo_insuf_card !!}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-1">
                                            <label for="otras_pat_asoc"
                                                   class="col-lg-8 text-left {{--control-label --}}">Otras
                                                patologías</label>
                                        </div>
                                        <div class="col-lg-11">
                                        <textarea class="form-control" name="otras_pat_asoc" id="otras_pat_asoc"
                                                  cols="145" rows="2">{!! $paciente->otras_pat_asoc !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label for="otros_sintomas_ing"
                                                   class="col-lg-8 text-left {{--control-label --}}">Otros síntomas al
                                                ingreso</label>
                                        </div>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control" id="otros_sintomas_ing"
                                                   name="otros_sintomas_ing" value="{!! $paciente->otros_sintomas_ing !!}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">Nuevos Síntomas</div>
                                <div class="panel-body">
                                    <div class="row">
                                        <label for="nuevos_sintomas"
                                               class="col-lg-8 text-left {{--control-label --}}">¿Hubo nuevos
                                            síntomas?</label>
                                        <div class="col-lg-4">
                                            <select class="form-control" id="nuevos_sintomas" name="nuevos_sintomas">
                                                <option value=""> </option>
                                                <option value="S" @if($paciente->nuevos_sintomas=="S") selected @endif>Si</option>
                                                <option value="N" @if($paciente->nuevos_sintomas=="N") selected @endif>No</option>
                                            </select>
{{--                                            <input type="text" class="form-control" id="nuevos_sintomas"
                                                   name="nuevos_sintomas"
                                                   value="@if($paciente->nuevos_sintomas=="S") Si @elseif($paciente->nuevos_sintomas=="N") No @else {!! $paciente->nuevos_sintomas !!} @endif">--}}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label for="obs_sintomas"
                                                   class="col-lg-8 text-left {{--control-label --}}">Observaciones</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                        <textarea class="form-control" name="obs_sintomas" id="obs_sintomas" cols="30"
                                                  rows="6">{!! $paciente->obs_sintomas !!}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            {{--//Columna Serología--}}
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Serología</div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <label for="tres_negativas" class="col-lg-8 control-label">3 pruebas serológicas
                                                negativas</label>
                                            <div class="col-lg-4">
                                                {!! Form::hidden('tres_negativas', 1) !!}
                                                <input type="checkbox" class="form-control" id="tres_negativas"
                                                       name="tres_negativas" @if($paciente->tres_negativas == 2) checked
                                                        @endif>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="serologia_ing" class="col-lg-8 control-label">Serología al
                                                ingreso</label>
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control" id="serologia_ing"
                                                       name="serologia_ing" value="{!! $paciente->serologia_ing !!}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="titulos_sero_ing" class="col-lg-8 control-label">Titulos serológicos
                                                al ingreso</label>
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control" id="titulos_sero_ing"
                                                       name="titulos_sero_ing" value="{!! $paciente->titulos_sero_ing !!}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="trat_etio" class="col-lg-8 control-label">Tratamiento
                                                Etiológico</label>
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control" id="trat_etio" name="trat_etio"
                                                       value="@if($paciente->trat_etio=="S")Si@elseif($paciente->trat_etio=="N")No @endif">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">Radiografía</div>
                                <div class="panel-body">
                                    <div class="row">
                                        <label for="fecha_rx_torax" class="col-lg-8 text-left {{--control-label --}}">Fecha
                                            de Radiografía de Tórax</label>
                                        <div class="col-lg-4">
                                        <input type="text" class="form-control datepicker" id="fecha_rx_torax"
                                               name="fecha_rx_torax"
                                               value="@if($paciente->fecha_rx_torax){!! $paciente->fecha_rx_torax->format('d/m/Y') !!}@endif">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="rx_torax"
                                               class="col-lg-8 text-left {{--control-label --}}">Consignación</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control" id="rx_torax"
                                                   name="rx_torax"
                                                   value="{!! $paciente->rx_torax !!}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="indice_cardiotorax" class="col-lg-8 text-left {{--control-label --}}">Índice
                                            cardiotorácico</label>
                                        <div class="col-lg-4">
                                            <input type="number" class="form-control" id="indice_cardiotorax"
                                                   name="indice_cardiotorax"
                                                   value="{!! $paciente->indice_cardiotorax !!}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="obs_rxt"
                                               class="col-lg-3 text-left {{--control-label --}}">Observación</label>
                                        <div class="col-lg-8 col-lg-offset-1">
                                        <textarea class="form-control" name="obs_rxt" id="obs_rxt" cols="30"
                                                  rows="2">{!! $paciente->obs_rxt !!}</textarea>
                                        </div>
                                    </div>
                                    {{--Cambios--}}
                                    <div class="row">
                                        <label for="cambios_rxt" class="col-lg-8 text-left {{--control-label --}}">Cambios
                                            en la Rx</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control" id="cambios_rxt"
                                                   name="cambios_rxt"
                                                   value="{!! $paciente->cambios_rxt !!}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="fecha_cambios_rxt" class="col-lg-8 text-left {{--control-label --}}">Fecha
                                            del cambio</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control datepicker" id="fecha_cambios_rxt"
                                                   name="fecha_cambios_rxt"
                                                   value="@if($paciente->fecha_cambios_rxt){!! $paciente->fecha_cambios_rxt->format('d/m/Y') !!}@endif">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="nueva_rxt" class="col-lg-8 text-left {{--control-label --}}">Nueva
                                            Radiografía</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control" id="nueva_rxt"
                                                   name="nueva_rxt"
                                                   value="{!! $paciente->nueva_rxt !!}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">Evolución</div>
                        <div class="panel-body">
                            <div class="col-lg-12">
                            <textarea class="form-control" name="evolucion" id="evolucion" cols="145"
                                      rows="4" readonly>{!! $paciente->evolucion !!}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                    <input type="submit" class="hidden" name="submit-guardar" id="submit-guardar">
            </form>
        </div>
    </div>
@endsection