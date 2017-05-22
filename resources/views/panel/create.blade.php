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
        $(".datepicker").datepicker({ changeYear: true,yearRange: "-100:+0",changeMonth: true });
    });
</script>
@endsection

@section('content')


<h3 class="page-title">Historia Clínica - Nuevo Paciente  </h3>
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
            <a href="#">Crear</a>
          </li>
    </ul>
</div>

 <div class="portlet box grey-cascade"  >
        <div class="portlet-title">

             <div class="actions btn-set">
                <a href="{{ action('Panel\PanelHistoriasController@index') }}" type="button" name="back" class="btn default"><i class="fa fa-angle-left"></i> Atras</a>
            </div>

        </div>
        <div class="portlet-body">
            
            <div class="row">
                 
                <div class="col-lg-4">
                    <div class="btn-group btn-group-justified btn-group-raised">
                        <a href="/panel" class="btn btn-raised btn-default" style="background-color: #EEEEEE">Cancelar</a>
                        {{--<a href="javascript:void(0)" class="btn btn-raised btn-success">Guardar Historia</a>--}}
                        <label for="submit-guardar" class="btn btn-raised btn-success">Guardar Historia</label>
                    </div>
                </div>
            </div>
            <hr/>
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
                        <div class="col-xs-12">
                            <div class="portlet box blue">
                                <div class="portlet-title"><div class="caption">Información General</div></div>
                                <div class="portlet-body">
                                    <div class="row">
                                        <label for="tipo_doc" class="col-xs-2 text-left{{-- control-label --}} ">Tipo Documento</label>
                                        <div class="col-xs-3">
 
                                            <select class="form-control" id="tipo_doc" name="tipo_doc">
                                                <option value="DNI">Documento Único</option>
                                                <option value="LE">Libreta de Enrolamiento</option>
                                                <option value="LC">Libreta Cívica</option>
                                                <option value="OTRO">Otro</option>
                                            </select>
                                        </div>
                                         
                                        <label for="numero_doc" class="col-lg-2 text-left{{-- control-label --}}">Nro. Documento</label>
                                        <div class="col-lg-2">
                                            <input type="text" class="form-control" id="numero_doc" name="numero_doc" value="{!! old('numero_doc') !!}">
                                            {!! Form::hidden('id_hc') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="row">
                                        <label for="apellido" class="col-lg-2 text-left{{-- control-label --}} ">Apellido/s</label>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control" id="apellido" name="apellido" value="{!! old('apellido') !!}">
                                        </div>
                                      
                                        <label for="nombre" class="col-lg-2 text-left{{-- control-label --}}">Nombre/s</label>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control" id="nombre" name="nombre" value="{!! old('nombre') !!}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                             
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="portlet box blue">
                                        <div class="portlet-title"><div class="caption">Seguimiento</div></div>
                                        <div class="portlet-body">
                                            <div class="form-group">
                                                <label for="fecha_nac" class="col-lg-3 control-label">Fecha Nac.</label>
                                                <div class="col-lg-3">
                                                    <input type="text" class="form-control datepicker" id="fecha_nac" name="fecha_nac" value="{!! old('fecha_nac') !!}">
                                                </div>
                                                <label for="edad_ing" class="col-lg-3 control-label">Edad al ingreso</label>
                                                <div class="col-lg-3">
                                                    <input type="number" class="form-control" id="edad_ing" name="edad_ing" value="{!! old('edad_ing') !!}" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group">
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
                                            <div class="form-group">
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
                        <div class="col-lg-6">
                            <div class="portlet box blue">
                                <div class="portlet-title"><div class="caption">ECG</div></div>
                                <div class="portlet-body">
                                    <div class="form-group">
                                        <label for="ecg"
                                               class="col-lg-4 text-left {{--control-label --}}">Consignación</label>
                                        <div class="col-lg-8">
                                            <select class="form-control" id="ecg" name="ecg">
                                                <option value="" {{ old('ecg') == "" ? "selected": ""}}></option>
                                                <option value="N" {{ old('ecg') == "N" ? "selected": "" }}>Normal</option>
                                                <option value="E" {{ old('ecg') == "E" ? "selected": "" }}>Específico</option>
                                                <option value="I" {{ old('ecg') == "I" ? "selected": "" }}>Inespecífico</option>
                                                <option value="?" {{ old('ecg') == "?" ? "selected": "" }}>?</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="tipo_ecg"
                                               class="col-lg-4 text-left {{--control-label --}}">Descripción</label>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="tipo_ecg" name="tipo_ecg" value="{!! old('tipo_ecg') !!}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nuevos_cambios_ecg" class="col-lg-4 text-left {{--control-label --}}">Nuevos
                                            cambios</label>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="nuevos_cambios_ecg"
                                                   name="nuevos_cambios_ecg" value="{!! old('nuevos_cambios_ecg') !!}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fecha_cambios_ecg" class="col-lg-4 text-left {{--control-label --}}">Fecha
                                            del cambio</label>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control datepicker" id="fecha_cambios_ecg"
                                                   name="fecha_cambios_ecg" value="{!! old('fecha_cambios_ecg') !!}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="tipo_cambio_ecg" class="col-lg-4 text-left {{--control-label --}}">Tipo
                                            de cambio</label>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="tipo_cambio_ecg"
                                                   name="tipo_cambio_ecg" value="{!! old('tipo_cambio_ecg') !!}">
                                        </div>
                                    </div>
                                    <div class="form-group">
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
                        
                        <div class="col-lg-12">

                        <div class="col-lg-6">
                            {{--//Columna Grupo Clínico--}}
                            <div class="col-lg-12">
                                <div class="portlet box blue">
                                    <div class="portlet-title"><div class="caption">Grupo Clínico</div></div>
                                    <div class="portlet-body">
                                        <div class="form-group">
                                            <label for="grupo_clinico_ing" class="col-lg-4 control-label">Grupo Clínico al
                                                Ingreso</label>
                                            <div class="col-lg-8">
          
                                                <select class="form-control" id="grupo_clinico_ing"
                                               name="grupo_clinico_ing">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>                   
                                                    <option value="5">5</option>
                                               </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="cambio_grupo_cli" class="col-lg-4  control-label">Cambio en el Grupo
                                                Clínico</label>
                                            <div class="col-lg-8">
                                                <select class="form-control" id="cambio_grupo_cli" name="cambio_grupo_cli">
                                                    <option value="" {{old('cambio_grupo_cli') == "" ? "selected" : ""}}> </option>
                                                    <option value="S" {{old('cambio_grupo_cli') == "S" ? "selected" : ""}}>Si</option>
                                                    <option value="N" {{old('cambio_grupo_cli') == "N" ? "selected" : ""}}>No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="fecha_cambio_gcli" class="col-lg-4  control-label">Fecha Cambio Grupo
                                                Clínico</label>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control datepicker" id="fecha_cambio_gcli"
                                                       name="fecha_cambio_gcli" value="{!! old('fecha_cambio_gcli') !!}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="nuevo_grupo_cli" class="col-lg-4 control-label">Nuevo Grupo
                                                Clínico</label>
                                            <div class="col-lg-8">
                                                <select class="form-control" id="nuevo_grupo_cli"
                                               name="nuevo_grupo_cli">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>                   
                                                    <option value="5">5</option>
                                               </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            {{--//Columna Estado Paciente--}}
                            <div class="col-lg-6">
                                <div class="portlet box blue">
                                    <div class="portlet-title"><div class="caption">Estado del paciente</div></div>
                                    <div class="portlet-body">

                                        <div class="row">
                                            <label for="vivo" class="col-lg-1 control-label">¿Vivo?</label>
                                            <div class="col-lg-2">
                                                <select class="form-control" id="vivo" name="vivo">
                                                    <option value=""> </option>
                                                    <option value="S" selected>Si</option>
                                                    <option value="N">No</option>
                                                </select>
                                            </div>
                                         
                                            <label for="causa_muerte" class="col-lg-2 control-label">¿Causa muerte?</label>
                                            <div class="col-lg-7">
                                            <textarea class="form-control" id="causa_muerte" name="causa_muerte">{!! old('causa_muerte') !!}</textarea>
                                              
                                            </div>
                                        </div>
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
                            <div class="portlet box blue">
                                <div class="portlet-title"><div class="caption">Tratamiento con BNZ</div></div>
                                <div class="portlet-body">
                                    <div class="form-group">
                                        <label for="trat_bnz" class="col-lg-8 text-left {{--control-label --}}">Tratamiento
                                            con Benznidazol</label>
                                        <div class="col-lg-4">
                                            {{--{!! Form::hidden('trat_bnz', 1) !!}--}}
                                            {{--<input type="checkbox" class="form-control" id="trat_bnz" name="trat_bnz">--}}
                                            {!! Form::checkbox('trat_bnz', old('trat_bnz'), old('trat_bnz') == 'on' ?  true : false, ['class'=>'', 'id'=>'trat_bnz']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fecha_ini_trat_bnz" class="col-lg-8 text-left {{--control-label --}}">Fecha
                                            Inicio Tratamiento</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control datepicker" id="fecha_ini_trat_bnz"
                                                   name="fecha_ini_trat_bnz" value="{!! old('fecha_ini_trat_bnz') !!}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="efectos_adv_bnz" class="col-lg-8 text-left {{--control-label --}}">Efectos
                                            Adversos</label>
                                        <div class="col-lg-4">
                                            {{--{!! Form::hidden('efectos_adv_bnz', 1) !!}--}}
                                            {{--<input type="checkbox" class="form-control" id="efectos_adv_bnz" name="efectos_adv_bnz">--}}
                                            {!! Form::checkbox('efectos_adv_bnz', old('efectos_adv_bnz'), old('efectos_adv_bnz') == 'on' ?  true : false, ['class'=>'', 'id'=>'efectos_adv_bnz']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="efec_rash_bnz" class="col-lg-8 text-left {{--control-label --}}">Presenta
                                            rash cutáneo</label>
                                        <div class="col-lg-4">
                                            {{--{!! Form::hidden('efec_rash_bnz', 1) !!}--}}
                                            {{--<input type="checkbox" class="form-control" id="efec_rash_bnz" name="efec_rash_bnz">--}}
                                            {!! Form::checkbox('efec_rash_bnz', old('efec_rash_bnz'), old('efec_rash_bnz') == 'on' ?  true : false, ['class'=>'', 'id'=>'efec_rash_bnz']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="efec_intgas_bnz" class="col-lg-8 text-left {{--control-label --}}">Presenta
                                            intolerancia gástrica/digestiva</label>
                                        <div class="col-lg-4">
                                            {{--{!! Form::hidden('efec_intgas_bnz', 1) !!}--}}
                                            {{--<input type="checkbox" class="form-control" id="efec_intgas_bnz" name="efec_intgas_bnz">--}}
                                            {!! Form::checkbox('efec_intgas_bnz', old('efec_intgas_bnz'), old('efec_intgas_bnz') == 'on' ?  true : false, ['class'=>'', 'id'=>'efec_intgas_bnz']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="efec_afhep_bnz" class="col-lg-8 text-left {{--control-label --}}">Presenta
                                            afectación hepática</label>
                                        <div class="col-lg-4">
                                            {{--{!! Form::hidden('efec_afhep_bnz', 1) !!}--}}
                                            {{--<input type="checkbox" class="form-control" id="efec_afhep_bnz" name="efec_afhep_bnz">--}}
                                            {!! Form::checkbox('efec_afhep_bnz', old('efec_afhep_bnz'), old('efec_afhep_bnz') == 'on' ?  true : false, ['class'=>'', 'id'=>'efec_afhep_bnz']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="efec_afneur_bnz" class="col-lg-8 text-left {{--control-label --}}">Presenta
                                            afectación neurológica</label>
                                        <div class="col-lg-4">
                                            {{--{!! Form::hidden('efec_afneur_bnz', 1) !!}--}}
                     {{--                       <input type="checkbox" class="form-control" id="efec_afneur_bnz"
                                                   name="efec_afneur_bnz" value="{!! old('efec_afneur_bnz') !!}">--}}
                                            {!! Form::checkbox('efec_afneur_bnz', old('efec_afneur_bnz'), old('efec_afneur_bnz') == 'on' ?  true : false, ['class'=>'', 'id'=>'efec_afneur_bnz']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="efec_afhem_bnz" class="col-lg-8 text-left {{--control-label --}}">Presenta
                                            afectación hematológica</label>
                                        <div class="col-lg-4">
                                            {{--{!! Form::hidden('efec_afhem_bnz', 1) !!}--}}
                                            {{--<input type="checkbox" class="form-control" id="efec_afhem_bnz" name="efec_afhem_bnz">--}}
                                            {!! Form::checkbox('efec_afhem_bnz', old('efec_afhem_bnz'), old('efec_afhem_bnz') == 'on' ?  true : false, ['class'=>'', 'id'=>'efec_afhem_bnz']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="susp_bnz" class="col-lg-8 text-left {{--control-label --}}">Suspención
                                            del tratamiento</label>
                                        <div class="col-lg-4">
                                            {{--{!! Form::hidden('susp_bnz', 1) !!}--}}
                                            {{--<input type="checkbox" class="form-control" id="susp_bnz" name="susp_bnz">--}}
                                            {!! Form::checkbox('susp_bnz', old('susp_bnz'), old('susp_bnz') == 'on' ?  true : false, ['class'=>'', 'id'=>'susp_bnz']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="efec_otros_bnz" class="col-lg-5 text-left {{--control-label --}}">Otros
                                            efectos adversos</label>
                                        <div class="col-lg-6">
                                            <textarea  class="form-control" id="efec_otros_bnz"
                                                   name="efec_otros_bnz">{!! old('efec_otros_bnz') !!}</textarea>
                                            
 
                                        </div>
                                    </div>
                                </div>
                                {{--Fin Nuevo--}}
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="portlet box blue">
                                <div class="portlet-title"><div class="caption">Tratamiento con Nifurtimox</div></div>
                                <div class="portlet-body">
                                    <div class="form-group">
                                        <label for="trat_nifur" class="col-lg-8 text-left {{--control-label --}}">Tratamiento
                                            con Nifurtimox</label>
                                        <div class="col-lg-4">
                                            {{--{!! Form::hidden('trat_nifur', 1) !!}--}}
                                            {{--<input type="checkbox" class="form-control" id="trat_nifur" name="trat_nifur">--}}
                                            {!! Form::checkbox('trat_nifur', old('trat_nifur'), old('trat_nifur') == 'on' ?  true : false, ['class'=>'', 'id'=>'trat_nifur']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fecha_ini_trat_nifur" class="col-lg-8 text-left {{--control-label --}}">Fecha
                                            Inicio Tratamiento</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control datepicker" id="fecha_ini_trat_nifur"
                                                   name="fecha_ini_trat_nifur" value="{!! old('fecha_ini_trat_nifur') !!}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="efectos_adv_nifur" class="col-lg-8 text-left {{--control-label --}}">Efectos
                                            Adversos</label>
                                        <div class="col-lg-4">
                                            {{--{!! Form::hidden('efectos_adv_nifur', 1) !!}--}}
                                            {{--<input type="checkbox" class="form-control" id="efectos_adv_nifur" name="efectos_adv_nifur">--}}
                                            {!! Form::checkbox('efectos_adv_nifur', old('efectos_adv_nifur'), old('efectos_adv_nifur') == 'on' ?  true : false, ['class'=>'', 'id'=>'efectos_adv_nifur']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="efec_rash_nifur" class="col-lg-8 text-left {{--control-label --}}">Presenta
                                            rash cutáneo</label>
                                        <div class="col-lg-4">
                                            {{--{!! Form::hidden('efec_rash_nifur', 1) !!}--}}
                                            {{--<input type="checkbox" class="form-control" id="efec_rash_nifur" name="efec_rash_nifur">--}}
                                            {!! Form::checkbox('efec_rash_nifur', old('efec_rash_nifur'), old('efec_rash_nifur') == 'on' ?  true : false, ['class'=>'', 'id'=>'efec_rash_nifur']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="efec_intgas_nifur" class="col-lg-8 text-left {{--control-label --}}">Presenta
                                            intolerancia gástrica/digestiva</label>
                                        <div class="col-lg-4">
                                            {{--{!! Form::hidden('efec_intgas_nifur', 1) !!}--}}
                                            {{--<input type="checkbox" class="form-control" id="efec_intgas_nifur" name="efec_intgas_nifur">--}}
                                            {!! Form::checkbox('efec_intgas_nifur', old('efec_intgas_nifur'), old('efec_intgas_nifur') == 'on' ?  true : false, ['class'=>'', 'id'=>'efec_intgas_nifur']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="efec_afhep_nifur" class="col-lg-8 text-left {{--control-label --}}">Presenta
                                            afectación hepática</label>
                                        <div class="col-lg-4">
                                            {{--{!! Form::hidden('efec_afhep_nifur', 1) !!}--}}
                                            {{--<input type="checkbox" class="form-control" id="efec_afhep_nifur" name="efec_afhep_nifur">--}}
                                            {!! Form::checkbox('efec_afhep_nifur', old('efec_afhep_nifur'), old('efec_afhep_nifur') == 'on' ?  true : false, ['class'=>'', 'id'=>'efec_afhep_nifur']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="efec_afneur_nifur" class="col-lg-8 text-left {{--control-label --}}">Presenta
                                            afectación neurológica</label>
                                        <div class="col-lg-4">
                                            {{--{!! Form::hidden('efec_afneur_nifur', 1) !!}--}}
                                            {{--<input type="checkbox" class="form-control" id="efec_afneur_nifur" name="efec_afneur_nifur">--}}
                                            {!! Form::checkbox('efec_afneur_nifur', old('efec_afneur_nifur'), old('efec_afneur_nifur') == 'on' ?  true : false, ['class'=>'', 'id'=>'efec_afneur_nifur']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="efec_afhem_nifur" class="col-lg-8 text-left {{--control-label --}}">Presenta
                                            afectación hematológica</label>
                                        <div class="col-lg-4">
                                            {{--{!! Form::hidden('efec_afhem_nifur', 1) !!}--}}
                                            {{--<input type="checkbox" class="form-control" id="efec_afhem_nifur" name="efec_afhem_nifur">--}}
                                            {!! Form::checkbox('efec_afhem_nifur', old('efec_afhem_nifur'), old('efec_afhem_nifur') == 'on' ?  true : false, ['class'=>'', 'id'=>'efec_afhem_nifur']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="susp_nifur" class="col-lg-8 text-left {{--control-label --}}">Suspención
                                            del tratamiento</label>
                                        <div class="col-lg-4">
                                            {{--{!! Form::hidden('susp_nifur', 1) !!}--}}
                                            {{--<input type="checkbox" class="form-control" id="susp_nifur" name="susp_nifur">--}}
                                            {!! Form::checkbox('susp_nifur', old('susp_nifur'), old('susp_nifur') == 'on' ?  true : false, ['class'=>'', 'id'=>'susp_nifur']) !!}

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="efec_otros_nifur" class="col-lg-5 text-left {{--control-label --}}">Otros
                                            efectos adversos</label>
                                        <div class="col-lg-6">
                                            <textarea  class="form-control" id="efec_otros_nifur"
                                                   name="efec_otros_nifur">{!! old('efec_otros_nifur') !!}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            {{--Observaciones Tratamiento Etiológico--}}
                            <div class="portlet box blue">
                                <div class="portlet-title"><div class="caption">Otros efectos adversos</div></div>
                                <div class="portlet-body">
                                    <div class="row">
                                        <div class="col-xs-12">
                                                 <textarea class="form-control" name="trat_etio_obs" id="trat_etio_obs" cols="30"
                                                  rows="15">{!! old('trat_etio_obs') !!}</textarea>
                                         </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="portlet box blue">
                                <div class="portlet-title"><div class="caption">Patologías</div></div>
                                <div class="portlet-body">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="sin_patologia"
                                                       class="col-lg-8 text-left {{--control-label --}}">Paciente sin
                                                    patología asociada</label>
                                                <div class="col-lg-4">
                                                    {{--{!! Form::hidden('sin_patologia', 1) !!}--}}
                                                    {{--<input type="checkbox" class="form-control" id="sin_patologia" name="sin_patologia">--}}
                                                    {!! Form::checkbox('sin_patologia', old('sin_patologia'), old('sin_patologia') == 'on' ?  true : false, ['class'=>'', 'id'=>'sin_patologia']) !!}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="tuberculosis" class="col-lg-8 text-left {{--control-label --}}">Tuberculosis</label>
                                                <div class="col-lg-4">
                                                    {{--{!! Form::hidden('tuberculosis', 1) !!}--}}
                                                    {{--<input type="checkbox" class="form-control" id="tuberculosis" name="tuberculosis">--}}
                                                    {!! Form::checkbox('tuberculosis', old('tuberculosis'), old('tuberculosis') == 'on' ?  true : false, ['class'=>'', 'id'=>'tuberculosis']) !!}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="epoc"
                                                       class="col-lg-8 text-left {{--control-label --}}">E.P.O.C.</label>
                                                <div class="col-lg-4">
                                                    {{--{!! Form::hidden('epoc', 1) !!}--}}
                                                    {{--<input type="checkbox" class="form-control" id="epoc" name="epoc">--}}
                                                    {!! Form::checkbox('epoc', old('epoc'), old('epoc') == 'on' ?  true : false, ['class'=>'', 'id'=>'epoc']) !!}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="dbt"
                                                       class="col-lg-8 text-left {{--control-label --}}">Diabetes</label>
                                                <div class="col-lg-4">
                                                    {{--{!! Form::hidden('dbt', 1) !!}--}}
                                                    {{--<input type="checkbox" class="form-control" id="dbt" name="dbt">--}}
                                                    {!! Form::checkbox('dbt', old('dbt'), old('dbt') == 'on' ?  true : false, ['class'=>'', 'id'=>'dbt']) !!}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="asintomatico" class="col-lg-8 text-left {{--control-label --}}">Asintomático</label>
                                                <div class="col-lg-4">
                                                    {{--{!! Form::hidden('asintomatico', 1) !!}--}}
                                                    {{--<input type="checkbox" class="form-control" id="asintomatico" name="asintomatico">--}}
                                                    {!! Form::checkbox('asintomatico', old('asintomatico'), old('asintomatico') == 'on' ?  true : false, ['class'=>'', 'id'=>'asintomatico']) !!}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="palpitaciones"
                                                       class="col-lg-8 text-left {{--control-label --}}">Palpitaciones</label>
                                                <div class="col-lg-4">
                                                    {{--{!! Form::hidden('palpitaciones', 1) !!}--}}
                                                    {{--<input type="checkbox" class="form-control" id="palpitaciones" name="palpitaciones">--}}
                                                    {!! Form::checkbox('palpitaciones', old('palpitaciones'), old('palpitaciones') == 'on' ?  true : false, ['class'=>'', 'id'=>'palpitaciones']) !!}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="angor"
                                                       class="col-lg-8 text-left {{--control-label --}}">Angor</label>
                                                <div class="col-lg-4">
                                                    {{--{!! Form::hidden('angor', 1) !!}--}}
                                                    {{--<input type="checkbox" class="form-control" id="angor" name="angor">--}}
                                                    {!! Form::checkbox('angor', old('angor'), old('angor') == 'on' ?  true : false, ['class'=>'', 'id'=>'angor']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="colageno" class="col-lg-8 text-left {{--control-label --}}">Colagenopatías</label>
                                                <div class="col-lg-4">
                                                    {{--{!! Form::hidden('colageno', 1) !!}--}}
                                                    {{--<input type="checkbox" class="form-control" id="colageno" name="colageno">--}}
                                                    {!! Form::checkbox('colageno', old('colageno'), old('colageno') == 'on' ?  true : false, ['class'=>'', 'id'=>'colageno']) !!}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="obesidad" class="col-lg-8 text-left {{--control-label --}}">Obesidad
                                                    mórbida</label>
                                                <div class="col-lg-4">
                                                    {{--{!! Form::hidden('obesidad', 1) !!}--}}
                                                    {{--<input type="checkbox" class="form-control" id="obesidad" name="obesidad">--}}
                                                    {!! Form::checkbox('obesidad', old('obesidad'), old('obesidad') == 'on' ?  true : false, ['class'=>'', 'id'=>'obesidad']) !!}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="alcoholismo" class="col-lg-8 text-left {{--control-label --}}">Alcoholismo</label>
                                                <div class="col-lg-4">
                                                    {{--{!! Form::hidden('alcoholismo', 1) !!}--}}
                                                    {{--<input type="checkbox" class="form-control" id="alcoholismo" name="alcoholismo">--}}
                                                    {!! Form::checkbox('alcoholismo', old('alcoholismo'), old('alcoholismo') == 'on' ?  true : false, ['class'=>'', 'id'=>'alcoholismo']) !!}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="acv" class="col-lg-8 text-left {{--control-label --}}">Accidente
                                                    Cerebrovascular</label>
                                                <div class="col-lg-4">
                                                    {{--{!! Form::hidden('acv', 1) !!}--}}
                                                    {{--<input type="checkbox" class="form-control" id="acv" name="acv">--}}
                                                    {!! Form::checkbox('acv', old('acv'), old('acv') == 'on' ?  true : false, ['class'=>'', 'id'=>'acv']) !!}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disnea"
                                                       class="col-lg-8 text-left {{--control-label --}}">Disnea</label>
                                                <div class="col-lg-4">
                                                    {{--{!! Form::hidden('disnea', 1) !!}--}}
                                                    {{--<input type="checkbox" class="form-control" id="disnea" name="disnea">--}}
                                                    {!! Form::checkbox('disnea', old('disnea'), old('disnea') == 'on' ?  true : false, ['class'=>'', 'id'=>'disnea']) !!}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disnea1" class="col-lg-8 text-left {{--control-label --}}">Disnea
                                                    Clase Funcional I</label>
                                                <div class="col-lg-4">
                                                    {{--{!! Form::hidden('disnea1', 1) !!}--}}
                                                    {{--<input type="checkbox" class="form-control" id="disnea1" name="disnea1">--}}
                                                    {!! Form::checkbox('disnea1', old('disnea1'), old('disnea1') == 'on' ?  true : false, ['class'=>'', 'id'=>'disnea1']) !!}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disnea2" class="col-lg-8 text-left {{--control-label --}}">Disnea
                                                    Clase Funcional II</label>
                                                <div class="col-lg-4">
                                                    {{--{!! Form::hidden('disnea2', 1) !!}--}}
                                                    {{--<input type="checkbox" class="form-control" id="disnea2" name="disnea2">--}}
                                                    {!! Form::checkbox('disnea2', old('disnea2'), old('disnea2') == 'on' ?  true : false, ['class'=>'', 'id'=>'disnea2']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="disnea3" class="col-lg-8 text-left {{--control-label --}}">Disnea
                                                    Clase Funcional III</label>
                                                <div class="col-lg-4">
                                                    {{--{!! Form::hidden('disnea3', 1) !!}--}}
                                                    {{--<input type="checkbox" class="form-control" id="disnea3" name="disnea3">--}}
                                                    {!! Form::checkbox('disnea3', old('disnea3'), old('disnea3') == 'on' ?  true : false, ['class'=>'', 'id'=>'disnea3']) !!}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="disnea4" class="col-lg-8 text-left {{--control-label --}}">Disnea
                                                    Clase Funcional IV</label>
                                                <div class="col-lg-4">
                                                    {{--{!! Form::hidden('disnea4', 1) !!}--}}
                                                    {{--<input type="checkbox" class="form-control" id="disnea4" name="disnea4">--}}
                                                    {!! Form::checkbox('disnea4', old('disnea4'), old('disnea4') == 'on' ?  true : false, ['class'=>'', 'id'=>'disnea4']) !!}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="hipotiroidismo"
                                                       class="col-lg-8 text-left {{--control-label --}}">Hipotiroidismo</label>
                                                <div class="col-lg-4">
                                                    {{--{!! Form::hidden('hipotiroidismo', 1) !!}--}}
                                                    {{--<input type="checkbox" class="form-control" id="hipotiroidismo" name="hipotiroidismo">--}}
                                                    {!! Form::checkbox('hipotiroidismo', old('hipotiroidismo'), old('hipotiroidismo') == 'on' ?  true : false, ['class'=>'', 'id'=>'hipotiroidismo']) !!}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="hipertiroidismo"
                                                       class="col-lg-8 text-left {{--control-label --}}">Hipertiroidismo</label>
                                                <div class="col-lg-4">
                                                    {{--{!! Form::hidden('hipertiroidismo', 1) !!}--}}
                                                    {{--<input type="checkbox" class="form-control" id="hipertiroidismo" name="hipertiroidismo">--}}
                                                    {!! Form::checkbox('hipertiroidismo', old('hipertiroidismo'), old('hipertiroidismo') == 'on' ?  true : false, ['class'=>'', 'id'=>'hipertiroidismo']) !!}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="cardio_congenitas"
                                                       class="col-lg-8 text-left {{--control-label --}}">Cardiopatías
                                                    congénitas</label>
                                                <div class="col-lg-4">
                                                    {{--{!! Form::hidden('cardio_congenitas', 1) !!}--}}
                                                    {{--<input type="checkbox" class="form-control" id="cardio_congenitas" name="cardio_congenitas">--}}
                                                    {!! Form::checkbox('cardio_congenitas', old('cardio_congenitas'), old('cardio_congenitas') == 'on' ?  true : false, ['class'=>'', 'id'=>'cardio_congenitas']) !!}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="valvulopatias"
                                                       class="col-lg-8 text-left {{--control-label --}}">Valvulopatias</label>
                                                <div class="col-lg-4">
                                                    {{--{!! Form::hidden('valvulopatias', 1) !!}--}}
                                                    {{--<input type="checkbox" class="form-control" id="valvulopatias" name="valvulopatias">--}}
                                                    {!! Form::checkbox('valvulopatias', old('valvulopatias'), old('valvulopatias') == 'on' ?  true : false, ['class'=>'', 'id'=>'valvulopatias']) !!}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="mareos"
                                                       class="col-lg-8 text-left {{--control-label --}}">Mareos</label>
                                                <div class="col-lg-4">
                                                    {{--{!! Form::hidden('mareos', 1) !!}--}}
                                                    {{--<input type="checkbox" class="form-control" id="mareos" name="mareos">--}}
                                                    {!! Form::checkbox('mareos', old('mareos'), old('mareos') == 'on' ?  true : false, ['class'=>'', 'id'=>'mareos']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="cardio_isquemica"
                                                       class="col-lg-8 text-left {{--control-label --}}">Cardiopatía
                                                    isquémica</label>
                                                <div class="col-lg-4">
                                                    {{--{!! Form::hidden('cardio_isquemica', 1) !!}--}}
                                                    {{--<input type="checkbox" class="form-control" id="cardio_isquemica" name="cardio_isquemica">--}}
                                                    {!! Form::checkbox('cardio_isquemica', old('cardio_isquemica'), old('cardio_isquemica') == 'on' ?  true : false, ['class'=>'', 'id'=>'cardio_isquemica']) !!}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="ht_arterial_leve"
                                                       class="col-lg-8 text-left {{--control-label --}}">Hipertensión
                                                    arterial leve</label>
                                                <div class="col-lg-4">
                                                    {{--{!! Form::hidden('ht_arterial_leve', 1) !!}--}}
                                                    {{--<input type="checkbox" class="form-control" id="ht_arterial_leve" name="ht_arterial_leve">--}}
                                                    {!! Form::checkbox('ht_arterial_leve', old('ht_arterial_leve'), old('ht_arterial_leve') == 'on' ?  true : false, ['class'=>'', 'id'=>'ht_arterial_leve']) !!}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="ht_arterial_mode"
                                                       class="col-lg-8 text-left {{--control-label --}}">Hipertensión
                                                    arterial moderada</label>
                                                <div class="col-lg-4">
                                                    {{--{!! Form::hidden('ht_arterial_mode', 1) !!}--}}
                                                    {{--<input type="checkbox" class="form-control" id="ht_arterial_mode" name="ht_arterial_mode">--}}
                                                    {!! Form::checkbox('ht_arterial_mode', old('ht_arterial_mode'), old('ht_arterial_mode') == 'on' ?  true : false, ['class'=>'', 'id'=>'ht_arterial_mode']) !!}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="ht_arterial_severa"
                                                       class="col-lg-8 text-left {{--control-label --}}">Hipertensión
                                                    arterial severa</label>
                                                <div class="col-lg-4">
                                                    {{--{!! Form::hidden('ht_arterial_severa', 1) !!}--}}
                                                    {{--<input type="checkbox" class="form-control" id="ht_arterial_severa" name="ht_arterial_severa">--}}
                                                    {!! Form::checkbox('ht_arterial_severa', old('ht_arterial_severa'), old('ht_arterial_severa') == 'on' ?  true : false, ['class'=>'', 'id'=>'ht_arterial_severa']) !!}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="perdida_conoc"
                                                       class="col-lg-8 text-left {{--control-label --}}">Pérdida de
                                                    conocimiento</label>
                                                <div class="col-lg-4">
                                                    {{--{!! Form::hidden('perdida_conoc', 1) !!}--}}
                                                    {{--<input type="checkbox" class="form-control" id="perdida_conoc" name="perdida_conoc">--}}
                                                    {!! Form::checkbox('perdida_conoc', old('perdida_conoc'), old('perdida_conoc') == 'on' ?  true : false, ['class'=>'', 'id'=>'perdida_conoc']) !!}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="insuf_cardiaca"
                                                       class="col-lg-8 text-left {{--control-label --}}">Insuficiencia
                                                    cardíaca</label>
                                                <div class="col-lg-4">
                                                    {{--{!! Form::hidden('insuf_cardiaca', 1) !!}--}}
                                                    {{--<input type="checkbox" class="form-control" id="insuf_cardiaca" name="insuf_cardiaca">--}}
                                                    {!! Form::checkbox('insuf_cardiaca', old('insuf_cardiaca'), old('insuf_cardiaca') == 'on' ?  true : false, ['class'=>'', 'id'=>'insuf_cardiaca']) !!}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="tipo_insuf_card"
                                                       class="col-lg-8 text-left {{--control-label --}}">Tipo de
                                                    insuficiencia cardíaca</label>
                                                <div class="col-lg-4">
                                                    <input type="text" class="form-control" id="tipo_insuf_card"
                                                           name="tipo_insuf_card" value="{!! old('tipo_insuf_card') !!}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-1">
                                            <label for="otras_pat_asoc"
                                                   class="col-lg-8 text-left {{--control-label --}}">Otras
                                                patologías</label>
                                        </div>
                                        <div class="col-lg-11">
                                        <textarea class="form-control" name="otras_pat_asoc" id="otras_pat_asoc"
                                                  cols="145" rows="2">{!! old('otras_pat_asoc') !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-3">
                                            <label for="otros_sintomas_ing"
                                                   class="col-lg-8 text-left {{--control-label --}}">Otros síntomas al
                                                ingreso</label>
                                        </div>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control" id="otros_sintomas_ing"
                                                   name="otros_sintomas_ing" value="{!! old('otros_sintomas_ing') !!}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="portlet box blue">
                                <div class="portlet-title"><div class="caption">Nuevos Síntomas</div></div>
                                <div class="portlet-body">
                                    <div class="form-group">
                                        <label for="nuevos_sintomas"
                                               class="col-lg-8 text-left {{--control-label --}}">¿Hubo nuevos
                                            síntomas?</label>
                                        <div class="col-lg-4">
                                            <select class="form-control" id="nuevos_sintomas" name="nuevos_sintomas">
                                                <option value="" {{ old('nuevos_sintomas') == "" ? "selected" : "" }}> </option>
                                                <option value="S" {{ old('nuevos_sintomas') == "S" ? "selected" : "" }}>Si</option>
                                                <option value="N" {{ old('nuevos_sintomas') == "N" ? "selected" : "" }}>No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-12">
                                            <label for="obs_sintomas"
                                                   class="col-lg-8 text-left {{--control-label --}}">Observaciones</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                        <textarea class="form-control" name="obs_sintomas" id="obs_sintomas" cols="30"
                                                  rows="6">{!! old('obs_sintomas') !!}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            {{--//Columna Serología--}}
                            <div class="col-lg-12">
                                <div class="portlet box blue">
                                    <div class="portlet-title"><div class="caption">Serología</div></div>
                                    <div class="portlet-body">
                                        <div class="form-group">
                                            <label for="tres_negativas" class="col-lg-8 control-label">3 pruebas serológicas
                                                negativas</label>
                                            <div class="col-lg-4">
                                                {{--{!! Form::hidden('tres_negativas', 1) !!}--}}
                                                {{--<input type="checkbox" class="form-control" id="tres_negativas" name="tres_negativas">--}}
                                                {!! Form::checkbox('tres_negativas', old('tres_negativas'), old('tres_negativas') == 'on' ?  true : false, ['class'=>'', 'id'=>'tres_negativas']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="serologia_ing" class="col-lg-8 control-label">Serología al
                                                ingreso</label>
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control" id="serologia_ing"
                                                       name="serologia_ing" value="{!! old('serologia_ing') !!}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="titulos_sero_ing" class="col-lg-8 control-label">Titulos serológicos
                                                al ingreso</label>
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control" id="titulos_sero_ing"
                                                       name="titulos_sero_ing" value="{!! old('titulos_sero_ing') !!}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="trat_etio" class="col-lg-8 control-label">Tratamiento
                                                Etiológico</label>
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control" id="trat_etio" name="trat_etio" value="{!! old('trat_etio') !!}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="portlet box blue">
                                <div class="portlet-title"><div class="caption">Radiografía</div></div>
                                <div class="portlet-body">
                                    <div class="form-group">
                                        <label for="fecha_rx_torax" class="col-lg-8 text-left {{--control-label --}}">Fecha
                                            de Radiografía de Tórax</label>
                                        <div class="col-lg-4">
                                        <input type="text" class="form-control datepicker" id="fecha_rx_torax"
                                               name="fecha_rx_torax" value="{!! old('fecha_rx_torax') !!}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="rx_torax"
                                               class="col-lg-8 text-left {{--control-label --}}">Consignación</label>
                                        <div class="col-lg-4">
 
                                            <select class="form-control" id="rx_torax" name="rx_torax">
                                                <option value="S">Si</option>
                                                <option value="N">No</option>
                                            </select>                                        
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="indice_cardiotorax" class="col-lg-8 text-left {{--control-label --}}">Índice
                                            cardiotorácico</label>
                                        <div class="col-lg-4">
                                            <select class="form-control" id="indice_cardiotorax" name="indice_cardiotorax">
                                                @for($i=1;$i<15;$i++)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="obs_rxt"
                                               class="col-lg-3 text-left {{--control-label --}}">Observación</label>
                                        <div class="col-lg-8 col-lg-offset-1">
                                        <textarea class="form-control" name="obs_rxt" id="obs_rxt" cols="30"
                                                  rows="2">{!! old('obs_rxt') !!}</textarea>
                                        </div>
                                    </div>
                                    {{--Cambios--}}
                                    <div class="form-group">
                                        <label for="cambios_rxt" class="col-lg-8 text-left {{--control-label --}}">Cambios
                                            en la Rx</label>
                                        <div class="col-lg-4">
                                            <select class="form-control" id="cambios_rxt" name="cambios_rxt">
                                                <option value="S">Si</option>
                                                <option value="N">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fecha_cambios_rxt" class="col-lg-8 text-left {{--control-label --}}">Fecha
                                            del cambio</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control datepicker" id="fecha_cambios_rxt"
                                                   name="fecha_cambios_rxt" value="{!! old('fecha_cambios_rxt') !!}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nueva_rxt" class="col-lg-8 text-left {{--control-label --}}">Nueva
                                            Radiografía</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control" id="nueva_rxt" name="nueva_rxt" value="{!! old('nueva_rxt') !!}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
   
                </div>
                    <input type="submit" class="hidden" name="submit-guardar" id="submit-guardar">
            </form>
        </div>
    </div>
@endsection