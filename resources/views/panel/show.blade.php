@extends('master')

@include('shared.estilos')

@section('scripts')
    <script>

        //Handler para borrar una consulta
        $(document).on('click', '.btn-borra-consulta', function (e) {
            $('#id_consulta_borrar').val($(this).attr('data-id'));
        });

        //Handler para traer datos de la consulta a editar
//        $(document).on('click', '.btn-edita-consulta', function (e) {
//            $.ajax({
//                type: "GET",
//                url: $(this).attr('data-href'),
//                success: function (data) {
//                    //$('#limpieza_edit').find('#form-editar-consulta')[0].reset();
//                    data = JSON.parse(data);
//                    //console.log(data);
//                    //console.log(data.consulta.titulo);
//                    //CKEDITOR.instances.editor_descripcion_edit.setData('');
//                    $('#titulo_edit').val(data.consulta.titulo);
//                    $('#id_consulta_edit').val(data.consulta.id);
//                    CKEDITOR.instances.editor_descripcion_edit.setData(data.consulta.descripcion);
//                    $("#modal-consulta-editar").modal('show');
//                    return false;
//                    //e.preventDefault();
//                },
//                error: function () {
//                    return alert("Ocurrió un problema. Contactar al desarrollador.");
//                }
//            });
//        });

        $(document).on('ready', function () {
            $("#expand-boton").on('click', function () {

                $cabecera = $("#cabecera");

                //getting the next element
                $content = $cabecera.next();
                //open up the content needed - toggle the slide- if visible, slide up, if not slidedown.
                $content.slideToggle(500, function () {
                    $content.is(":visible") ? $("#expand-boton").children('i').html("keyboard_arrow_up") : $("#expand-boton").children('i').html("keyboard_arrow_down");
                });
            });
            $('#modal-consulta-nueva').on('show.bs.modal', function (e) {
                $('#limpieza').find('form')[0].reset();
                CKEDITOR.instances.editor_descripcion.setData('');
                //$('#limpieza').find('iframe>html>body').remove();
            });

            //Función genérica para hacer Ajax post calls
            var ajaxSubmit = function (formId, /*modal,*/ fnCallback) {
                $.ajax({
                    type: $(formId).attr('method'), //Se generalizó el method
                    url: $(formId).attr('action'),
                    data: $(formId).serialize(),
                    success: function (data) {
                        //$(modal).modal('hide');
                        return fnCallback(data);
                    },
                    error: function () {
                        return alert("Ocurrió un problema. Contactar al desarrollador.");//fnCallback(data);
                    }
                });
            };

            //Handler confirmación de borrar consulta
            $('#submitConsulta_borrar').on('click', function (e) {
                ajaxSubmit(
                        $('#form-borrar-consulta'),
                        function (data) {
                            data = JSON.parse(data);
                            $('#modal-consulta-borrar').modal('hide');
                            $('#consulta_' + data).fadeOut(2000, function () {
                                $(this).remove();
                            });
                        }
                );
                e.preventDefault();
            });


            //Handler para validar formulario de edición de consulta y luego enviar al servidor
//            $("#submitConsulta_editar").on('click', function (e) {
//                $("#hidden_descripcion_edit").val(CKEDITOR.instances.editor_descripcion_edit.getData());
//                //console.log($('#form-editar-consulta').serialize());
//                if (!$('#form-editar-consulta').isValid(false)) {
//                    return alert("El formulario contiene campos inválidos");
//                } else {
//                    ajaxSubmit(
//                            $('#form-editar-consulta'),
//                            function (data) {
//                                data = JSON.parse(data);
//                                $('#consulta_' + data.id + ' .titulo_consulta').html(data.titulo);
//                                $('#consulta_' + data.id + ' .desc_consulta').html(data.descripcion);
//                                $("#modal-consulta-editar").modal('hide');
//                            }
//                    );
//                    e.preventDefault();
//                }
//            });

            //Handler para validar formulario de nueva consulta y luego enviar al servidor
            $("#submitConsulta").on('click', function (e) {
                $("#hidden_descripcion").val(CKEDITOR.instances.editor_descripcion.getData());

                if (!$('#form-nueva-consulta').isValid(false)) {
                    return alert("El formulario contiene campos inválidos");
                } else {
                    ajaxSubmit(
                            $('#form-nueva-consulta'),
                            function (data) {
                                data = JSON.parse(data);

                                var newConsulta = $('<div>');
                                newConsulta.addClass('well well-lg');
                                newConsulta.attr('id', 'consulta_' + data.id);
                                newConsulta.html('<div class="row">\
                                        <div class="col-lg-8">\
                                        <p><strong>Medico: </strong>' + data.medico.name + '</p>\
                                </div>\
                                <div class="col-lg-4">\
                                        <p><strong>Fecha: </strong>' + moment(data.fecha).format('DD/MM/YYYY') + '</p>\
                                </div>\
                                </div>\
                                <div class="row">\
                                        <div class="col-lg-12">\
                                        <p><strong>Titulo: </strong>\
                                <span class="titulo_consulta">' + data.titulo + '</span></p>\
                                        </p>\
                                        </div>\
                                        </div>\
                                        <div class="row">\
                                        <div class="col-lg-12">\
                                        <p>\
                                        <strong>Descripción: </strong>\
                                </p>\
                                        <div class="desc_consulta">' + data.descripcion + '</div>\
                                        </div>\
                                        </div>\
                                        <div class="row">\
                                        <div class="col-lg-5 col-lg-offset-7">\
                                        <a href="javascript:void(0)" class="btn btn-sm btn-raised btn-danger btn-borra-consulta" data-id="' + data.id + '" data-target="#modal-consulta-borrar" data-toggle="modal">Eliminar</a>\
                                                        <button class="btn btn-sm btn-raised btn-primary btn-edita-consulta"\
                                                        data-target="#modal-consulta-editar" data-toggle="modal"\
                                                        data-href="/panel/paciente/' + data.id_paciente + '/consulta/' + data.id + '">Editar</button>\
                                        </div>\
                                        </div>');


                                $("#pbody-consultas").prepend(newConsulta);

                                //agregado
                                $("#fecha_ult_consulta").val( moment(data.fecha).format('DD/MM/YYYY'));
                                //fin agregado
                                $("#modal-consulta-nueva").modal('hide');
                                $("#pbody-consultas").scrollTop(0);
                            }
                    );
                    e.preventDefault();
                }
            });

        });
    </script>

    <script src="../../../ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('editor_descripcion', {
            customConfig: '../../../ckeditor/custom_config.js'
        });
        CKEDITOR.replace('editor_descripcion_edit', {
            customConfig: '../../../ckeditor/custom_config.js'
        });
    </script>

    <script>
        $.validate({
            form: '#form-nueva-consulta',
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

    @if(session('status'))

        <script>
            $(document).ready(function () {

                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-bottom-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "1000",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };

                toastr["success"]("{{ session('status') }}");

            });
        </script>
    @endif

@endsection

@section('title')
    Historia Clínica - {!! $paciente->apellido . "," . $paciente->nombre !!}
@endsection

@section('content')
    <div class="panel panel-primary" style="margin-top: -20px   ">
        <div class="panel-heading">
            <div class="row">
                <div class="col-lg-7">
                    <h2 class="text-left" style="border-radius: 0">Historia Clínica
                        de {!! $paciente->apellido . ", " . $paciente->nombre . " (H.C.:" . $paciente->id_hc . ")"!!}</h2>
                </div>
                {{--                <div class="col-lg-2">
                                    <a href="#" class="btn btn-raised btn-success pull-right">Editar Historia</a>
                                </div>--}}
                <div class="col-lg-3">
                    <div class="btn-group btn-group-justified btn-group-raised">
                        <a href="{!! action('Panel\EpidemiologiaController@edit', $paciente->id) !!}" class="btn btn-raised btn-default"
                           style="background-color: #EEEEEE">Epidemiología</a>
                        <a href="{!! action('Panel\PanelHistoriasController@edit', $paciente->id) !!}"
                           class="btn btn-raised btn-success">Editar Historia</a>
                    </div>
                </div>
                <div class="col-lg-2">
                    <a href="#" class="btn btn-raised btn-info pull-right">Versión imprimible</a>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" method="post">

                @foreach ($errors->all() as $error)
                    <p class="alert alert-danger">{{ $error }}</p>
                @endforeach

                {{--   @if (session('status'))
                       <div class="alert alert-success">
                           {{ session('status') }}
                       </div>
                   @endif
   --}}
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                {{--Cabecera - Siempre visible--}}
                <div id="cabecera">
                    <div class="row">
                        {{--Columna Documento y Seguimiento--}}
                        {{--<div class="form-group">--}}
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <label for="tipo_doc" class="col-lg-2 text-left{{-- control-label --}} ">Tipo
                                        Documento</label>
                                    <div class="col-lg-1">
                                        <input type="text" class="form-control" id="tipo_doc" name="tipo_doc"
                                               value="{!! $paciente->tipo_doc !!}" readonly>
                                    </div>
                                    {{--</div>--}}
                                    {{--<div class="form-group">--}}
                                    <label for="numero_doc" class="col-lg-2 text-left{{-- control-label --}}">Nro.
                                        Documento</label>
                                    <div class="col-lg-2">
                                        <input type="text" class="form-control" id="numero_doc" name="numero_doc"
                                               value="{!! $paciente->numero_doc !!}" readonly>
                                    </div>
                                    <div class="col-lg-1 col-lg-offset-1">
                                        <a href="{!! action('Panel\TelefonosController@index', $paciente->id) !!}" class="btn btn-raised btn-default"
                                           style="background-color: #EEEEEE">Teléfonos</a>
                                    </div>
                                    <div class="col-lg-1 col-lg-offset-1">
                                        <a href="{!! action('Panel\DireccionesController@index', $paciente->id) !!}" class="btn btn-raised btn-default"
                                           style="background-color: #EEEEEE">Direcciones</a>
                                    </div>
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
                                                    <input type="date" class="form-control" id="fecha_nac"
                                                           name="fecha_nac"
                                                           value="@if($paciente->fecha_nac){!! $paciente->fecha_nac->format('d/m/Y') !!}@endif"
                                                           readonly>
                                                </div>
                                                <label for="edad_ing" class="col-lg-3 control-label">Edad al
                                                    ingreso</label>
                                                <div class="col-lg-3">
                                                    <input type="number" class="form-control" id="edad_ing"
                                                           name="edad_ing"
                                                           value="@if($paciente->fecha_alta and $paciente->fecha_nac){!! $paciente->fecha_alta->diffInYears($paciente->fecha_nac) !!}@else 0 @endif"
                                                           readonly>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="fecha_alta" class="col-lg-3 control-label">Fecha
                                                    Ing.</label>
                                                <div class="col-lg-3">
                                                    <input type="date" class="form-control" id="fecha_alta"
                                                           name="fecha_alta"
                                                           value="@if($paciente->fecha_alta){!! $paciente->fecha_alta->format('d/m/Y') !!}@endif"
                                                           readonly>
                                                </div>
                                                <label for="anios_seg" class="col-lg-3 control-label">Años
                                                    Seguimiento.</label>
                                                <div class="col-lg-3">
                                                    <input type="number" class="form-control" id="anios_seg"
                                                           name="anios_seg"
                                                           value="@if($paciente->fecha_alta){!! \Carbon\Carbon::now()->diffInYears($paciente->fecha_alta) !!}@endif"
                                                           readonly>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="fecha_ult_consulta" class="col-lg-3 control-label">Fecha
                                                    Ult.
                                                    Consulta</label>
                                                <div class="col-lg-3">
                                                    <input type="date" class="form-control" id="fecha_ult_consulta"
                                                           name="fecha_ult_consulta"
                                                           {{--value="@if($paciente->fecha_ult_consulta){!! $paciente->fecha_ult_consulta->format('d/m/Y') !!}@endif"--}}
                                                           value="@if(!$consultas->isEmpty()){!! \Carbon\Carbon::parse($consultas->max('fecha'))->format('d/m/Y') !!}@elseif($paciente->fecha_ult_consulta){!! $paciente->fecha_ult_consulta->format('d/m/Y') !!}@endif"
                                                           readonly>
                                                </div>
                                                <label for="proxima_cita" class="col-lg-3 control-label">Próxima
                                                    Cita</label>
                                                <div class="col-lg-3">
                                                    <input type="date" class="form-control" id="proxima_cita"
                                                           name="proxima_cita"
                                                           value="@if($paciente->proxima_cita){!! $paciente->proxima_cita->format('d/m/Y') !!}@endif"
                                                           readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--                                   <fieldset style="border: solid 1px black">
                                                                           <legend>Seguimiento</legend>

                                                                       </fieldset>--}}
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
                                            <input type="text" class="form-control" id="ecg"
                                                   name="ecg"
                                                   value="@if($paciente->ecg=="N") Normal @elseif($paciente->ecg=="E") Específico @elseif($paciente->ecg == "I") Inespecífico @else {!! $paciente->ecg !!} @endif"
                                                   readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="tipo_ecg"
                                               class="col-lg-8 text-left {{--control-label --}}">Descripción</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control" id="tipo_ecg"
                                                   name="tipo_ecg" value="{!! $paciente->tipo_ecg !!}"
                                                   readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="nuevos_cambios_ecg"
                                               class="col-lg-8 text-left {{--control-label --}}">Nuevos
                                            cambios</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control" id="nuevos_cambios_ecg"
                                                   name="nuevos_cambios_ecg"
                                                   value="{!! $paciente->nuevos_cambios_ecg !!}"
                                                   readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="fecha_cambios_ecg"
                                               class="col-lg-8 text-left {{--control-label --}}">Fecha
                                            del cambio</label>
                                        <div class="col-lg-4">
                                            <input type="date" class="form-control" id="fecha_cambios_ecg"
                                                   name="fecha_cambios_ecg"
                                                   value="@if($paciente->fecha_cambios_ecg){!! $paciente->fecha_cambios_ecg->format('d/m/Y') !!}@endif"
                                                   readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="tipo_cambio_ecg" class="col-lg-8 text-left {{--control-label --}}">Tipo
                                            de cambio</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control" id="tipo_cambio_ecg"
                                                   name="tipo_cambio_ecg" value="{!! $paciente->tipo_cambio_ecg !!}"
                                                   readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="obs_ecg"
                                               class="col-lg-3 text-left {{--control-label --}}">Observación</label>
                                        <div class="col-lg-9">
                                        <textarea class="form-control" name="obs_ecg" id="obs_ecg" cols="30"
                                                  rows="2" readonly>{!! $paciente->obs_ecg !!}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--                      <fieldset class="col-lg-12" style="border: solid 1px black;">
                                                      <legend>ECG</legend>

                                                  </fieldset>--}}
                        </div>
                        <div class="col-lg-3">
                            {{--//Columna Grupo Clínico--}}
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Grupo Clínico</div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <label for="grupo_clinico_ing" class="col-lg-8 control-label">Grupo Clínico
                                                al
                                                Ingreso</label>
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control" id="grupo_clinico_ing"
                                                       name="grupo_clinico_ing"
                                                       value="{!! $paciente->grupo_clinico_ing !!}"
                                                       readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="cambio_grupo_cli" class="col-lg-8 control-label">Cambio en el
                                                Grupo
                                                Clínico</label>
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control" id="cambio_grupo_cli"
                                                       name="cambio_grupo_cli"
                                                       value="@if($paciente->cambio_grupo_cli=="S") Si @elseif($paciente->cambio_grupo_cli=="N") No @endif"
                                                       readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="fecha_cambio_gcli" class="col-lg-8 control-label">Fecha Cambio
                                                Grupo
                                                Clínico</label>
                                            <div class="col-lg-4">
                                                <input type="date" class="form-control" id="fecha_cambio_gcli"
                                                       name="fecha_cambio_gcli"
                                                       value="@if($paciente->fecha_cambio_gcli) {!! $paciente->fecha_cambio_gcli->format('d/m/Y') !!} @endif"
                                                       readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="nuevo_grupo_cli" class="col-lg-8 control-label">Nuevo Grupo
                                                Clínico</label>
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control" id="nuevo_grupo_cli"
                                                       name="nuevo_grupo_cli" value="{!! $paciente->nuevo_grupo_cli !!}"
                                                       readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--                                <fieldset style="border: solid 1px black;">
                                                                    <legend>Grupo Clínico</legend>

                                                                </fieldset>--}}
                            </div>
                        </div>
                        <div class="col-lg-1">
                            {{--//Columna Estado Paciente--}}
                            <div class="col-lg-12">
                                <div class="row">
                                    <label for="vivo" class="col-lg-12 control-label">¿Vivo?</label>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control" id="vivo" name="vivo"
                                               value="@if($paciente->vivo =="S") Si @elseif($paciente->vivo=="N") No @else {!! $paciente->vivo  !!} @endif"
                                               readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="causa_muerte" class="col-lg-12 control-label">¿Causa muerte?</label>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control" id="causa_muerte" name="causa_muerte"
                                               value="{!! $paciente->causa_muerte !!}" readonly>
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
                                            <input type="checkbox" class="form-control" id="trat_bnz"
                                                   name="trat_bnz" @if($paciente->trat_bnz == 2) checked
                                                   @endif disabled>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="fecha_ini_trat_bnz"
                                               class="col-lg-8 text-left {{--control-label --}}">Fecha
                                            Inicio Tratamiento</label>
                                        <div class="col-lg-4">
                                            <input type="date" class="form-control" id="fecha_ini_trat_bnz"
                                                   name="fecha_ini_trat_bnz"
                                                   value="@if($paciente->fecha_ini_trat_bnz){!! $paciente->fecha_ini_trat_bnz->format('d/m/Y') !!}@endif"
                                                   readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="efectos_adv_bnz" class="col-lg-8 text-left {{--control-label --}}">Efectos
                                            Adversos</label>
                                        <div class="col-lg-4">
                                            <input type="checkbox" class="form-control" id="efectos_adv_bnz"
                                                   name="efectos_adv_bnz" @if($paciente->efectos_adv_bnz == 2) checked
                                                   @endif disabled>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="efec_rash_bnz" class="col-lg-8 text-left {{--control-label --}}">Presenta
                                            rash cutáneo</label>
                                        <div class="col-lg-4">
                                            <input type="checkbox" class="form-control" id="efec_rash_bnz"
                                                   name="efec_rash_bnz" @if($paciente->efec_rash_bnz == 2) checked
                                                   @endif disabled>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="efec_intgas_bnz" class="col-lg-8 text-left {{--control-label --}}">Presenta
                                            intolerancia gástrica/digestiva</label>
                                        <div class="col-lg-4">
                                            <input type="checkbox" class="form-control" id="efec_intgas_bnz"
                                                   name="efec_intgas_bnz" @if($paciente->efec_intgas_bnz == 2) checked
                                                   @endif disabled>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="efec_afhep_bnz" class="col-lg-8 text-left {{--control-label --}}">Presenta
                                            afectación hepática</label>
                                        <div class="col-lg-4">
                                            <input type="checkbox" class="form-control" id="efec_afhep_bnz"
                                                   name="efec_afhep_bnz" @if($paciente->efec_afhep_bnz == 2) checked
                                                   @endif disabled>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="efec_afneur_bnz" class="col-lg-8 text-left {{--control-label --}}">Presenta
                                            afectación neurológica</label>
                                        <div class="col-lg-4">
                                            <input type="checkbox" class="form-control" id="efec_afneur_bnz"
                                                   name="efec_afneur_bnz" @if($paciente->efec_afneur_bnz == 2) checked
                                                   @endif disabled>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="efec_afhem_bnz" class="col-lg-8 text-left {{--control-label --}}">Presenta
                                            afectación hematológica</label>
                                        <div class="col-lg-4">
                                            <input type="checkbox" class="form-control" id="efec_afhem_bnz"
                                                   name="efec_afhem_bnz" @if($paciente->efec_afhem_bnz == 2) checked
                                                   @endif disabled>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="susp_bnz" class="col-lg-8 text-left {{--control-label --}}">Suspensión
                                            del tratamiento</label>
                                        <div class="col-lg-4">
                                            <input type="checkbox" class="form-control" id="susp_bnz"
                                                   name="susp_bnz" @if($paciente->susp_bnz == 2) checked
                                                   @endif disabled>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="efec_otros_bnz" class="col-lg-8 text-left {{--control-label --}}">Otros
                                            efectos adversos</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control" id="efec_otros_bnz"
                                                   name="efec_otros_bnz" value="{!! $paciente->efec_otros_bnz !!}"
                                                   readonly>
                                        </div>
                                    </div>
                                </div>
                                {{--Fin Nuevo--}}
                            </div>
                            {{--                    <fieldset class="col-lg-12" style="border: solid 1px black;">
                                                    <legend>Tratamiento con BNZ</legend>

                                                </fieldset>--}}
                        </div>
                        <div class="col-lg-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">Tratamiento con Nifurtimox</div>
                                <div class="panel-body">
                                    <div class="row">
                                        <label for="trat_nifur" class="col-lg-8 text-left {{--control-label --}}">Tratamiento
                                            con Nifurtimox</label>
                                        <div class="col-lg-4">
                                            <input type="checkbox" class="form-control" id="trat_nifur"
                                                   name="trat_nifur" @if($paciente->trat_nifur == 2) checked
                                                   @endif disabled>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="fecha_ini_trat_nifur"
                                               class="col-lg-8 text-left {{--control-label --}}">Fecha
                                            Inicio Tratamiento</label>
                                        <div class="col-lg-4">
                                            <input type="date" class="form-control" id="fecha_ini_trat_nifur"
                                                   name="fecha_ini_trat_nifur"
                                                   value="@if($paciente->fecha_ini_trat_nifur){!! $paciente->fecha_ini_trat_nifur->format('d/m/Y') !!}@endif"
                                                   readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="efectos_adv_nifur"
                                               class="col-lg-8 text-left {{--control-label --}}">Efectos
                                            Adversos</label>
                                        <div class="col-lg-4">
                                            <input type="checkbox" class="form-control" id="efectos_adv_nifur"
                                                   name="efectos_adv_nifur"
                                                   @if($paciente->efectos_adv_nifur == 2) checked
                                                   @endif disabled>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="efec_rash_nifur" class="col-lg-8 text-left {{--control-label --}}">Presenta
                                            rash cutáneo</label>
                                        <div class="col-lg-4">
                                            <input type="checkbox" class="form-control" id="efec_rash_nifur"
                                                   name="efec_rash_nifur" @if($paciente->efec_rash_nifur == 2) checked
                                                   @endif disabled>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="efec_intgas_nifur"
                                               class="col-lg-8 text-left {{--control-label --}}">Presenta
                                            intolerancia gástrica/digestiva</label>
                                        <div class="col-lg-4">
                                            <input type="checkbox" class="form-control" id="efec_intgas_nifur"
                                                   name="efec_intgas_nifur"
                                                   @if($paciente->efec_intgas_nifur == 2) checked
                                                   @endif disabled>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="efec_afhep_nifur" class="col-lg-8 text-left {{--control-label --}}">Presenta
                                            afectación hepática</label>
                                        <div class="col-lg-4">
                                            <input type="checkbox" class="form-control" id="efec_afhep_nifur"
                                                   name="efec_afhep_nifur" @if($paciente->efec_afhep_nifur == 2) checked
                                                   @endif disabled>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="efec_afneur_nifur"
                                               class="col-lg-8 text-left {{--control-label --}}">Presenta
                                            afectación neurológica</label>
                                        <div class="col-lg-4">
                                            <input type="checkbox" class="form-control" id="efec_afneur_nifur"
                                                   name="efec_afneur_nifur"
                                                   @if($paciente->efec_afneur_nifur == 2) checked
                                                   @endif disabled>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="efec_afhem_nifur" class="col-lg-8 text-left {{--control-label --}}">Presenta
                                            afectación hematológica</label>
                                        <div class="col-lg-4">
                                            <input type="checkbox" class="form-control" id="efec_afhem_nifur"
                                                   name="efec_afhem_nifur" @if($paciente->efec_afhem_nifur == 2) checked
                                                   @endif disabled>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="susp_nifur" class="col-lg-8 text-left {{--control-label --}}">Suspensión
                                            del tratamiento</label>
                                        <div class="col-lg-4">
                                            <input type="checkbox" class="form-control" id="susp_nifur"
                                                   name="susp_nifur" @if($paciente->susp_nifur == 2) checked
                                                   @endif disabled>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="efec_otros_nifur" class="col-lg-8 text-left {{--control-label --}}">Otros
                                            efectos adversos</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control" id="efec_otros_nifur"
                                                   name="efec_otros_nifur" value="{!! $paciente->efec_otros_nifur !!}"
                                                   readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--                        <fieldset class="col-lg-12" style="border: solid 1px black;">
                                                        <legend>Tratamiento con Nifurtimox</legend>

                                                    </fieldset>--}}
                        </div>
                        <div class="col-lg-4">
                            {{--Observaciones Tratamiento Etiológico--}}
                            <div class="panel panel-default">
                                <div class="panel-heading">Otros efectos adversos</div>
                                <div class="panel-body">
                                    {{--         <div class="row">
                                                 <label for="trat_etio_obs" class="col-lg-12 text-left --}}{{--control-label --}}{{--">Otros
                                                     efectos adversos</label>
                                             </div>--}}
                                    <div class="row">
                                <textarea class="form-control" name="trat_etio_obs" id="trat_etio_obs" cols="30"
                                          rows="15" readonly>{!! $paciente->trat_etio_obs !!}</textarea>
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
                                                    <input type="checkbox" class="form-control" id="sin_patologia"
                                                           name="sin_patologia"
                                                           @if($paciente->sin_patologia == 2) checked
                                                           @endif disabled>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="tuberculosis"
                                                       class="col-lg-8 text-left {{--control-label --}}">Tuberculosis</label>
                                                <div class="col-lg-4">
                                                    <input type="checkbox" class="form-control" id="tuberculosis"
                                                           name="tuberculosis" @if($paciente->tuberculosis == 2) checked
                                                           @endif disabled>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="epoc"
                                                       class="col-lg-8 text-left {{--control-label --}}">E.P.O.C.</label>
                                                <div class="col-lg-4">
                                                    <input type="checkbox" class="form-control" id="epoc"
                                                           name="epoc" @if($paciente->epoc == 2) checked
                                                           @endif disabled>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="dbt"
                                                       class="col-lg-8 text-left {{--control-label --}}">Diabetes</label>
                                                <div class="col-lg-4">
                                                    <input type="checkbox" class="form-control" id="dbt"
                                                           name="dbt" @if($paciente->dbt == 2) checked
                                                           @endif disabled>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="asintomatico"
                                                       class="col-lg-8 text-left {{--control-label --}}">Asintomático</label>
                                                <div class="col-lg-4">
                                                    <input type="checkbox" class="form-control" id="asintomatico"
                                                           name="asintomatico" @if($paciente->asintomatico == 2) checked
                                                           @endif disabled>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="palpitaciones"
                                                       class="col-lg-8 text-left {{--control-label --}}">Palpitaciones</label>
                                                <div class="col-lg-4">
                                                    <input type="checkbox" class="form-control" id="palpitaciones"
                                                           name="palpitaciones"
                                                           @if($paciente->palpitaciones == 2) checked
                                                           @endif disabled>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="angor"
                                                       class="col-lg-8 text-left {{--control-label --}}">Angor</label>
                                                <div class="col-lg-4">
                                                    <input type="checkbox" class="form-control" id="angor"
                                                           name="angor" @if($paciente->angor == 2) checked
                                                           @endif disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="row">
                                                <label for="colageno" class="col-lg-8 text-left {{--control-label --}}">Colagenopatías</label>
                                                <div class="col-lg-4">
                                                    <input type="checkbox" class="form-control" id="colageno"
                                                           name="colageno" @if($paciente->colageno == 2) checked
                                                           @endif disabled>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="obesidad" class="col-lg-8 text-left {{--control-label --}}">Obesidad
                                                    mórbida</label>
                                                <div class="col-lg-4">
                                                    <input type="checkbox" class="form-control" id="obesidad"
                                                           name="obesidad" @if($paciente->obesidad == 2) checked
                                                           @endif disabled>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="alcoholismo"
                                                       class="col-lg-8 text-left {{--control-label --}}">Alcoholismo</label>
                                                <div class="col-lg-4">
                                                    <input type="checkbox" class="form-control" id="alcoholismo"
                                                           name="alcoholismo" @if($paciente->alcoholismo == 2) checked
                                                           @endif disabled>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="acv" class="col-lg-8 text-left {{--control-label --}}">Accidente
                                                    Cerebrovascular</label>
                                                <div class="col-lg-4">
                                                    <input type="checkbox" class="form-control" id="acv"
                                                           name="acv" @if($paciente->acv == 2) checked
                                                           @endif disabled>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="disnea"
                                                       class="col-lg-8 text-left {{--control-label --}}">Disnea</label>
                                                <div class="col-lg-4">
                                                    <input type="checkbox" class="form-control" id="disnea"
                                                           name="disnea" @if($paciente->disnea == 2) checked
                                                           @endif disabled>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="disnea1" class="col-lg-8 text-left {{--control-label --}}">Disnea
                                                    Clase Funcional I</label>
                                                <div class="col-lg-4">
                                                    <input type="checkbox" class="form-control" id="disnea1"
                                                           name="disnea1" @if($paciente->disnea1 == 2) checked
                                                           @endif disabled>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="disnea2" class="col-lg-8 text-left {{--control-label --}}">Disnea
                                                    Clase Funcional II</label>
                                                <div class="col-lg-4">
                                                    <input type="checkbox" class="form-control" id="disnea2"
                                                           name="disnea2" @if($paciente->disnea2 == 2) checked
                                                           @endif disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="row">
                                                <label for="disnea3" class="col-lg-8 text-left {{--control-label --}}">Disnea
                                                    Clase Funcional III</label>
                                                <div class="col-lg-4">
                                                    <input type="checkbox" class="form-control" id="disnea3"
                                                           name="disnea3" @if($paciente->disnea3 == 2) checked
                                                           @endif disabled>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="disnea4" class="col-lg-8 text-left {{--control-label --}}">Disnea
                                                    Clase Funcional IV</label>
                                                <div class="col-lg-4">
                                                    <input type="checkbox" class="form-control" id="disnea4"
                                                           name="disnea4" @if($paciente->disnea4 == 2) checked
                                                           @endif disabled>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="hipotiroidismo"
                                                       class="col-lg-8 text-left {{--control-label --}}">Hipotiroidismo</label>
                                                <div class="col-lg-4">
                                                    <input type="checkbox" class="form-control" id="hipotiroidismo"
                                                           name="hipotiroidismo"
                                                           @if($paciente->hipotiroidismo == 2) checked
                                                           @endif disabled>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="hipertiroidismo"
                                                       class="col-lg-8 text-left {{--control-label --}}">Hipertiroidismo</label>
                                                <div class="col-lg-4">
                                                    <input type="checkbox" class="form-control" id="hipertiroidismo"
                                                           name="hipertiroidismo"
                                                           @if($paciente->hipertiroidismo == 2) checked
                                                           @endif disabled>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="cardio_congenitas"
                                                       class="col-lg-8 text-left {{--control-label --}}">Cardiopatías
                                                    congénitas</label>
                                                <div class="col-lg-4">
                                                    <input type="checkbox" class="form-control" id="cardio_congenitas"
                                                           name="cardio_congenitas"
                                                           @if($paciente->cardio_congenitas == 2) checked
                                                           @endif disabled>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="valvulopatias"
                                                       class="col-lg-8 text-left {{--control-label --}}">Valvulopatias</label>
                                                <div class="col-lg-4">
                                                    <input type="checkbox" class="form-control" id="valvulopatias"
                                                           name="valvulopatias"
                                                           @if($paciente->valvulopatias == 2) checked
                                                           @endif disabled>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="mareos"
                                                       class="col-lg-8 text-left {{--control-label --}}">Mareos</label>
                                                <div class="col-lg-4">
                                                    <input type="checkbox" class="form-control" id="mareos"
                                                           name="mareos" @if($paciente->mareos == 2) checked
                                                           @endif disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="row">
                                                <label for="cardio_isquemica"
                                                       class="col-lg-8 text-left {{--control-label --}}">Cardiopatía
                                                    isquémica</label>
                                                <div class="col-lg-4">
                                                    <input type="checkbox" class="form-control" id="cardio_isquemica"
                                                           name="cardio_isquemica"
                                                           @if($paciente->cardio_isquemica == 2) checked
                                                           @endif disabled>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="ht_arterial_leve"
                                                       class="col-lg-8 text-left {{--control-label --}}">Hipertensión
                                                    arterial leve</label>
                                                <div class="col-lg-4">
                                                    <input type="checkbox" class="form-control" id="ht_arterial_leve"
                                                           name="ht_arterial_leve"
                                                           @if($paciente->ht_arterial_leve == 2) checked
                                                           @endif disabled>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="ht_arterial_mode"
                                                       class="col-lg-8 text-left {{--control-label --}}">Hipertensión
                                                    arterial moderada</label>
                                                <div class="col-lg-4">
                                                    <input type="checkbox" class="form-control" id="ht_arterial_mode"
                                                           name="ht_arterial_mode"
                                                           @if($paciente->ht_arterial_mode == 2) checked
                                                           @endif disabled>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="ht_arterial_severa"
                                                       class="col-lg-8 text-left {{--control-label --}}">Hipertensión
                                                    arterial severa</label>
                                                <div class="col-lg-4">
                                                    <input type="checkbox" class="form-control" id="ht_arterial_severa"
                                                           name="ht_arterial_severa"
                                                           @if($paciente->ht_arterial_severa == 2) checked
                                                           @endif disabled>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="perdida_conoc"
                                                       class="col-lg-8 text-left {{--control-label --}}">Pérdida de
                                                    conocimiento</label>
                                                <div class="col-lg-4">
                                                    <input type="checkbox" class="form-control" id="perdida_conoc"
                                                           name="perdida_conoc"
                                                           @if($paciente->perdida_conoc == 2) checked
                                                           @endif disabled>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="insuf_cardiaca"
                                                       class="col-lg-8 text-left {{--control-label --}}">Insuficiencia
                                                    cardíaca</label>
                                                <div class="col-lg-4">
                                                    <input type="checkbox" class="form-control" id="insuf_cardiaca"
                                                           name="insuf_cardiaca"
                                                           @if($paciente->insuf_cardiaca == 2) checked
                                                           @endif disabled>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="tipo_insuf_card"
                                                       class="col-lg-8 text-left {{--control-label --}}">Tipo de
                                                    insuficiencia cardíaca</label>
                                                <div class="col-lg-4">
                                                    <input type="text" class="form-control" id="tipo_insuf_card"
                                                           name="tipo_insuf_card"
                                                           value="{!! $paciente->tipo_insuf_card !!}"
                                                           readonly>
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
                                                  cols="145" rows="2"
                                                  readonly>{!! $paciente->otras_pat_asoc !!}</textarea>
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
                                                   name="otros_sintomas_ing"
                                                   value="{!! $paciente->otros_sintomas_ing !!}"
                                                   readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--                     <fieldset class="col-lg-12" style="border: solid 1px black;">
                                                     <legend>Patologías</legend>

                                                 </fieldset>--}}
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
                                            <input type="text" class="form-control" id="nuevos_sintomas"
                                                   name="nuevos_sintomas"
                                                   value="@if($paciente->nuevos_sintomas=="S") Si @elseif($paciente->nuevos_sintomas=="N") No @else {!! $paciente->nuevos_sintomas !!} @endif"
                                                   readonly>
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
                                                  rows="6" readonly>{!! $paciente->obs_sintomas !!}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--                 <fieldset class="col-lg-12" style="border: solid 1px black;">
                                                 <legend>Nuevos Síntomas</legend>

                                             </fieldset>--}}
                        </div>
                        <div class="col-lg-4">
                            {{--//Columna Serología--}}
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Serología</div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <label for="tres_negativas" class="col-lg-8 control-label">3 pruebas
                                                serológicas
                                                negativas</label>
                                            <div class="col-lg-4">
                                                <input type="checkbox" class="form-control" id="tres_negativas"
                                                       name="tres_negativas" @if($paciente->tres_negativas == 2) checked
                                                       @endif disabled>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="serologia_ing" class="col-lg-8 control-label">Serología al
                                                ingreso</label>
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control" id="serologia_ing"
                                                       name="serologia_ing" value="{!! $paciente->serologia_ing !!}"
                                                       readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="titulos_sero_ing" class="col-lg-8 control-label">Titulos
                                                serológicos
                                                al ingreso</label>
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control" id="titulos_sero_ing"
                                                       name="titulos_sero_ing"
                                                       value="{!! $paciente->titulos_sero_ing !!}"
                                                       readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="trat_etio" class="col-lg-8 control-label">Tratamiento
                                                Etiológico</label>
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control" id="trat_etio" name="trat_etio"
                                                       value="@if($paciente->trat_etio=="S") Si @elseif($paciente->trat_etio=="N") No @endif"
                                                       readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--                                <fieldset style="border: solid 1px black">
                                                                    <legend>Serología</legend>

                                                                </fieldset>--}}
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
                                            <input type="date" class="form-control" id="fecha_rx_torax"
                                                   name="fecha_rx_torax"
                                                   value="@if($paciente->fecha_rx_torax){!! $paciente->fecha_rx_torax->format('d/m/Y') !!}@endif"
                                                   readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="rx_torax"
                                               class="col-lg-8 text-left {{--control-label --}}">Consignación</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control" id="rx_torax"
                                                   name="rx_torax"
                                                   value="{!! $paciente->rx_torax !!}"
                                                   readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="indice_cardiotorax"
                                               class="col-lg-8 text-left {{--control-label --}}">Índice
                                            cardiotorácico</label>
                                        <div class="col-lg-4">
                                            <input type="number" class="form-control" id="indice_cardiotorax"
                                                   name="indice_cardiotorax"
                                                   value="{!! $paciente->indice_cardiotorax !!}"
                                                   readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="obs_rxt"
                                               class="col-lg-3 text-left {{--control-label --}}">Observación</label>
                                        <div class="col-lg-8 col-lg-offset-1">
                                        <textarea class="form-control" name="obs_rxt" id="obs_rxt" cols="30"
                                                  rows="2" readonly>{!! $paciente->obs_rxt !!}</textarea>
                                        </div>
                                    </div>
                                    {{--Cambios--}}
                                    <div class="row">
                                        <label for="cambios_rxt" class="col-lg-8 text-left {{--control-label --}}">Cambios
                                            en la Rx</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control" id="cambios_rxt"
                                                   name="cambios_rxt"
                                                   value="{!! $paciente->cambios_rxt !!}"
                                                   readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="fecha_cambios_rxt"
                                               class="col-lg-8 text-left {{--control-label --}}">Fecha
                                            del cambio</label>
                                        <div class="col-lg-4">
                                            <input type="date" class="form-control" id="fecha_cambios_rxt"
                                                   name="fecha_cambios_rxt"
                                                   value="@if($paciente->fecha_cambios_rxt){!! $paciente->fecha_cambios_rxt->format('d/m/Y') !!}@endif"
                                                   readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="nueva_rxt" class="col-lg-8 text-left {{--control-label --}}">Nueva
                                            Radiografía</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control" id="nueva_rxt"
                                                   name="nueva_rxt"
                                                   value="{!! $paciente->nueva_rxt !!}"
                                                   readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{--                            <fieldset class="col-lg-12" style="border: solid 1px black;">
                                                            <legend>Radiografía</legend>

                                                        </fieldset>--}}
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

                    {{--                  <div class="row">
                                          <div class="col-lg-1">
                                              <label for="evolucion" class="col-lg-8 text-left --}}{{--control-label --}}{{--">Evolución</label>
                                          </div>
                                          <div class="col-lg-11">
                                              <textarea class="form-control" name="evolucion" id="evolucion" cols="145"
                                                        rows="4" readonly>{!! $paciente->evolucion !!}</textarea>
                                          </div>
                                      </div>--}}
                </div>
            </form>
            {{--Botón de expand/collapse--}}
            <a href="javascript:void(0)" id="expand-boton" class="btn btn-primary btn-sm"
               style="border-radius: 50%; padding: 5px 5px;"><i
                        class="material-icons">keyboard_arrow_down</i></a>
        </div>
    </div>
    {{--Sección Principal--}}
    <div class="row">
        <div class="col-lg-3">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Últimos tratamientos</h3>
                        </div>
                        <div class="panel-body" id="pbody-trat">
                            @if ($tratamientos->isEmpty())
                                <p>No hay tratamientos cargados para el paciente.</p>
                            @else
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Droga</th>
                                        <th>Dosis</th>
                                        <th>Fecha</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($tratamientos as $tratamiento)
                                        <tr>
                                            <td>
                                                <a href="{!! action('Panel\PanelHistoriasController@verTratamiento', ['id_p' => $paciente->id, 'id_t' => $tratamiento->id]) !!}"
                                                   target="_blank">{!! $tratamiento->droga !!}</a>
                                            </td>
                                            <td>{!! $tratamiento->dosis !!}</td>
                                            <td>@if($tratamiento->fecha_trat){!! $tratamiento->fecha_trat->format('d/m/Y') !!}@endif</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-centered" style="margin-left: 30px;">
                    <a href="{!! action('Panel\TratamientosController@create', $paciente->id) !!}" class="btn btn-raised btn-success">Agregar nuevo tratamiento</a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-centered" style="margin-left: 30px;">
                    <a href="{!! action('Panel\PanelHistoriasController@verTodosTratamientos', $paciente->id) !!}"
                       data-target="#modal-tratamientos" data-toggle="modal" class="btn btn-raised btn-primary">Ver
                        todos los tratamientos</a>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Consultas
                              <span class="pull-right"><a href="{!! action('Panel\PanelHistoriasController@showConsulta', $paciente->id) !!}"
                                                          class="btn-sm btn-raised btn-success"
                                                          style="text-decoration: none;">Nueva
                                consulta</a></span></h3>
                </div>
                <div class="panel-body" id="pbody-consultas">
                    {{--                    @for($i = 0; $i < 10; $i++)
                                            <div class="well well-lg">
                                                Item de historia clinica {!! $i+1 !!} - (En desarrollo)
                                            </div>
                                        @endfor--}}
                    @foreach($consultas as $consulta)
                        <div class="well well-lg" id={!! "consulta_" . $consulta->id  !!}>
                            <div class="row">
                                <div class="col-lg-8">
                                    <p><strong>Medico: </strong> {!! $consulta->medico->name !!}</p>
                                </div>
                                <div class="col-lg-4">
                                    <p>
                                        <strong>Fecha: </strong>{!! \Carbon\Carbon::parse($consulta->fecha)->format('d/m/Y') !!}
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <p><strong>Titulo: </strong>
                                        <span class="titulo_consulta">{!! $consulta->titulo !!}</span>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <p>
                                        <strong>Descripción: </strong>
                                    </p>
                                    <div class="desc_consulta">{!! $consulta->descripcion !!}</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5 col-lg-offset-7">
                                    @if(Auth::user()->hasRole('Manager'))
                                        <a href="javascript:void(0)"
                                           class="btn btn-sm btn-raised btn-danger btn-borra-consulta"
                                           data-id="{!! $consulta->id !!}" data-target="#modal-consulta-borrar"
                                           data-toggle="modal">Eliminar</a>
                                    @else
                                        <a href="javascript:void(0)" class="btn btn-sm btn-danger" disabled="true">Eliminar</a>
                                    @endif
                                    @if(Auth::user()->name == $consulta->medico->name)
                                        <a class="btn btn-sm btn-raised btn-primary btn-edita-consulta"
                                                href="{!! action('Panel\PanelHistoriasController@editarConsulta', ['id_p' => $paciente->id,'id_c' => $consulta->id]) !!}">
                                            Editar
                                        </a>
                                    @else
                                        <a href="javascript:void(0)" class="btn btn-sm btn-primary" disabled="true">Editar</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Últimos estudios</h3>
                        </div>
                        <div class="panel-body" id="pbody-estudios">
                            @if (!($estudios))
                                <p>No hay estudios cargados para el paciente.</p>
                            @else
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Estudio</th>
                                        <th>Fecha</th>
                                        <th>Titulo</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($estudios as $estudio)
                                        <tr>
                                            <td>
                                                <a href="{!! action('Panel\PanelHistoriasController@verEstudio', ['id_p' => $paciente->id,'id_e' => $estudio->id]) !!}"
                                                   target="_blank">{!! $estudio->nombre !!}</a>
                                            </td>
                                            <td>{!! \Carbon\Carbon::parse($estudio->fecha)->format('d/m/Y') !!}</td>
                                            <td>{!! substr($estudio->titulo, 0, 12) !!}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-centered" style="margin-left: 65px;">
                        <a href="{!! action('Panel\EstudiosController@create', $paciente->id) !!}" class="btn btn-raised btn-success">Agregar nuevo estudio</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-centered" style="margin-left: 65px;">
                        <a href="{!! action('Panel\PanelHistoriasController@verTodosEstudios', $paciente->id) !!}"
                           data-target="#modal-estudios" data-toggle="modal" class="btn btn-raised btn-primary">Ver
                            todos los estudios</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals -->
    <!-- Modal todos los estudios -->
    <div id="modal-estudios" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Todos los estudios</h3>
                        </div>
                        <div class="panel-body" id="pbody-estudios-modal">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal todos los tratamientos -->
    <div id="modal-tratamientos" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Todos los tratamientos</h3>
                        </div>
                        <div class="panel-body" id="pbody-trat-modal">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal nueva consulta -->
    <div id="modal-consulta-nueva" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body" id="limpieza">
                    <div class="well well-lg">
                        <form id="form-nueva-consulta" method="post" action="{{ URL::action('Panel\PanelHistoriasController@nuevaConsulta') }}" class="form-horizontal">
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
                                <button type="submit" class="btn btn-success" id="submitConsulta" style="float: right;">Guardar</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal" style="float: right;">Cancelar</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
                {{--                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-success" data-dismiss="modal">Guardar</button>
                                </div>--}}
            </div>
        </div>
    </div>

    <!-- Modal editar consulta -->
    <div id="modal-consulta-editar" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body" id="limpieza_edit">
                    <div class="well well-lg">
                        <form id="form-editar-consulta" method="post"
                              action="{{ URL::action('Panel\PanelHistoriasController@guardarConsulta') }}"
                              class="form-horizontal">
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

                                <input type="hidden" id="id_paciente_edit" name="id_paciente_edit"
                                       value="{{ $paciente->id }}">
                                <input type="hidden" id="hidden_descripcion_edit" name="hidden_descripcion_edit">
                                <input type="hidden" id="id_consulta_edit" name="id_consulta">

                                <div class="form-group">
                                    <label for="titulo_edit" class="col-lg-2 control-label">Titulo</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="titulo_edit" placeholder="Titulo"
                                               name="titulo_edit" data-validation="required"
                                               data-validation-length="min4">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="editor_descripcion_edit"
                                           class="col-lg-2 control-label">Descripcion</label>
                                    <div class="col-lg-10">
                                        <textarea class="form-control" rows="3" id="editor_descripcion_edit"
                                                  name="descripcion"></textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success" id="submitConsulta_editar"
                                        style="float: right;">Guardar
                                </button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal" style="float: right;">
                                    Cancelar
                                </button>
                            </fieldset>
                        </form>
                    </div>
                </div>
                {{--                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-success" data-dismiss="modal">Guardar</button>
                                </div>--}}
            </div>
        </div>
    </div>

    <!-- Modal eliminar consulta -->
    <div id="modal-consulta-borrar" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Eliminar consulta</h4>
                </div>
                <div class="modal-body">
                    <p>¿Está seguro de eliminar la consulta?</p>
                    <form id="form-borrar-consulta" method="DELETE"
                          action="{{ URL::action('Panel\PanelHistoriasController@borrarConsulta') }}"
                          class="form-horizontal">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                        <input type="hidden" id="id_consulta_borrar" name="id_consulta">
                        <button type="button" class="btn btn-default" style="margin-left: 50%" data-dismiss="modal">
                            Cancelar
                        </button>
                        <button type="submit" id="submitConsulta_borrar" class="btn btn-danger">Aceptar</button>
                    </form>
                </div>
                {{--                <div class="modal-footer">
                                    <button type="submit" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    <button type="button" class="btn btn-inverse btn-danger">Aceptar</button>
                                </div>--}}
            </div>
        </div>
    </div>

    {{--    <script>
            $(document).on('ready',function () {
                $('#modal-consulta-nueva').on('show.bs.modal', function(e){
                    console.log('pase por aca');
                    alert("hola");
                    $('#limpieza').find('form')[0].reset();
                });
            });
        </script>--}}
@endsection