@extends('master')

@include('shared.estilos')

@section('scripts')

<style>

    .static-info span{
        cursor: pointer;

    }

</style>
<script>

    function showHistorial(historial){
        console.log(historial,{{$paciente->id}},1);

        showIframe('{!! action('Panel\PanelHistoriasController@historial') !!}?recurso='+{{$paciente->id}}+'&field='+historial+'&tipo=1 ',2)
    }

function chargeItemAjax(url){
     
    $( "#pbody-trat-modal" ).load(url, function() {
        $("#modal-tratamientos").modal("show")
    });
       

    
}

    $(function () {


         $( "#pbody-estudios" ).load("{!! action('Panel\PanelHistoriasController@verTodosEstudios', $paciente->id) !!}");
         $( "#pbody-trat" ).load("{!! action('Panel\PanelHistoriasController@verTodosTratamientos', $paciente->id) !!}");


        $(".static-info span").hover(function (){
            var field=$(this).data("field");
            if(!!field){
             $(this).attr('onClick','showHistorial("'+field+'")');

             $(this).append(' <i class="fa fa-clock-o historial" onclick="showHistorial(\''+field+'\')" aria-hidden="true"></i>');
         }
     },function (){
        $(".historial").remove();
    });
    })
    



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
                    $content.is(":visible") ? $("#expand-boton").children('i').removeClass("fa-sort-desc").addClass("fa-sort-asc") : $("#expand-boton").children('i').removeClass("fa-sort-asc").addClass("fa-sort-desc");
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

    <script src="{{asset("ckeditor/ckeditor.js")}}"></script>
    <script>
        CKEDITOR.replace('editor_descripcion', {
            customConfig: '{{asset("ckeditor/custom_config.js")}}'
        });
        CKEDITOR.replace('editor_descripcion_edit', {
            customConfig: '{{asset("ckeditor/custom_config.js")}}'
        });

        CKEDITOR.replace('editor_imprimible', {
            customConfig: '{{asset("ckeditor/custom_config_imp.js")}}'
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
                <a href="#">Paciente</a>
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
            <form class="form-horizontal" method="post">

                @foreach ($errors->all() as $error)
                <p class="alert alert-danger">{{ $error }}</p>
                @endforeach

                
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                {{--Cabecera - Siempre visible--}}
                <div id="cabecera" class="col-lg-12">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group">
                                <a href="{!! action('Panel\PanelHistoriasController@edit', $paciente->id) !!}"
                                   class="btn btn-raised btn-success">Editar Historia</a>
                               </div>
                           </div>
                           <div class="col-md-3">
                            <a href="{!! action('Panel\EpidemiologiaController@edit', $paciente->id) !!}" class="btn btn-raised btn-default"
                                >Epidemiología</a>
                            </a>
                        </div>

                        <div class="col-md-3">
                            <div class="btn-group pull-right">
                               <a href="javascript:imprimir()" class="btn btn-raised btn-info pull-right">Versión imprimible</a>
                           </div>
                       </div>
                   </div>

                   <hr/>


                   <div class="row">
                    {{--Columna Documento y Seguimiento--}}
                    <div class="col-lg-12">
                     <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row  ">

                                <div class="col-lg-3">Tipo Documento 
                                    <b class="value">
                                     @if($paciente->tipo_doc =="DNI") Documento Único @endif
                                     @if($paciente->tipo_doc =="LE") Libreta de Enrolamiento @endif
                                     @if($paciente->tipo_doc =="LC") Libreta Cívica @endif
                                     @if($paciente->tipo_doc =="OTRO") Otro @endif
                                 </b>
                             </div>

                             <div class="col-lg-2">Nro. Documento  <b class="value">{!! $paciente->numero_doc !!} </b>
                             </div>
                             <div class="col-lg-2">
                                ¿Vivo?  <b class="value"> @if($paciente->vivo =="S") Si @elseif($paciente->vivo=="N") No @else {!! $paciente->vivo  !!} @endif </b>
                            </div>
                            <div class="col-lg-2">
                                <a type="link"   class="btn btn-raised btn-default" onclick="showIframe('{!! action('Panel\TelefonosController@index', $paciente->id) !!}',1)"> <i class="fa fa-phone" aria-hidden="true"></i> Teléfonos</a>
                            </div>
                            <div class="col-lg-2 ">
                                 <a type="link"   class="btn btn-raised btn-default" onclick="showIframe('{!! action('Panel\DireccionesController@index', $paciente->id) !!}',1)"> <i class="fa fa-map-signs" aria-hidden="true"></i> Direcciones</a>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
             <div class="row">
                <div class="col-lg-12">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                Seguimiento
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="row static-info">
                                <span for="fecha_nac"   class="col-lg-3  ">Fecha Nac.</span>
                                <div class="col-lg-3 value">
                                  @if($paciente->fecha_nac){!! $paciente->fecha_nac->format('d/m/Y') !!}@endif
                              </div>
                              <span for="edad_ing"  class="col-lg-3 ">Edad al
                                ingreso</span>
                                <div class="col-lg-3 value">
                                    @if($paciente->fecha_alta and $paciente->fecha_nac){!! $paciente->fecha_alta->diffInYears($paciente->fecha_nac) !!}@else 0 @endif
                                </div>
                            </div>
                            <div class="row static-info">
                                <span for="fecha_alta" class="col-lg-3  ">Fecha Ing.</span>
                                    <div class="col-lg-3 value">
                                       @if($paciente->fecha_alta){!! $paciente->fecha_alta->format('d/m/Y') !!}@endif
                                   </div>
                                   <span for="anios_seg" class="col-lg-3 ">Años
                                    Seguimiento.</span>
                                    <div class="col-lg-3 value"   data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus.">
                                        @if($paciente->fecha_alta){!! \Carbon\Carbon::now()->diffInYears($paciente->fecha_alta) !!}@endif
                                    </div>
                                </div>
                                <div class="row static-info ">
                                    <span for="fecha_ult_consulta" class="col-lg-3  ">Fecha
                                        Ult.
                                        Consulta</span>
                                        <div class="col-lg-3 value">
                                            @if(!$consultas->isEmpty()){!! \Carbon\Carbon::parse($consultas->max('fecha'))->format('d/m/Y') !!}@elseif($paciente->fecha_ult_consulta){!! $paciente->fecha_ult_consulta->format('d/m/Y') !!}@endif
                                        </div>
                                        <span for="proxima_cita" data-field="proxima_cita" class="col-lg-3  ">Próxima
                                            Cita</span>
                                            <div class="col-lg-3 value">
                                                @if(!$consultas->isEmpty()){!! \Carbon\Carbon::parse($consultas->max('proxima_cita'))->format('d/m/Y') !!}@elseif($paciente->proxima_cita){!! $paciente->proxima_cita->format('d/m/Y') !!}@endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="portlet box blue">
                         <div class="portlet-title">
                            <div class="caption">
                                ECG
                            </div>
                        </div>

                        <div class="portlet-body ">
                            <div class="row static-info">
                                <span for="ecg" data-field="ecg"
                                class="col-lg-8 text-left {{--control-span --}}">Consignación</span>
                                <div class="col-lg-4 value">
                                   @if($paciente->ecg=="N") Normal @elseif($paciente->ecg=="E") Específico @elseif($paciente->ecg == "I") Inespecífico @else {!! $paciente->ecg !!} @endif
                               </div>
                           </div>
                           <div class="row static-info">
                            <span for="tipo_ecg" data-field="tipo_ecg"
                            class="col-lg-8 text-left {{--control-span --}}">Descripción</span>
                            <div class="col-lg-4 value">
                               {!! $paciente->tipo_ecg !!}
                           </div>
                       </div>
                       <div class="row static-info">
                        <span for="nuevos_cambios_ecg" data-field="nuevos_cambios_ecg"
                        class="col-lg-8 text-left {{--control-span --}}">Nuevos
                        cambios</span>
                        <div class="col-lg-4 value">
                          {!! $paciente->nuevos_cambios_ecg !!}
                        </div>
                  </div>
                  <div class="row static-info">
                    <span for="fecha_cambios_ecg" data-field="fecha_cambios_ecg"
                    class="col-lg-8 text-left {{--control-span --}}">Fecha
                    del cambio</span>
                    <div class="col-lg-4 value">
                        @if($paciente->fecha_cambios_ecg){!! $paciente->fecha_cambios_ecg->format('d/m/Y') !!}@endif
                    </div>
                </div>
                <div class="row static-info">
                    <span for="tipo_cambio_ecg" data-field="tipo_cambio_ecg" class="col-lg-8 text-left {{--control-span --}}">Tipo
                        de cambio</span>
                        <div class="col-lg-4 value">
                           {!! $paciente->tipo_cambio_ecg !!}
                       </div>
                   </div>
                   <div class="row static-info">
                    <span for="obs_ecg" data-field="obs_ecg"
                    class="col-lg-8 text-left {{--control-span --}}">Observación</span>
                    <div class="col-lg-9 value">
                        {!! $paciente->obs_ecg !!}
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <div class="col-lg-4">
        {{--//Columna Grupo Clínico--}}
        
        
        <div class="col-lg-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        Grupo Clínico
                    </div>
                </div>
            <div class="portlet-body">
                <div class="row static-info">
                    <span for="grupo_clinico_ing" data-field="grupo_clinico_ing" class="col-lg-8  ">Grupo Clínico
                        al
                        Ingreso</span>
                        <div class="col-lg-4 value">
                           {!! $paciente->grupo_clinico_ing !!}
                       </div>
                   </div>
                   <div class="row static-info">
                    <span for="cambio_grupo_cli" data-field="cambio_grupo_cli" class="col-lg-8 ">Cambio en el
                        Grupo
                        Clínico</span>
                        <div class="col-lg-4 value">
                            @if($paciente->cambio_grupo_cli=="S") Si @elseif($paciente->cambio_grupo_cli=="N") No @endif
                        </div>
                    </div>
                    <div class="row static-info">
                        <span for="fecha_cambio_gcli" data-field="fecha_cambio_gcli" class="col-lg-8 ">Fecha Cambio
                            Grupo
                            Clínico</span>
                            <div class="col-lg-4 value">
                               @if($paciente->fecha_cambio_gcli) {!! $paciente->fecha_cambio_gcli->format('d/m/Y') !!} @endif
                           </div>
                       </div>
                       <div class="row static-info">
                        <span for="nuevo_grupo_cli" data-field="nuevo_grupo_cli" class="col-lg-8 ">Nuevo Grupo
                            Clínico</span>
                            <div class="col-lg-4 value">
                                {!! $paciente->nuevo_grupo_cli !!}
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        @if($paciente->vivo =="N")
        <div class="col-lg-12">
            <div class="row static-info">
                <span for="nuevo_grupo_cli" data-field="nuevo_grupo_cli" class="col-lg-2 ">¿Causa muerte?</span>
                <div class="col-lg-10 value">
                    {!! $paciente->causa_muerte !!}
                </div>
            </div>
        </div>
        @endif 
    </div>
</div>
{{--Detalles - Se ocultan y solo se muestran cuando el usuario decide--}}
<div id="detalles">
    <div class="row">
        <div class="col-lg-4">
            {{--Nuevo--}}
            <div class="portlet box blue">
             <div class="portlet-title">
                <div class="caption">
                    Seguimiento
                </div>
            </div>

            <div class="portlet-body">
                <div class="row static-info">
                    <span for="trat_bnz" data-field="trat_bnz" class="col-lg-8 text-left {{--control-span --}}">Tratamiento
                        con Benznidazol</span>
                        <div class="col-lg-4 value">
                            @if($paciente->trat_bnz == 2) SI @else NO @endif
                        </div>
                    </div>
                    <div class="row static-info">
                        <span for="fecha_ini_trat_bnz" data-field="fecha_ini_trat_bnz" 
                        class="col-lg-8 text-left {{--control-span --}}">Fecha
                        Inicio Tratamiento</span>
                        <div class="col-lg-4 value">
                          @if($paciente->fecha_ini_trat_bnz){!! $paciente->fecha_ini_trat_bnz->format('d/m/Y') !!}@endif
                      </div>
                  </div>
                  <div class="row static-info">
                    <span for="efectos_adv_bnz"  data-field="efectos_adv_bnz"  class="col-lg-8 text-left {{--control-span --}}">Efectos
                        Adversos</span>
                        <div class="col-lg-4 value">
                            @if($paciente->efectos_adv_bnz == 2) SI @else NO @endif
                        </div>
                    </div>
                    <div class="row static-info">
                        <span for="efec_rash_bnz"  data-field="efec_rash_bnz"  class="col-lg-8 text-left {{--control-span --}}">Presenta
                            rash cutáneo</span>
                            <div class="col-lg-4 value">
                              @if($paciente->efec_rash_bnz == 2) SI @else NO @endif
                          </div>
                      </div>
                      <div class="row static-info">
                        <span for="efec_intgas_bnz" data-field="efec_intgas_bnz" class="col-lg-8 text-left {{--control-span --}}">Presenta
                            intolerancia gástrica/digestiva</span>
                            <div class="col-lg-4 value">
                              @if($paciente->efec_intgas_bnz == 2) SI @else NO
                              @endif
                          </div>
                      </div>
                      <div class="row static-info">
                        <span for="efec_afhep_bnz" data-field="efec_afhep_bnz" class="col-lg-8 text-left {{--control-span --}}">Presenta
                            afectación hepática</span>
                            <div class="col-lg-4 value">
                              @if($paciente->efec_afhep_bnz == 2) SI @else NO  @endif
                          </div>
                      </div>
                      <div class="row static-info">
                        <span for="efec_afneur_bnz" data-field="efec_afneur_bnz"  class="col-lg-8 text-left {{--control-span --}}">Presenta
                            afectación neurológica</span>
                            <div class="col-lg-4 value">
                               @if($paciente->efec_afneur_bnz == 2) SI @else NO @endif
                           </div>
                       </div>
                       <div class="row static-info">
                        <span for="efec_afhem_bnz" data-field="efec_afhem_bnz" class="col-lg-8 text-left {{--control-span --}}">Presenta
                            afectación hematológica</span>
                            <div class="col-lg-4 value">
                                @if($paciente->efec_afhem_bnz == 2) SI @else NO @endif
                            </div>
                        </div>
                        <div class="row static-info">
                            <span for="susp_bnz" data-field="susp_bnz" class="col-lg-8 text-left {{--control-span --}}">Suspensión
                                del tratamiento</span>
                                <div class="col-lg-4 value">
                                 @if($paciente->susp_bnz == 2) SI @else NO  @endif
                             </div>
                         </div>
                         <div class="row static-info">
                            <span for="efec_otros_bnz" data-field="efec_otros_bnz" class="col-lg-8 text-left {{--control-span --}}">Otros
                                efectos adversos</span>
                                <div class="col-lg-4 value">
                                    {!! $paciente->efec_otros_bnz !!}
                                </div>
                            </div>
                        </div> 
                        {{--Fin Nuevo--}}
                    </div>
                    
                </div>
                <div class="col-lg-4">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                Tratamiento con Nifurtimox
                            </div>
                        </div>

                        <div class="portlet-body">
                            <div class="row static-info">
                                <span for="trat_nifur" data-field="trat_nifur" class="col-lg-8 text-left {{--control-span --}}">Tratamiento
                                    con Nifurtimox</span>
                                    <div class="col-lg-4 value">
                                        @if($paciente->trat_nifur == 2) SI @else NO @endif
                                    </div>
                                </div>
                                <div class="row static-info">
                                    <span for="fecha_ini_trat_nifur" data-field="fecha_ini_trat_nifur"
                                    class="col-lg-8 text-left {{--control-span --}}">Fecha
                                    Inicio Tratamiento</span>
                                    <div class="col-lg-4 value">
                                       @if($paciente->fecha_ini_trat_nifur){!! $paciente->fecha_ini_trat_nifur->format('d/m/Y') !!}@endif
                                   </div>
                               </div>
                               <div class="row static-info">
                                <span for="efectos_adv_nifur" data-field="efectos_adv_nifur"
                                class="col-lg-8 text-left {{--control-span --}}">Efectos
                                Adversos</span>
                                <div class="col-lg-4 value">
                                    @if($paciente->efectos_adv_nifur == 2) SI @else NO @endif
                                </div>
                            </div>
                            <div class="row static-info">
                                <span for="efec_rash_nifur" data-field="efec_rash_nifur" class="col-lg-8 text-left {{--control-span --}}">Presenta
                                    rash cutáneo</span>
                                    <div class="col-lg-4 value">
                                        @if($paciente->efec_rash_nifur == 2) SI @else NO
                                        @endif
                                    </div>
                                </div>
                                <div class="row static-info">
                                    <span for="efec_intgas_nifur" data-field="efec_intgas_nifur"
                                    class="col-lg-8 text-left {{--control-span --}}">Presenta
                                    intolerancia gástrica/digestiva</span>
                                    <div class="col-lg-4 value">
                                      @if($paciente->efec_intgas_nifur == 2) SI @else NO
                                      @endif
                                  </div>
                              </div>
                              <div class="row static-info">
                                <span for="efec_afhep_nifur" data-field="efec_afhep_nifur" class="col-lg-8 text-left {{--control-span --}}">Presenta
                                    afectación hepática</span>
                                    <div class="col-lg-4 value">
                                     @if($paciente->efec_afhep_nifur == 2) SI @else NO
                                     @endif
                                 </div>
                             </div>
                             <div class="row static-info">
                                <span for="efec_afneur_nifur" data-field="efec_afneur_nifur"
                                class="col-lg-8 text-left {{--control-span --}}">Presenta
                                afectación neurológica</span>
                                <div class="col-lg-4 value">
                                   @if($paciente->efec_afneur_nifur == 2) SI @else NO
                                   @endif
                               </div>
                           </div>
                           <div class="row static-info">
                            <span for="efec_afhem_nifur" data-field="efec_afhem_nifur" class="col-lg-8 text-left {{--control-span --}}">Presenta
                                afectación hematológica</span>
                                <div class="col-lg-4 value">
                                 @if($paciente->efec_afhem_nifur == 2) SI @else NO
                                 @endif
                             </div>
                         </div>
                         <div class="row static-info">
                            <span for="susp_nifur" data-field="susp_nifur" class="col-lg-8 text-left {{--control-span --}}">Suspensión
                                del tratamiento</span>
                                <div class="col-lg-4 value">
                                    @if($paciente->susp_nifur == 2) SI @else NO
                                    @endif
                                </div>
                            </div>
                            <div class="row static-info">
                                <span for="efec_otros_nifur"  data-field="efec_otros_nifur" class="col-lg-8 text-left {{--control-span --}}">Otros
                                    efectos adversos</span>
                                    <div class="col-lg-4 value">
                                       {!! $paciente->efec_otros_nifur !!}
                                   </div>
                               </div>
                           </div>
                       </div>

                   </div>
                   <div class="col-lg-4">
                    {{--Observaciones Tratamiento Etiológico--}}
                    <div class="portlet box blue">

                        <div class="portlet-title">
                            <div class="caption">
                                Otros efectos adverso
                            </div>
                        </div>

                        <div class="portlet-body">

                            <div class="row static-info">
                                <div class="col-lg-12">
                                    <span for="trat_etio_obs"  data-field="trat_etio_obs" class="col-lg-8 text-left {{--control-span --}}">Otros
                                        efectos adversos</span>
                                        <br><br>

                                        <textarea class="form-control" name="trat_etio_obs" id="trat_etio_obs" cols="30"
                                        rows="15" readonly></textarea>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption">
                                    Patologías
                                </div>
                            </div>

                            <div class="portlet-body">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="row static-info">
                                            <span for="sin_patologia"  data-field="sin_patologia"
                                            class="col-lg-8 text-left {{--control-span --}}">Paciente sin
                                            patología asociada</span>
                                            <div class="col-lg-4 value">
                                             @if($paciente->sin_patologia == 2) SI @else NO
                                             @endif
                                         </div>
                                     </div>
                                     <div class="row static-info">
                                        <span for="tuberculosis" data-field="tuberculosis"
                                        class="col-lg-8 text-left {{--control-span --}}">Tuberculosis</span>
                                        <div class="col-lg-4 value">
                                          @if($paciente->tuberculosis == 2) SI @else NO
                                          @endif
                                      </div>
                                  </div>
                                  <div class="row static-info">
                                    <span for="epoc" data-field="epoc"
                                    class="col-lg-8 text-left {{--control-span --}}">E.P.O.C.</span>
                                    <div class="col-lg-4 value">
                                        @if($paciente->epoc == 2) SI @else NO
                                        @endif
                                    </div>
                                </div>
                                <div class="row static-info">
                                    <span for="dbt" data-field="dbt"
                                    class="col-lg-8 text-left {{--control-span --}}">Diabetes</span>
                                    <div class="col-lg-4 value">
                                        @if($paciente->dbt == 2) SI @else NO
                                        @endif
                                    </div>
                                </div>
                                <div class="row static-info">
                                    <span for="asintomatico"  data-field="asintomatico"
                                    class="col-lg-8 text-left {{--control-span --}}">Asintomático</span>
                                    <div class="col-lg-4 value">
                                        @if($paciente->asintomatico == 2) SI @else NO
                                        @endif
                                    </div>
                                </div>
                                <div class="row static-info">
                                    <span for="palpitaciones" data-field="palpitaciones"
                                    class="col-lg-8 text-left {{--control-span --}}">Palpitaciones</span>
                                    <div class="col-lg-4 value">
                                     @if($paciente->palpitaciones == 2) SI @else NO
                                     @endif
                                 </div>
                             </div>
                             <div class="row static-info">
                                <span for="angor" data-field="angor"
                                class="col-lg-8 text-left {{--control-span --}}">Angor</span>
                                <div class="col-lg-4 value">
                                    @if($paciente->angor == 2) SI @else NO  
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="row static-info">
                                <span for="colageno" data-field="colageno" class="col-lg-8 text-left {{--control-span --}}">Colagenopatías</span>
                                <div class="col-lg-4 value">
                                  @if($paciente->colageno == 2) SI @else NO
                                  @endif
                              </div>
                          </div>
                          <div class="row static-info">
                            <span for="obesidad" data-field="obesidad" class="col-lg-8 text-left {{--control-span --}}">Obesidad
                                mórbida</span>
                                <div class="col-lg-4 value">
                                   @if($paciente->obesidad == 2) SI @else NO
                                   @endif
                               </div>
                           </div>
                           <div class="row static-info">
                            <span for="alcoholismo" data-field="alcoholismo" 
                            class="col-lg-8 text-left {{--control-span --}}">Alcoholismo</span>
                            <div class="col-lg-4 value">
                                @if($paciente->alcoholismo == 2) SI @else NO 
                                @endif
                            </div>
                        </div>
                        <div class="row static-info">
                            <span for="acv" data-field="acv"  class="col-lg-8 text-left {{--control-span --}}">Accidente
                                Cerebrovascular</span>
                                <div class="col-lg-4 value">
                                    @if($paciente->acv == 2) SI @else NO
                                    @endif
                                </div>
                            </div>
                            <div class="row static-info">
                                <span for="disnea" data-field="disnea"
                                class="col-lg-8 text-left {{--control-span --}}">Disnea</span>
                                <div class="col-lg-4 value">
                                    @if($paciente->disnea == 2) SI @else NO
                                    @endif
                                </div>
                            </div>
                            <div class="row static-info">
                                <span for="disnea1" data-field="disnea1" class="col-lg-8 text-left {{--control-span --}}">Disnea
                                    Clase Funcional I</span>
                                    <div class="col-lg-4 value">
                                       @if($paciente->disnea1 == 2) SI @else NO
                                       @endif
                                   </div>
                               </div>
                               <div class="row static-info">
                                <span for="disnea2" data-field="disnea2"  class="col-lg-8 text-left {{--control-span --}}">Disnea
                                    Clase Funcional II</span>
                                    <div class="col-lg-4 value">
                                        @if($paciente->disnea2 == 2) SI @else NO
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="row static-info">
                                    <span for="disnea3" data-field="disnea3"  class="col-lg-8 text-left {{--control-span --}}">Disnea
                                        Clase Funcional III</span>
                                        <div class="col-lg-4 value">
                                            @if($paciente->disnea3 == 2) SI @else NO
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row static-info">
                                        <span for="disnea4" data-field="disnea4" class="col-lg-8 text-left {{--control-span --}}">Disnea
                                            Clase Funcional IV</span>
                                            <div class="col-lg-4 value">
                                             @if($paciente->disnea4 == 2) SI @else NO
                                             @endif
                                         </div>
                                     </div>
                                     <div class="row static-info">
                                        <span for="hipotiroidismo" data-field="hipotiroidismo" 
                                        class="col-lg-8 text-left {{--control-span --}}">Hipotiroidismo</span>
                                        <div class="col-lg-4 value">
                                           @if($paciente->hipotiroidismo == 2) SI @else NO
                                           @endif
                                       </div>
                                   </div>
                                   <div class="row static-info">
                                    <span for="hipertiroidismo" data-field="hipertiroidismo"
                                    class="col-lg-8 text-left {{--control-span --}}">Hipertiroidismo</span>
                                    <div class="col-lg-4 value">
                                        @if($paciente->hipertiroidismo == 2) SI @else NO
                                        @endif
                                    </div>
                                </div>
                                <div class="row static-info">
                                    <span for="cardio_congenitas" data-field="cardio_congenitas"
                                    class="col-lg-8 text-left {{--control-span --}}">Cardiopatías
                                    congénitas</span>
                                    <div class="col-lg-4 value">
                                     @if($paciente->cardio_congenitas == 2) SI @else NO
                                     @endif
                                 </div>
                             </div>
                             <div class="row static-info">
                                <span for="valvulopatias" data-field="valvulopatias"
                                class="col-lg-8 text-left {{--control-span --}}">Valvulopatias</span>
                                <div class="col-lg-4 value">
                                    @if($paciente->valvulopatias == 2) SI @else NO
                                    @endif 
                                </div>
                            </div>
                            <div class="row static-info">
                                <span for="mareos" data-field="mareos"
                                class="col-lg-8 text-left {{--control-span --}}">Mareos</span>
                                <div class="col-lg-4 value">
                                    @if($paciente->mareos == 2) SI @else NO
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="row static-info">
                                <span for="cardio_isquemica" data-field="cardio_isquemica"
                                class="col-lg-8 text-left {{--control-span --}}">Cardiopatía
                                isquémica</span>
                                <div class="col-lg-4 value">
                                    @if($paciente->cardio_isquemica == 2) SI @else NO 
                                    @endif 
                                </div>
                            </div>
                            <div class="row static-info">
                                <span for="ht_arterial_leve" data-field="ht_arterial_leve"
                                class="col-lg-8 text-left {{--control-span --}}">Hipertensión
                                arterial leve</span>
                                <div class="col-lg-4 value">
                                  @if($paciente->ht_arterial_leve == 2) SI @else NO
                                  @endif
                              </div>
                          </div>
                          <div class="row static-info">
                            <span for="ht_arterial_mode"  data-field="ht_arterial_mode"
                            class="col-lg-8 text-left {{--control-span --}}">Hipertensión
                            arterial moderada</span>
                            <div class="col-lg-4 value">
                             @if($paciente->ht_arterial_mode == 2) SI @else NO
                             @endif
                         </div>
                     </div>
                     <div class="row static-info">
                        <span for="ht_arterial_severa" data-field="ht_arterial_severa"
                        class="col-lg-8 text-left {{--control-span --}}">Hipertensión
                        arterial severa</span>
                        <div class="col-lg-4 value">
                            @if($paciente->ht_arterial_severa == 2) SI @else NO
                            @endif
                        </div>
                    </div>
                    <div class="row static-info">
                        <span for="perdida_conoc" data-field="perdida_conoc"
                        class="col-lg-8 text-left {{--control-span --}}">Pérdida de
                        conocimiento</span>
                        <div class="col-lg-4 value">
                           @if($paciente->perdida_conoc == 2) SI @else NO
                           @endif
                       </div>
                   </div>
                   <div class="row static-info">
                        <span for="insuf_cardiaca" data-field="insuf_cardiaca"
                    class="col-lg-8 text-left {{--control-span --}}">Insuficiencia
                    cardíaca</span>
                    <div class="col-lg-4 value">
                       @if($paciente->insuf_cardiaca == 2) SI @else NO
                       @endif
                   </div>
               </div>
               <div class="row static-info">
                <span for="tipo_insuf_card"  data-field="tipo_insuf_card"
                class="col-lg-8 text-left {{--control-span --}}">Tipo de
                insuficiencia cardíaca</span>
                <div class="col-lg-4 value">
                   {!! $paciente->tipo_insuf_card !!}
               </div>
           </div>
       </div>
   </div>
   <hr/>
   <div class="row static-info">
    <div class="col-lg-3">
        <span for="otras_pat_asoc"  data-field="otras_pat_asoc"
        class="col-lg-8 text-left {{--control-span --}}">Otras
        patologías</span>
    </div>
    <div class="col-lg-9">
        <textarea class="form-control" name="otras_pat_asoc" id="otras_pat_asoc"
        cols="145" rows="2"
        readonly>{!! $paciente->otras_pat_asoc !!}</textarea>
    </div>
</div>
<div class="row static-info">
    <div class="col-lg-3">
        <span for="otros_sintomas_ing" data-field="otros_sintomas_ing"
        class="col-lg-8 text-left {{--control-span --}}">Otros síntomas al
        ingreso</span>
    </div>
    <div class="col-lg-9">
        <textarea class="form-control" name="otros_sintomas_ing" id="otros_sintomas_ing"
        cols="145" rows="2"
        readonly>{!! $paciente->otros_sintomas_ing !!}</textarea>

        
    </div>
</div>
</div>
</div>

</div>
</div>
<div class="row">
    <div class="col-lg-4">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    Nuevos Síntomas
                </div>
            </div>

            <div class="portlet-body">
                <div class="row static-info">
                    <span for="nuevos_sintomas" data-field="nuevos_sintomas"
                    class="col-lg-8 text-left {{--control-span --}}">¿Hubo nuevos
                    síntomas?</span>
                    <div class="col-lg-4 value">
                       @if($paciente->nuevos_sintomas=="S") Si @elseif($paciente->nuevos_sintomas=="N") No @else {!! $paciente->nuevos_sintomas !!} @endif
                   </div>
               </div>
               <div class="row static-info">
                <div class="col-lg-12">
                    <span for="obs_sintomas" data-field="obs_sintomas"
                    class="col-lg-8 text-left {{--control-span --}}">Observaciones</span>
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
    
</div>
<div class="col-lg-4">
    {{--//Columna Serología--}}
    <div class="col-lg-12">
        <div class="portlet box blue">
         <div class="portlet-title">
            <div class="caption">
                Serología
            </div>
        </div>

        <div class="portlet-body">
            <div class="row static-info">
                <span for="tres_negativas" data-field="tres_negativas" class="col-lg-8 control-span">3 pruebas
                    serológicas
                    negativas</span>
                    <div class="col-lg-4 value">
                        @if($paciente->tres_negativas == 2) SI @else NO
                        @endif
                    </div>
                </div>
                <div class="row static-info">
                    <span for="serologia_ing"  data-field="serologia_ing"  class="col-lg-8 control-span">Serología al
                        ingreso</span>
                        <div class="col-lg-4 value">
                            {!! $paciente->serologia_ing !!}
                        </div>
                    </div>
                    <div class="row static-info">
                        <span for="titulos_sero_ing" data-field="titulos_sero_ing" class="col-lg-8 control-span">Titulos
                            serológicos
                            al ingreso</span>
                            <div class="col-lg-4 value">
                                {!! $paciente->titulos_sero_ing !!}
                            </div>
                        </div>
                        <div class="row static-info">
                            <span for="trat_etio" data-field="trat_etio" class="col-lg-8 control-span">Tratamiento
                                Etiológico</span>
                                <div class="col-lg-4 value">
                                    @if($paciente->trat_etio=="S") Si @elseif($paciente->trat_etio=="N") No @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="col-lg-4">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            Radiografía
                        </div>
                    </div>

                    <div class="portlet-body">
                        <div class="row static-info">
                            <span for="fecha_rx_torax" data-field="fecha_rx_torax" class="col-lg-8 text-left {{--control-span --}}">Fecha
                                de Radiografía de Tórax</span>
                                <div class="col-lg-4 value">
                                   @if($paciente->fecha_rx_torax){!! $paciente->fecha_rx_torax->format('d/m/Y') !!}@endif
                               </div>
                           </div>
                           <div class="row static-info">
                            <span for="rx_torax" data-field="rx_torax"
                            class="col-lg-8 text-left {{--control-span --}}">Consignación</span>
                            <div class="col-lg-4 value">
                                {!! $paciente->rx_torax !!}
                            </div>
                        </div>
                        <div class="row static-info">
                            <span for="indice_cardiotorax" data-field="indice_cardiotorax"
                            class="col-lg-8 text-left {{--control-span --}}">Índice
                            cardiotorácico</span>
                            <div class="col-lg-4 value">
                               {!! $paciente->indice_cardiotorax !!}
                           </div>
                       </div>
                       <div class="row static-info">
                        <span for="obs_rxt"  data-field="obs_rxt"
                        class="col-lg-3 text-left {{--control-span --}}">Observación</span>
                        <div class="col-lg-8 col-lg-offset-1 value">
                            <textarea class="form-control" name="obs_rxt" id="obs_rxt" cols="30"
                            rows="2" readonly>{!! $paciente->obs_rxt !!}</textarea>
                        </div>
                    </div>
                    {{--Cambios--}}
                    <div class="row static-info">
                        <span for="cambios_rxt" data-field="cambios_rxt" class="col-lg-8 text-left {{--control-span --}}">Cambios
                            en la Rx</span>
                            <div class="col-lg-4 value">
                                {!! $paciente->cambios_rxt !!}
                            </div>
                        </div>
                        <div class="row static-info">
                            <span for="fecha_cambios_rxt" data-field="fecha_cambios_rxt" 
                            class="col-lg-8 text-left {{--control-span --}}">Fecha
                            del cambio</span>
                            <div class="col-lg-4 value">
                               @if($paciente->fecha_cambios_rxt){!! $paciente->fecha_cambios_rxt->format('d/m/Y') !!}@endif
                           </div>
                       </div>
                       <div class="row static-info">
                        <span for="nueva_rxt" data-field="nueva_rxt"  class="col-lg-8 text-left {{--control-span --}}">Nueva
                            Radiografía</span>
                            <div class="col-lg-4 value">
                               {!! $paciente->nueva_rxt !!}
                           </div>
                       </div>
                   </div>
               </div>


           </div>
       </div>
       <div class="portlet box blue">
         <div class="portlet-title">
            <div class="caption">
                Evolución
            </div>
        </div>
        <div class="portlet-body">
            <div class="row static-info">
                <div class="col-lg-12">
                    <span for="evolucion" data-field="evolucion"  class="col-lg-8 text-left {{--control-span --}}">Evolución</span>
                    <br><br>
                    <textarea class="form-control" name="evolucion" id="evolucion" cols="145"
                    rows="4" readonly>{!! $paciente->evolucion !!}</textarea>
                </div>
            </div>
        </div>
    </div>


</div>
</form>
{{--Botón de expand/collapse--}}
<a href="javascript:void(0)" id="expand-boton" class="btn btn-primary btn-lg"
style="border-radius: 50%; padding: 5px 5px;    bottom: -20px;"><i class="fa fa-sort-desc" aria-hidden="true"></i>
</a>
</div>
</div>
{{--Sección Principal--}}
<div class="row">
    <div class="col-lg-6">
        <div class="row">
            <div class="col-lg-12">
                <div class="portlet box blue">

                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-cogs"></i>Últimos tratamientos
                        </div>
                        <div class="actions">
                            <a href="{!! action('Panel\TratamientosController@create', $paciente->id) !!}" class="btn btn-raised btn-success"> Agregar nuevo tratamiento <i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                      
                           </div>
                       </div>


                       <div class="portlet-body" id="pbody-trat">
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
                                        <button type="link" class="btn btn-link" onclick="showIframe('{!! action('Panel\PanelHistoriasController@verTratamiento', ['id_p' => $paciente->id, 'id_t' => $tratamiento->id]) !!}',1)"> {!! $tratamiento->droga !!}</button>
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
        
    </div>
    
    <div class="col-lg-6">
        <div class="row">
            <div class="col-lg-12">
                <div class="portlet box blue">


                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-cogs"></i>Últimos estudios
                        </div>
                        <div class="actions">
                            <a href="{!! action('Panel\EstudiosController@create', $paciente->id) !!}" class="btn btn-raised btn-success">Agregar nuevo estudios <i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                        

                           </div>
                       </div>

                       <div class="portlet-body" id="pbody-estudios">

                         

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

                                        <button type="link" class="btn btn-link" onclick="showIframe( '{!! action('Panel\PanelHistoriasController@verEstudio', ['id_p' => $paciente->id,'id_e' => $estudio->id]) !!}',1)"> {!! $estudio->nombre !!}</button>

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
            
        </div>
    </div>

    <div class="col-lg-12">
        <div class="portlet box blue" id="consultas">

            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>Consultas
                </div>
                <div class="actions">
                    <a href="{!! action('Panel\PanelHistoriasController@showConsulta', $paciente->id) !!}" class="btn-sm btn-raised btn-success"  style="text-decoration: none;">Nueva consulta</a>
                </div>
            </div>


            <div class="portlet-body" id="pbody-consultas" style="background: #e5e5e5;">
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
                        <div class="col-lg-6">
                        @if($consulta->sintomas->count())
                            <p>
                                <strong>Sintomas detectados: </strong>
                            </p>
                            <ul>
                                @foreach($consulta->sintomas as $sintoma)
                                <li>{!! $sintoma->nombre !!}</li>
                                @endforeach
                            </ul>
                            @endif
                        </div>
                        <div class="col-lg-6">
                            @if($consulta->patologias->count())

                            <p>
                                <strong>Patologías detectadas: </strong>
                            </p>
                            <ul>
                                @foreach($consulta->patologias as $patologia)
                                <li>{!! $patologia->nombre !!}</li>
                                @endforeach
                            </ul>
                            @endif
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
                    <div class="panel-body" id="pbody-estudios-modals">

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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Resultado</h3>
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
                                <span for="medico" class="col-lg-2 control-span"
                                style="padding-top:0;">Médico</span>
                                <p id="medico" name="medico">
                                    @if(Auth::check())
                                    {{ Auth::user()->name }}
                                    @endif
                                </p>

                            </div>

                            <input type="hidden" id="id_paciente" name="id_paciente" value="{{ $paciente->id }}">
                            <input type="hidden" id="hidden_descripcion" name="hidden_descripcion">

                            <div class="form-group">
                                <span for="title" class="col-lg-2 control-span">Titulo</span>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="titulo" placeholder="Titulo"
                                    name="titulo" data-validation="required" data-validation-length="min4">
                                </div>
                            </div>
                            <div class="form-group">
                                <span for="content" class="col-lg-2 control-span">Descripcion</span>
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
            
        </div>
    </div>
</div>


<!-- Modal editar consulta -->
<div id="formularioImprimir" class="modal fade bs-example-modal-lg" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-body" id="limpieza_edit">
                <div class="row">
                    <div class="col-xs-12">
                        <button class="btn btn-danger pull-right" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true" ></i></button>
                    </div>
                    <br><br>
                </div>
                <textarea id="editor_imprimible">
                    <p style="text-align:right">San Mart&iacute;n, {!! \Carbon\Carbon::now()->format('j F \d\e Y ') !!}</p>

                    <p>Resumen de Historia Cl&iacute;nica ambulatoria</p>

                    <p>Consultorio de Enfermedad de Chagas</p>
                    @if(count(Auth::user()->sedes) != 0)
                    <p>{{Auth::user()->sedes[0]->nombre }}</p>
                    @endif
                    @if(count(Auth::user()->sedes) == 0)
                     <p>~~SEDE DEL HOSPITAL~~</p>
                    @endif
                    <p> {!! $paciente->apellido . "," . $paciente->nombre !!}</p>

                    <p>{!! $paciente->tipo_doc !!} {!! $paciente->numero_doc !!}</p>

                    <p>Paciente de @if($paciente->fecha_alta and $paciente->fecha_nac){!!  \Carbon\Carbon::now()->diffInYears($paciente->fecha_nac) !!} @endif a&ntilde;os de edad con diagn&oacute;stico de enfermedad de Chagas con {!! $paciente->serologia_ing !!} pruebas serol&oacute;gicas reactivas @if($paciente->cardio_isquemica == 2) con @else sin @endif  manifestaciones de cardiopat&iacute;a.</p>

                    <p>@if(array_key_exists("descripcion",$consultas)) {{ strip_tags($consultas[0]->descripcion) }}@endif  
                     @if(array_key_exists("sintomas",$consultas)), con s&iacute;ntomas actuales: @else Sin s&iacute;ntomas actuales. @endif  

                     @if(array_key_exists("sintomas",$consultas)) @foreach($consultas[0]->sintomas as $sintoma) {!! $sintoma->nombre !!}, @endforeach @endif  
                 </p>


                 @if (($estudios)) 
                 @foreach($estudios as $estudio)
                 <p>{!! $estudio->nombre !!}   {!! \Carbon\Carbon::parse($estudio->fecha)->format('j F \d\e Y ') !!} {!! $estudio->descripcion !!}</p>
                 @endforeach
                 @endif

                 @if ($tratamientos->isEmpty())
                 @else
                 <p>El tratamiento actual es: </p>

                 @foreach($tratamientos as $tratamiento)
                 <p>{!! $tratamiento->droga !!} {!! $tratamiento->dosis !!} en @if($tratamiento->fecha_trat){!! $tratamiento->fecha_trat->format('d/m/Y') !!} @endif  @if($tratamiento->obs_trat) {!! $tratamiento->obs_trat !!} @endif
                 </p>
                 @endforeach
                 @endif

                 <p>Contin&uacute;a en control, seguimiento y tratamiento en nuestro servicio.</p>
             </textarea>
            </div>

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
                                <span for="medico" class="col-lg-2 control-span"
                                style="padding-top:0;">Médico</span>
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
                                <span for="titulo_edit" class="col-lg-2 control-span">Titulo</span>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="titulo_edit" placeholder="Titulo"
                                    name="titulo_edit" data-validation="required"
                                    data-validation-length="min4">
                                </div>
                            </div>
                            <div class="form-group">
                                <span for="editor_descripcion_edit"
                                class="col-lg-2 control-span">Descripcion</span>
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
        </div>
    </div>
</div>

<div id="modalIframe" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="row">
                <div class="col-xs-12">
                    <button class="btn btn-danger pull-right" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true" ></i></button>
                </div>
            </div>
            <iframe src="" id="iframeid" style="width: 100%;border: 0px"></iframe>
        </div>
    </div>
</div>
<script>

    function imprimir(){
        $("#formularioImprimir").modal('show');
    }
    function showIframe(url, type){
        if(type==1){
            $("#iframeid").css("height","90%");
        }else{
            $("#iframeid").css("height","50%");
        }
        $("#iframeid").attr("src",url);
        $('#modalIframe').modal('show');
    }
</script>
@endsection
