@extends('master')

@section('title')
    Historia Clínica - Nuevo paciente
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

    $(document).on('click', 'input:checkbox', function (e) {
        if ($(this).is(':checked')) {
            $(this).val("on");
        } else {
            $(this).val("1");
        }
    });

    $(document).on('change', "input[name='numero_doc']", function (e) {
        $("input[name='id_hc']").val($(this).val());
    });

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
                    <h2 class="text-left" style="border-radius: 0">Historia Clínica - Nuevo Paciente
                        {{--de {!! $paciente->apellido . ", " . $paciente->nombre . " (H.C.:" . $paciente->id_hc . ")"!!}--}}
                    </h2>
                </div>
                <div class="col-lg-4">
                    <div class="btn-group btn-group-justified btn-group-raised">
                        <a href="/panel" class="btn btn-raised btn-default" style="background-color: #EEEEEE">Cancelar</a>
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
                                    <input type="text" class="form-control" id="tipo_doc" name="tipo_doc" value="{!! old('tipo_doc') !!}">
                                </div>
                                {{--</div>--}}
                                {{--<div class="form-group">--}}
                                <label for="numero_doc" class="col-lg-2 text-left{{-- control-label --}}">Nro. Documento</label>
                                <div class="col-lg-2">
                                    <input type="text" class="form-control" id="numero_doc" name="numero_doc" value="{!! old('numero_doc') !!}">
                                    {!! Form::hidden('id_hc') !!}
                                </div>
                            </div>
                            <div class="panel-body">
                                <label for="apellido" class="col-lg-2 text-left{{-- control-label --}} ">Apellido/s</label>
                                <div class="col-lg-3">
                                    <input type="text" class="form-control" id="apellido" name="apellido" value="{!! old('apellido') !!}">
                                </div>
                                {{--</div>--}}
                                {{--<div class="form-group">--}}
                                <label for="nombre" class="col-lg-2 text-left{{-- control-label --}}">Nombre/s</label>
                                <div class="col-lg-3">
                                    <input type="text" class="form-control" id="nombre" name="nombre" value="{!! old('nombre') !!}">
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
                                                    <input type="text" class="form-control datepicker" id="fecha_nac" name="fecha_nac" value="{!! old('fecha_nac') !!}">
                                                </div>
                                                <label for="edad_ing" class="col-lg-3 control-label">Edad al ingreso</label>
                                                <div class="col-lg-3">
                                                    <input type="number" class="form-control" id="edad_ing" name="edad_ing" value="{!! old('edad_ing') !!}" readonly>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="fecha_alta" class="col-lg-3 control-label">Fecha Ing.</label>
                                                <div class="col-lg-3">
                                                    <input type="text" class="form-control" id="fecha_alta"
                                                           name="fecha_alta" value="@if(old('fecha_alta')){!! old('fecha_alta') !!}@else{!! \Carbon\Carbon::now()->format('d/m/Y') !!}@endif">
                                                </div>
                                                <label for="anios_seg" class="col-lg-3 control-label">Años
                                                    Seguimiento.</label>
                                                <div class="col-lg-3">
                                                    <input type="number" class="form-control" id="anios_seg"
                                                           name="anios_seg" readonly>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="fecha_ult_consulta" class="col-lg-3 control-label">Fecha Ult.
                                                    Consulta</label>
                                                <div class="col-lg-3">
                                                    <input type="text" class="form-control" id="fecha_ult_consulta"
                                                           name="fecha_ult_consulta" readonly>
                                                </div>
                                                <label for="proxima_cita" class="col-lg-3 control-label">Próxima
                                                    Cita</label>
                                                <div class="col-lg-3">
                                                    <input type="text" class="form-control datepicker" id="proxima_cita"
                                                           name="proxima_cita" value="{!! old('proxima_cita') !!}">
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
                                                <option value="" {{ old('ecg') == "" ? "selected": ""}}></option>
                                                <option value="N" {{ old('ecg') == "N" ? "selected": "" }}>Normal</option>
                                                <option value="E" {{ old('ecg') == "E" ? "selected": "" }}>Específico</option>
                                                <option value="I" {{ old('ecg') == "I" ? "selected": "" }}>Inespecífico</option>
                                                <option value="?" {{ old('ecg') == "?" ? "selected": "" }}>?</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="tipo_ecg"
                                               class="col-lg-8 text-left {{--control-label --}}">Descripción</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control" id="tipo_ecg" name="tipo_ecg" value="{!! old('tipo_ecg') !!}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="nuevos_cambios_ecg" class="col-lg-8 text-left {{--control-label --}}">Nuevos
                                            cambios</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control" id="nuevos_cambios_ecg"
                                                   name="nuevos_cambios_ecg" value="{!! old('nuevos_cambios_ecg') !!}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="fecha_cambios_ecg" class="col-lg-8 text-left {{--control-label --}}">Fecha
                                            del cambio</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control datepicker" id="fecha_cambios_ecg"
                                                   name="fecha_cambios_ecg" value="{!! old('fecha_cambios_ecg') !!}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="tipo_cambio_ecg" class="col-lg-8 text-left {{--control-label --}}">Tipo
                                            de cambio</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control" id="tipo_cambio_ecg"
                                                   name="tipo_cambio_ecg" value="{!! old('tipo_cambio_ecg') !!}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="obs_ecg"
                                               class="col-lg-3 text-left {{--control-label --}}">Observación</label>
                                        <div class="col-lg-9">
                                        <textarea class="form-control" name="obs_ecg" id="obs_ecg" cols="30"
                                                  rows="2">{!! old('obs_ecg') !!}</textarea>
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
                                                       name="grupo_clinico_ing" value="{!! old('grupo_clinico_ing') !!}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="cambio_grupo_cli" class="col-lg-8 control-label">Cambio en el Grupo
                                                Clínico</label>
                                            <div class="col-lg-4">
                                                <select class="form-control" id="cambio_grupo_cli" name="cambio_grupo_cli">
                                                    <option value="" {{old('cambio_grupo_cli') == "" ? "selected" : ""}}> </option>
                                                    <option value="S" {{old('cambio_grupo_cli') == "S" ? "selected" : ""}}>Si</option>
                                                    <option value="N" {{old('cambio_grupo_cli') == "N" ? "selected" : ""}}>No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="fecha_cambio_gcli" class="col-lg-8 control-label">Fecha Cambio Grupo
                                                Clínico</label>
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control datepicker" id="fecha_cambio_gcli"
                                                       name="fecha_cambio_gcli" value="{!! old('fecha_cambio_gcli') !!}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="nuevo_grupo_cli" class="col-lg-8 control-label">Nuevo Grupo
                                                Clínico</label>
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control" id="nuevo_grupo_cli"
                                                       name="nuevo_grupo_cli" value="{!! old('nuevo_grupo_cli') !!}">
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
                                            <option value="S" selected>Si</option>
                                            <option value="N">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="causa_muerte" class="col-lg-12 control-label">¿Causa muerte?</label>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control" id="causa_muerte" name="causa_muerte" value="{!! old('causa_muerte') !!}">
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
                                            {{--{!! Form::hidden('trat_bnz', 1) !!}--}}
                                            {{--<input type="checkbox" class="form-control" id="trat_bnz" name="trat_bnz">--}}
                                            {!! Form::checkbox('trat_bnz', old('trat_bnz'), old('trat_bnz') == 'on' ?  true : false, ['class'=>'form-control', 'id'=>'trat_bnz']) !!}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="fecha_ini_trat_bnz" class="col-lg-8 text-left {{--control-label --}}">Fecha
                                            Inicio Tratamiento</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control datepicker" id="fecha_ini_trat_bnz"
                                                   name="fecha_ini_trat_bnz" value="{!! old('fecha_ini_trat_bnz') !!}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="efectos_adv_bnz" class="col-lg-8 text-left {{--control-label --}}">Efectos
                                            Adversos</label>
                                        <div class="col-lg-4">
                                            {{--{!! Form::hidden('efectos_adv_bnz', 1) !!}--}}
                                            {{--<input type="checkbox" class="form-control" id="efectos_adv_bnz" name="efectos_adv_bnz">--}}
                                            {!! Form::checkbox('efectos_adv_bnz', old('efectos_adv_bnz'), old('efectos_adv_bnz') == 'on' ?  true : false, ['class'=>'form-control', 'id'=>'efectos_adv_bnz']) !!}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="efec_rash_bnz" class="col-lg-8 text-left {{--control-label --}}">Presenta
                                            rash cutáneo</label>
                                        <div class="col-lg-4">
                                            {{--{!! Form::hidden('efec_rash_bnz', 1) !!}--}}
                                            {{--<input type="checkbox" class="form-control" id="efec_rash_bnz" name="efec_rash_bnz">--}}
                                            {!! Form::checkbox('efec_rash_bnz', old('efec_rash_bnz'), old('efec_rash_bnz') == 'on' ?  true : false, ['class'=>'form-control', 'id'=>'efec_rash_bnz']) !!}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="efec_intgas_bnz" class="col-lg-8 text-left {{--control-label --}}">Presenta
                                            intolerancia gástrica/digestiva</label>
                                        <div class="col-lg-4">
                                            {{--{!! Form::hidden('efec_intgas_bnz', 1) !!}--}}
                                            {{--<input type="checkbox" class="form-control" id="efec_intgas_bnz" name="efec_intgas_bnz">--}}
                                            {!! Form::checkbox('efec_intgas_bnz', old('efec_intgas_bnz'), old('efec_intgas_bnz') == 'on' ?  true : false, ['class'=>'form-control', 'id'=>'efec_intgas_bnz']) !!}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="efec_afhep_bnz" class="col-lg-8 text-left {{--control-label --}}">Presenta
                                            afectación hepática</label>
                                        <div class="col-lg-4">
                                            {{--{!! Form::hidden('efec_afhep_bnz', 1) !!}--}}
                                            {{--<input type="checkbox" class="form-control" id="efec_afhep_bnz" name="efec_afhep_bnz">--}}
                                            {!! Form::checkbox('efec_afhep_bnz', old('efec_afhep_bnz'), old('efec_afhep_bnz') == 'on' ?  true : false, ['class'=>'form-control', 'id'=>'efec_afhep_bnz']) !!}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="efec_afneur_bnz" class="col-lg-8 text-left {{--control-label --}}">Presenta
                                            afectación neurológica</label>
                                        <div class="col-lg-4">
                                            {{--{!! Form::hidden('efec_afneur_bnz', 1) !!}--}}
                     {{--                       <input type="checkbox" class="form-control" id="efec_afneur_bnz"
                                                   name="efec_afneur_bnz" value="{!! old('efec_afneur_bnz') !!}">--}}
                                            {!! Form::checkbox('efec_afneur_bnz', old('efec_afneur_bnz'), old('efec_afneur_bnz') == 'on' ?  true : false, ['class'=>'form-control', 'id'=>'efec_afneur_bnz']) !!}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="efec_afhem_bnz" class="col-lg-8 text-left {{--control-label --}}">Presenta
                                            afectación hematológica</label>
                                        <div class="col-lg-4">
                                            {{--{!! Form::hidden('efec_afhem_bnz', 1) !!}--}}
                                            {{--<input type="checkbox" class="form-control" id="efec_afhem_bnz" name="efec_afhem_bnz">--}}
                                            {!! Form::checkbox('efec_afhem_bnz', old('efec_afhem_bnz'), old('efec_afhem_bnz') == 'on' ?  true : false, ['class'=>'form-control', 'id'=>'efec_afhem_bnz']) !!}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="susp_bnz" class="col-lg-8 text-left {{--control-label --}}">Suspención
                                            del tratamiento</label>
                                        <div class="col-lg-4">
                                            {{--{!! Form::hidden('susp_bnz', 1) !!}--}}
                                            {{--<input type="checkbox" class="form-control" id="susp_bnz" name="susp_bnz">--}}
                                            {!! Form::checkbox('susp_bnz', old('susp_bnz'), old('susp_bnz') == 'on' ?  true : false, ['class'=>'form-control', 'id'=>'susp_bnz']) !!}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="efec_otros_bnz" class="col-lg-8 text-left {{--control-label --}}">Otros
                                            efectos adversos</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control" id="efec_otros_bnz"
                                                   name="efec_otros_bnz" value="{!! old('efec_otros_bnz') !!}">
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
                                            {{--{!! Form::hidden('trat_nifur', 1) !!}--}}
                                            {{--<input type="checkbox" class="form-control" id="trat_nifur" name="trat_nifur">--}}
                                            {!! Form::checkbox('trat_nifur', old('trat_nifur'), old('trat_nifur') == 'on' ?  true : false, ['class'=>'form-control', 'id'=>'trat_nifur']) !!}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="fecha_ini_trat_nifur" class="col-lg-8 text-left {{--control-label --}}">Fecha
                                            Inicio Tratamiento</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control datepicker" id="fecha_ini_trat_nifur"
                                                   name="fecha_ini_trat_nifur" value="{!! old('fecha_ini_trat_nifur') !!}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="efectos_adv_nifur" class="col-lg-8 text-left {{--control-label --}}">Efectos
                                            Adversos</label>
                                        <div class="col-lg-4">
                                            {{--{!! Form::hidden('efectos_adv_nifur', 1) !!}--}}
                                            {{--<input type="checkbox" class="form-control" id="efectos_adv_nifur" name="efectos_adv_nifur">--}}
                                            {!! Form::checkbox('efectos_adv_nifur', old('efectos_adv_nifur'), old('efectos_adv_nifur') == 'on' ?  true : false, ['class'=>'form-control', 'id'=>'efectos_adv_nifur']) !!}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="efec_rash_nifur" class="col-lg-8 text-left {{--control-label --}}">Presenta
                                            rash cutáneo</label>
                                        <div class="col-lg-4">
                                            {{--{!! Form::hidden('efec_rash_nifur', 1) !!}--}}
                                            {{--<input type="checkbox" class="form-control" id="efec_rash_nifur" name="efec_rash_nifur">--}}
                                            {!! Form::checkbox('efec_rash_nifur', old('efec_rash_nifur'), old('efec_rash_nifur') == 'on' ?  true : false, ['class'=>'form-control', 'id'=>'efec_rash_nifur']) !!}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="efec_intgas_nifur" class="col-lg-8 text-left {{--control-label --}}">Presenta
                                            intolerancia gástrica/digestiva</label>
                                        <div class="col-lg-4">
                                            {{--{!! Form::hidden('efec_intgas_nifur', 1) !!}--}}
                                            {{--<input type="checkbox" class="form-control" id="efec_intgas_nifur" name="efec_intgas_nifur">--}}
                                            {!! Form::checkbox('efec_intgas_nifur', old('efec_intgas_nifur'), old('efec_intgas_nifur') == 'on' ?  true : false, ['class'=>'form-control', 'id'=>'efec_intgas_nifur']) !!}
                                        </div>
                                    </div>
             
@endsection