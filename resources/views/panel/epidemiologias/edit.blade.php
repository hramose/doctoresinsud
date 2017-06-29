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
<script>
   function volvioReciente (valor){
                if(valor=="S"){
                    console.log(valor)
                   $("#volvio_reciente_ende_anos_container").show();
               }else{
                   $("#volvio_reciente_ende_anos_container").hide();
               }
           }
</script>
<script src="{{url('/')."/js/vue.js"}}"></script>
<style>
    
    .hover-row:hover{
        background: #F1F1F1
    }

    .hover-row{
        padding-top: 10px
    }
</style>
<script>
   function volvioAArea(valor){
       console.log(valor);
       if(valor=="S"){
   
           $("#s2id_places").show();
       }else{
         $("#s2id_places").hide();  
       }
   }


function noButtonCheck(checked,checksi,container,nosabe){
    var checksi=$(checksi);
    var labelsi=$(labelsi);
    var nosabe=$(nosabe);
    if(!checked) {
        $(container).show();
        checksi.prop('checked', true);
        checksi.closest("label").addClass("active")

    }else{
        $(container).hide();
        checksi.prop('checked', false);
        checksi.closest("label").removeClass("active")
        nosabe.prop('checked', false);
        nosabe.closest("label").removeClass("active")
    }
}

function siButtonCheck(checked,checkno,container,nosabe){
    var checkno=$(checkno);
    var labelno=$(labelno);
    var nosabe=$(nosabe);
    if(checked) {
        $(container).show();
        checkno.prop('checked', false);
        checkno.closest("label").removeClass("active")
     
       if(nosabe.is(':checked')){
           nosabe.prop('checked', false);
           nosabe.closest("label").removeClass("active")
       }

    }else{
        $(container).hide();
        checkno.prop('checked', true);
        checkno.closest("label").addClass("active")

    }
}
function noSabeCheck(checked,checkno,container,checksi){
    var checkno=$(checkno);
    var labelno=$(labelno);
    var checksi=$(checksi);

    if(checked){
        $(container).show();
        checkno.prop('checked', false);
        checkno.closest("label").removeClass("active")
        checksi.prop('checked', false);
        checksi.closest("label").removeClass("active")
    }else{
        $(container).hide();
        checksi.prop('checked', true);
        checksi.closest("label").addClass("active")
    }
}

   $("#antefam_muerte_sub_no").change(function() {
        noButtonCheck(this.checked,'#antefam_muerte_sub_si',"#container_muerte_subita","#antefam_muerte_sub_ns");
    });

   $("#antefam_muerte_sub_si").change(function() {
        console.log("aqui"+this.checked)

        siButtonCheck(this.checked,'#antefam_muerte_sub_no',"#container_muerte_subita","#antefam_muerte_sub_ns");
    });

   $("#antefam_muerte_sub_ns").change(function() {
        noSabeCheck(this.checked,'#antefam_muerte_sub_no',"#container_muerte_subita","#antefam_muerte_sub_si");
    });




    $("#antefam_afcardi_no").change(function() {
        noButtonCheck(this.checked,'#antefam_afcardi_si',"#container_afeccion_cardiaca","#antefam_afcardi_ns");
    });

   $("#antefam_afcardi_si").change(function() {
        siButtonCheck(this.checked,'#antefam_afcardi_no',"#container_afeccion_cardiaca","#antefam_afcardi_ns");
    });

   $("#antefam_afcardi_ns").change(function() {
        noSabeCheck(this.checked,'#antefam_afcardi_no',"#container_afeccion_cardiaca","#antefam_afcardi_si");
    });




    $("#antefam_chagas_no").change(function() {
        noButtonCheck(this.checked,'#antefam_chagas_si',"#container_chagas","#antefam_chagas_ns");
    });

   $("#antefam_chagas_si").change(function() {
    console.log("aqui")
        siButtonCheck(this.checked,'#antefam_chagas_no',"#container_chagas","#antefam_chagas_ns");
    });

   $("#antefam_chagas_ns").change(function() {
        noSabeCheck(this.checked,'#antefam_chagas_no',"#container_chagas","#antefam_chagas_si");
    });


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
<h3 class="page-title">Historia Clínica
   de <b>{!! $paciente->apellido . ", " . $paciente->nombre . " (H.C.:" . $paciente->id_hc . ")"!!}</b>  
</h3>
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
         <a href="{!! action('Panel\PanelHistoriasController@edit', $paciente->id) !!}">Editar</a>
         <i class="fa fa-angle-right"></i>
      </li>
      <li>
         <a href="#">Epidemiología</a>
      </li>
   </ul>
</div>
<div class="portlet box grey-cascade" >
   <div class="portlet-title">
      <div class="actions btn-set">
         <a href="{{ action('Panel\PanelHistoriasController@verHistoria', $paciente->id) }}" type="button" name="back" class="btn default"><i class="fa fa-angle-left"></i> Atras</a>
      </div>
   </div>
   <div class="portlet-body">
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
         <div class="row">
            <div class="col-lg-4">
               <div class="btn-group btn-group-justified btn-group-raised">
                  <label for="submit-guardar" class="btn btn-raised btn-success">Guardar Datos</label>
               </div>
            </div>
         </div>
         <hr/>
         {{--Primera sección--}}
         <div class="row">
            <div class="col-lg-5">
               <div class="row">
                  <div class="col-lg-12">
                     {{--Datos Personales--}}
                     <div class="portlet box blue">
                        <div class="portlet-title">
                           <div class="caption"> Datos Personales </div>
                        </div>
                        <div class="portlet-body">
                           <div class=" ">
                              <div class="form-group">
                                 <label for="sexo"
                                    class="col-lg-1 text-left">Sexo</label>
                                 <div class="col-lg-4">
                                    <select class="form-control" id="sexo" name="sexo">
                                       <option value=""></option>
                                       <option value="M" @if(old('sexo',$paciente->epidemiologia->sexo)=="M") selected @endif>Masculino</option>
                                       <option value="F" @if(old('sexo',$paciente->epidemiologia->sexo)=="F") selected @endif>Femenino</option>
                                    </select>
                                 </div>
                                 <label for="estado_civil"
                                    class="col-lg-3 text-left padding-0">Estado Civil</label>
                                 <div class="col-lg-4">
                                    <select class="form-control" id="estado_civil" name="estado_civil">
                                       <option value=""></option>
                                       <option value="S" @if($paciente->epidemiologia->estado_civil=="S") selected @endif>Soltero</option>
                                       <option value="C" @if($paciente->epidemiologia->estado_civil=="C") selected @endif>Casado</option>
                                       <option value="J" @if($paciente->epidemiologia->estado_civil=="J") selected @endif>Concubino</option>
                                       <option value="V" @if($paciente->epidemiologia->estado_civil=="V") selected @endif>Viudo</option>
                                       <option value="D" @if($paciente->epidemiologia->estado_civil=="D") selected @endif>Divorciado</option>
                                       {{--Opción dejada para conservar datos históricos no categorizados--}}
                                       @if(! in_array($paciente->epidemiologia->estado_civil, array("S", "C", "J", "V", "D", "")))
                                       <option value="{!! $paciente->epidemiologia->estado_civil!!}" selected>{!! $paciente->epidemiologia->estado_civil !!}</option>
                                       @endif
                                    </select>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-7">
               <div class="row">
                  <div class="col-lg-12">
                     {{--Lugar de Nacimiento--}}
                     <div class="portlet box blue">
                        <div class="portlet-title">
                           <div class="caption"> Lugar de Nacimiento </div>
                        </div>
                        <div class="portlet-body">
                           <div class="row">
                              <div class="col-xs-4">
                                 <div class="form-group ">
                                    <label for="localidad_nac" style="vertical-align: bottom;"
                                       class="col-lg-5 text-left">Localidad</label>
                                    <div class="col-lg-7">
                                       <input type="text" class="form-control" id="localidad_nac" name="localidad_nac" value="{!! old('localidad_nac', $paciente->epidemiologia->localidad_nac) !!}">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-xs-4">
                                 <div class="form-group ">
                                    <label for="provincia_nac"
                                       class="col-lg-4 text-left">Provincia</label>
                                    <div class="col-lg-8">
                                       <input type="text" class="form-control" id="provincia_nac" name="provincia_nac" value="{!! old('provincia_nac', $paciente->epidemiologia->provincia_nac) !!}">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-xs-4">
                                 <div class="form-group ">
                                    <label for="pais_nac"
                                       class="col-lg-4 text-left">País</label>
                                    <div class="col-lg-8">
                                       <input type="text" class="form-control" id="pais_nac" name="pais_nac" value="{!! old('pais_nac', $paciente->epidemiologia->pais_nac) !!}">
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-xs-12">
               {{--Datos Endémicos--}}
               <div class="portlet box blue">
                  <div class="portlet-title">
                     <div class="caption"> Datos Endémicos </div>
                  </div>
                  <div class="portlet-body">
                     <div class="row hover-row">
                        <div class="col-xs-4">
                           <div class="form-group ">
                              <label for="lugar_nac_urbanizado"
                                 class="col-lg-8 text-left">¿Lugar de nacimiento urbanizado?</label>
                              <div class="col-lg-4">
                                 <select class="form-control" id="lugar_nac_urbanizado" name="lugar_nac_urbanizado">
                                    <option value=""></option>
                                    <option value="R" @if($paciente->epidemiologia->lugar_nac_urbanizado=="R") selected @endif>Rural</option>
                                    <option value="U" @if($paciente->epidemiologia->lugar_nac_urbanizado=="U") selected @endif>Urbano</option>
                                    <option value="?" @if($paciente->epidemiologia->lugar_nac_urbanizado=="?") selected @endif>No se sabe</option>
                                    @if(! in_array($paciente->epidemiologia->lugar_nac_urbanizado, array("R", "U", "?", "")))
                                    <option value="{!! $paciente->epidemiologia->lugar_nac_urbanizado!!}" selected>{!! $paciente->epidemiologia->lugar_nac_urbanizado !!}</option>
                                    @endif
                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="col-xs-4">
                           <div class="form-group ">
                              <label for="tipo_vivienda_nac"
                                 class="col-lg-7 text-left">Tipo de vivienda donde nació</label>
                              <div class="col-lg-5">
                                 <select class="form-control" id="tipo_vivienda_nac" name="tipo_vivienda_nac">
                                    <option value=""></option>
                                    <option value="P" @if($paciente->epidemiologia->tipo_vivienda_nac=="P") selected @endif>Precario</option>
                                    <option value="M" @if($paciente->epidemiologia->tipo_vivienda_nac=="M") selected @endif>Material</option>
                                    <option value="?" @if($paciente->epidemiologia->tipo_vivienda_nac=="?") selected @endif>No se sabe</option>
                                    @if(! in_array($paciente->epidemiologia->tipo_vivienda_nac, array("P", "M", "?", "")))
                                    <option value="{!! $paciente->epidemiologia->tipo_vivienda_nac!!}" selected>{!! $paciente->epidemiologia->tipo_vivienda_nac !!}</option>
                                    @endif
                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="col-xs-4">
                           <div class="form-group ">
                              <label for="anios_area_endemica"
                                 class="col-lg-8 text-left">Años de residencia en área endémica</label>
                              <div class="col-lg-4">
                                 <input type="number" class="form-control" id="anios_area_endemica" name="anios_area_endemica" value="{!! old('anios_area_endemica', $paciente->epidemiologia->anios_area_endemica) !!}">
                              </div>
                           </div>
                        </div>
                        </div>
                        <div class="row hover-row">
                        <div class="col-xs-4">
                           <div class="form-group">
                              <label for="tipo_residencia_ende"
                                 class="col-lg-7 text-left">Tipo de residencia en área endémica</label>
                              <div class="col-lg-5">
                                 <select class="form-control" id="tipo_residencia_ende" name="tipo_residencia_ende">
                                    <option value=""></option>
                                    <option value="02" @if($paciente->epidemiologia->tipo_residencia_ende=="02") selected @endif>Permanente</option>
                                    <option value="01" @if($paciente->epidemiologia->tipo_residencia_ende=="01") selected @endif>Aislada</option>
                                    <option value="00" @if($paciente->epidemiologia->tipo_residencia_ende=="00") selected @endif>No residió</option>
                                    <option value="?" @if($paciente->epidemiologia->tipo_residencia_ende=="?") selected @endif>No se sabe</option>
                                    @if(! in_array($paciente->epidemiologia->tipo_residencia_ende, array("02", "01", "01", "?", "")))
                                    <option value="{!! $paciente->epidemiologia->tipo_residencia_ende!!}" selected>{!! $paciente->epidemiologia->tipo_residencia_ende !!}</option>
                                    @endif
                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="col-xs-3">
                           <div class="form-group ">
                              <label for="volvio_area_ende"
                                 class="col-lg-8 text-left">¿Volvió a área endémica?</label>
                              <div class="col-lg-4">
                                 <select class="form-control" id="volvio_area_ende" s onchange="volvioAArea(this.value)" name="volvio_area_ende">
                                    <option value=""></option>
                                    <option value="S" @if($paciente->epidemiologia->volvio_area_ende=="S") selected @endif>Si</option>
                                    <option value="N" @if($paciente->epidemiologia->volvio_area_ende=="N") selected @endif>No</option>
                                    <option value="?" @if($paciente->epidemiologia->volvio_area_ende=="?") selected @endif>No se sabe</option>
                                    @if(! in_array($paciente->epidemiologia->volvio_area_ende, array("S", "N", "?", "")))
                                    <option value="{!! $paciente->epidemiologia->volvio_area_ende!!}" selected>{!! $paciente->epidemiologia->volvio_area_ende !!}</option>
                                    @endif
                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="col-xs-5">
                           <div class="form-group">
                              <label for="volvio_area_ende"
                                 class="col-lg-8 text-left">Areas a las que volvio el paciente</label>
                              <div class="col-lg-12">
                                 @if($paciente->epidemiologia->volvio_area_ende=="N")
                                 {!! Form::select('places[]',$places, $selectedPlaces, ['id' => 'places', 'multiple' => 'multiple','class'=>'selectTags form-control','style'=>'display:none']) !!}
                                 @else
                                 {!! Form::select('places[]',$places, $selectedPlaces, ['id' => 'places', 'multiple' => 'multiple','class'=>'selectTags form-control']) !!}
                                 @endif
                              </div>
                           </div>
                        </div>
                        </div>
                        <div class="row hover-row">
                        <div class="col-xs-4">
                           <div class="form-group">
                              <label for="volvio_reciente_ende"
                                 class="col-lg-6 text-left">¿Volvió recientemente?</label>
                              <div class="col-lg-6">
                                 <select class="form-control" onchange="volvioReciente(this.value)" id="volvio_reciente_ende" name="volvio_reciente_ende">
                                    <option value=""></option>
                                    <option value="S" @if($paciente->epidemiologia->volvio_reciente_ende=="S") selected @endif>Si</option>
                                    <option value="N" @if($paciente->epidemiologia->volvio_reciente_ende=="N") selected @endif>No</option>
                                    <option value="?" @if($paciente->epidemiologia->volvio_reciente_ende=="?") selected @endif>No se sabe</option>
                                    @if(! in_array($paciente->epidemiologia->volvio_reciente_ende, array("S", "N", "?", "")))
                                    <option value="{!! $paciente->epidemiologia->volvio_reciente_ende!!}" selected>{!! $paciente->epidemiologia->volvio_reciente_ende !!}</option>
                                    @endif
                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="col-xs-4">
                           <div class="form-group " id="volvio_reciente_ende_anos_container">
                              <label for="fecha_cuando_volvio_ende" class="col-lg-8 text-left">¿Cuándo volvió a área endémica?</label>
                              <div class="col-lg-4">
                                 <input type="text" class="form-control datepicker" id="fecha_cuando_volvio_ende"
                                    name="fecha_cuando_volvio_ende"
                                    value="@if($paciente->epidemiologia->fecha_cuando_volvio_ende){!! old('fecha_cuando_volvio_ende',$paciente->epidemiologia->fecha_cuando_volvio_ende->format('d/m/Y')) !!}@endif">
                              </div>
                           </div>
                        </div>
                        <div class="col-xs-4">
                           <div class="form-group">
                              <label for="otras_areas_ende"
                                 class="col-lg-5 text-left">¿Otras áreas?</label>
                              <div class="col-lg-7">
                                 <select class="form-control" id="otras_areas_ende" name="otras_areas_ende">
                                    <option value=""></option>
                                    <option value="S" @if($paciente->epidemiologia->otras_areas_ende=="S") selected @endif>Si</option>
                                    <option value="N" @if($paciente->epidemiologia->otras_areas_ende=="N") selected @endif>No</option>
                                    <option value="?" @if($paciente->epidemiologia->otras_areas_ende=="?") selected @endif>No se sabe</option>
                                    @if(! in_array($paciente->epidemiologia->otras_areas_ende, array("S", "N", "?", "")))
                                    <option value="{!! $paciente->epidemiologia->otras_areas_ende!!}" selected>{!! $paciente->epidemiologia->otras_areas_ende !!}</option>
                                    @endif
                                 </select>
                              </div>
                           </div>
                        </div>
                        </div>
                        <div class="row hover-row">
                        <div class="col-xs-6">
                           <div class="form-group ">
                              <label for="otras_areas_ende_lugar" style="vertical-align: bottom;"
                                 class="col-lg-5 text-left">¿Cuáles otras áreas?</label>
                              <div class="col-lg-7">
                                 <input type="text" class="form-control" id="otras_areas_ende_lugar" name="otras_areas_ende_lugar" value="{!! old('otras_areas_ende_lugar', $paciente->epidemiologia->otras_areas_ende_lugar) !!}">
                              </div>
                           </div>
                        </div>
                        <div class="col-xs-6">
                           <div class="form-group ">
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
            </div>
         </div>
         <div class="row">

            <div class="col-xs-12">
                <div class="portlet box blue">
                        <div class="portlet-title">
                           <div class="caption"> Servicios </div>
                        </div>
                        <div class="portlet-body">
                        <div class="row">
                            
                        
                        <div class="col-xs-3">
                           <div class="form-group">
                              <label for="agua"
                                 class="col-lg-4 text-left">Agua</label>
                              <div class="col-lg-8">
                                 <select class="form-control" id="agua" name="agua">
                                    <option value=""></option>
                                    <option value="A" @if($paciente->epidemiologia->agua=="A") selected @endif>Agua corriente</option>
                                    <option value="B" @if($paciente->epidemiologia->agua=="B") selected @endif>Bomba</option>
                                    <option value="P" @if($paciente->epidemiologia->agua=="P") selected @endif>Pozo</option>
                                    <option value="?" @if($paciente->epidemiologia->agua=="?") selected @endif>No se sabe</option>
                                    @if(! in_array($paciente->epidemiologia->agua, array("A", "B", "P", "?", "")))
                                    <option value="{!! $paciente->epidemiologia->agua!!}" selected>{!! $paciente->epidemiologia->agua !!}</option>
                                    @endif
                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="col-xs-5">
                            
                           <div class="form-group">
                              <label for="canieria"
                                 class="col-lg-8 text-left">¿Tiene cañería dentro de la vivienda?</label>
                              <div class="col-lg-4">
                                 <select class="form-control" id="canieria" name="canieria">
                                    <option value=""></option>
                                    <option value="S" @if($paciente->epidemiologia->canieria=="S") selected @endif>Si</option>
                                    <option value="N" @if($paciente->epidemiologia->canieria=="N") selected @endif>No</option>
                                    <option value="?" @if($paciente->epidemiologia->canieria=="?") selected @endif>No se sabe</option>
                                    @if(! in_array($paciente->epidemiologia->canieria, array("N", "S", "?", "")))
                                    <option value="{!! $paciente->epidemiologia->canieria!!}" selected>{!! $paciente->epidemiologia->canieria !!}</option>
                                    @endif
                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="form-group">
                              <label for="sanitario"
                                 class="col-lg-8 text-left">¿Tiene sanitario dentro de la vivienda?</label>
                              <div class="col-lg-4">
                                 <select class="form-control" id="sanitario" name="sanitario">
                                    <option value=""></option>
                                    <option value="S" @if($paciente->epidemiologia->sanitario=="S") selected @endif>Si</option>
                                    <option value="N" @if($paciente->epidemiologia->sanitario=="N") selected @endif>No</option>
                                    <option value="?" @if($paciente->epidemiologia->sanitario=="?") selected @endif>No se sabe</option>
                                    @if(! in_array($paciente->epidemiologia->sanitario, array("N", "S", "?", "")))
                                    <option value="{!! $paciente->epidemiologia->sanitario!!}" selected>{!! $paciente->epidemiologia->sanitario !!}</option>
                                    @endif
                                 </select>
                              </div>
                           </div>
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
               <div class="portlet box green-meadow">
                  <div class="portlet-title">
                     <div class="caption"> Antecedentes Familiares </div>
                  </div>
                  <div class="portlet-body">

                  <div class="row hover-row">
                    <div class="col-xs-2">
                        <label>Muerte Súbita</label>
                    </div>
                      <div class="col-xs-3">
                        <div class="btn-group" data-toggle="buttons"> 
                          <label class="btn btn-primary  @if($paciente->epidemiologia->antefam_muerte_sub_si=="2") active @endif">
 
                            {!! Form::checkbox('antefam_muerte_sub_si', old('antefam_muerte_sub_si'), in_array(old('antefam_muerte_sub_si', $paciente->epidemiologia->antefam_muerte_sub_si), array('on', 2)) ?  true : false, ['class'=>' ', 'id'=>'antefam_muerte_sub_si']) !!} Si

                          </label>
                            <label id="label_antefam_muerte_sub_no" class="btn btn-primary  @if($paciente->epidemiologia->antefam_muerte_sub_no=="2") active  @endif">
                           {!! Form::checkbox('antefam_muerte_sub_no', old('antefam_muerte_sub_no'), in_array(old('antefam_muerte_sub_no', $paciente->epidemiologia->antefam_muerte_sub_no), array('on', 2)) ?  true : false, ['class'=>' ', 'id'=>'antefam_muerte_sub_no']) !!} No
                          </label>
                            <label id="label_antefam_muerte_sub_ns" class="btn btn-primary  @if($paciente->epidemiologia->antefam_muerte_sub_ns=="2") active  @endif">
                            {!! Form::checkbox('antefam_muerte_sub_ns', old('antefam_muerte_sub_ns'), in_array(old('antefam_muerte_sub_ns', $paciente->epidemiologia->antefam_muerte_sub_ns), array('on', 2)) ?  true : false, ['class'=>' ', 'id'=>'antefam_muerte_sub_ns']) !!} No sabe
                          </label>
                        </div>
                      </div>
                      <div class="col-xs-7"  id="container_muerte_subita" @if($paciente->epidemiologia->antefam_muerte_sub_no=="2") style="display:none" @endif>
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default  @if($paciente->epidemiologia->antefam_muerte_sub_padre=="2") active  @endif">
                                {!! Form::checkbox('antefam_muerte_sub_padre', old('antefam_muerte_sub_padre'), in_array(old('antefam_muerte_sub_padre', $paciente->epidemiologia->antefam_muerte_sub_padre), array('on', 2)) ?  true : false, ['class'=>' ', 'id'=>'antefam_muerte_sub_padre']) !!} 
                                Padre
                            </label>
                           
                            <label class="btn btn-default  @if($paciente->epidemiologia->antefam_muerte_sub_madre=="2") active @endif">
                               {!! Form::checkbox('antefam_muerte_sub_madre', old('antefam_muerte_sub_madre'), in_array(old('antefam_muerte_sub_madre', $paciente->epidemiologia->antefam_muerte_sub_madre), array('on', 2)) ?  true : false, ['class'=>' ', 'id'=>'antefam_muerte_sub_madre']) !!}
                                Madre
                            </label>

                            <label class="btn btn-default  @if($paciente->epidemiologia->antefam_muerte_sub_hermano=="2") active @endif">
                               {!! Form::checkbox('antefam_muerte_sub_hermano', old('antefam_muerte_sub_hermano'), in_array(old('antefam_muerte_sub_hermano', $paciente->epidemiologia->antefam_muerte_sub_hermano), array('on', 2)) ?  true : false, ['class'=>' ', 'id'=>'antefam_muerte_sub_hermano']) !!}
                                Hermano
                            </label>

                            <label class="btn btn-default  @if($paciente->epidemiologia->antefam_muerte_sub_hijo=="2") active  @endif">
                               {!! Form::checkbox('antefam_muerte_sub_hijo', old('antefam_muerte_sub_hijo'), in_array(old('antefam_muerte_sub_hijo', $paciente->epidemiologia->antefam_muerte_sub_hijo), array('on', 2)) ?  true : false, ['class'=>' ', 'id'=>'antefam_muerte_sub_hijo']) !!}
                                Hijo
                            </label>

                            <label class="btn btn-default  @if($paciente->epidemiologia->antefam_muerte_sub_otros=="2") active @endif">
                               {!! Form::checkbox('antefam_muerte_sub_otros', old('antefam_muerte_sub_otros'), in_array(old('antefam_muerte_sub_otros', $paciente->epidemiologia->antefam_muerte_sub_otros), array('on', 2)) ?  true : false, ['class'=>' ', 'id'=>'antefam_muerte_sub_otros']) !!}
                                Otro familiar
                            </label>

                            <label class="btn btn-default  @if($paciente->epidemiologia->antefam_muerte_sub_desc=="2") active @endif">
                               {!! Form::checkbox('antefam_muerte_sub_desc', old('antefam_muerte_sub_desc'), in_array(old('antefam_muerte_sub_desc', $paciente->epidemiologia->antefam_muerte_sub_desc), array('on', 2)) ?  true : false, ['class'=>' ', 'id'=>'antefam_muerte_sub_desc']) !!}
                                Desconocido
                            </label>
                        </div>
                      </div>
                  </div>


                <div class="row hover-row">
                    <div class="col-xs-2">
                        <label>Afección Cardíaca</label>
                    </div>
                      <div class="col-xs-3">
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-primary  @if($paciente->epidemiologia->antefam_afcardi_si=="2") active @endif">
 
                            {!! Form::checkbox('antefam_afcardi_si', old('antefam_afcardi_si'), in_array(old('antefam_afcardi_si', $paciente->epidemiologia->antefam_afcardi_si), array('on', 2)) ?  true : false, ['class'=>' ', 'id'=>'antefam_afcardi_si']) !!} Si

                          </label>
                            <label class="btn btn-primary  @if($paciente->epidemiologia->antefam_afcardi_no=="2") active @endif">
                            {!! Form::checkbox('antefam_afcardi_no', old('antefam_afcardi_no'), in_array(old('antefam_afcardi_no', $paciente->epidemiologia->antefam_afcardi_no), array('on', 2)) ?  true : false, ['class'=>' ', 'id'=>'antefam_afcardi_no']) !!} No
                          </label>
                          <label class="btn btn-primary  @if($paciente->epidemiologia->antefam_afcardi_ns=="2") active @endif">
                             {!! Form::checkbox('antefam_afcardi_ns', old('antefam_afcardi_ns'), in_array(old('antefam_afcardi_ns', $paciente->epidemiologia->antefam_afcardi_ns), array('on', 2)) ?  true : false, ['class'=>' ', 'id'=>'antefam_afcardi_ns']) !!} No sabe
                          </label>
                        </div>
                      </div>
                      <div class="col-xs-7"  id="container_afeccion_cardiaca" @if($paciente->epidemiologia->antefam_afcardi_no=="2") style="display:none" @endif >
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default  @if($paciente->epidemiologia->antefam_afcardi_padre=="2") active  @endif">
                                {!! Form::checkbox('antefam_afcardi_padre', old('antefam_afcardi_padre'), in_array(old('antefam_afcardi_padre', $paciente->epidemiologia->antefam_afcardi_padre), array('on', 2)) ?  true : false, ['class'=>' ', 'id'=>'antefam_afcardi_padre']) !!}
                                Padre
                            </label>
                           
                            <label class="btn btn-default  @if($paciente->epidemiologia->antefam_afcardi_madre=="2") active @endif">
                               {!! Form::checkbox('antefam_afcardi_madre', old('antefam_afcardi_madre'), in_array(old('antefam_afcardi_madre', $paciente->epidemiologia->antefam_afcardi_madre), array('on', 2)) ?  true : false, ['class'=>' ', 'id'=>'antefam_afcardi_madre']) !!}
                                Madre
                            </label>

                            <label class="btn btn-default  @if($paciente->epidemiologia->antefam_afcardi_hermano=="2") active @endif">
                               {!! Form::checkbox('antefam_afcardi_hermano', old('antefam_afcardi_hermano'), in_array(old('antefam_afcardi_hermano', $paciente->epidemiologia->antefam_afcardi_hermano), array('on', 2)) ?  true : false, ['class'=>' ', 'id'=>'antefam_afcardi_hermano']) !!}
                                Hermano
                            </label>

                            <label class="btn btn-default  @if($paciente->epidemiologia->antefam_afcardi_hijo=="2") active  @endif">
                               {!! Form::checkbox('antefam_afcardi_hijo', old('antefam_afcardi_hijo'), in_array(old('antefam_afcardi_hijo', $paciente->epidemiologia->antefam_afcardi_hijo), array('on', 2)) ?  true : false, ['class'=>' ', 'id'=>'antefam_afcardi_hijo']) !!}
                                Hijo
                            </label>

                            <label class="btn btn-default  @if($paciente->epidemiologia->antefam_afcardi_otros=="2") active @endif">
                               {!! Form::checkbox('antefam_afcardi_otros', old('antefam_afcardi_otros'), in_array(old('antefam_afcardi_otros', $paciente->epidemiologia->antefam_afcardi_otros), array('on', 2)) ?  true : false, ['class'=>' ', 'id'=>'antefam_afcardi_otros']) !!}
                                Otro familiar
                            </label>

                            <label class="btn btn-default  @if($paciente->epidemiologia->antefam_afcardi_desc=="2") active @endif">
                               {!! Form::checkbox('antefam_afcardi_desc', old('antefam_afcardi_desc'), in_array(old('antefam_afcardi_desc', $paciente->epidemiologia->antefam_afcardi_desc), array('on', 2)) ?  true : false, ['class'=>' ', 'id'=>'antefam_afcardi_desc']) !!}
                                Desconocido
                            </label>
                        </div>
                      </div>
                  </div>


                <div class="row hover-row">
                    <div class="col-xs-2">
                        <label>Chagas</label>
                    </div>
                      <div class="col-xs-3">
                        <div class="btn-group" data-toggle="buttons">
                          <label class="btn btn-primary @if($paciente->epidemiologia->antefam_chagas_si=="2") active @endif">
                            {!! Form::checkbox('antefam_chagas_si', old('antefam_chagas_si'), in_array(old('antefam_chagas_si', $paciente->epidemiologia->antefam_chagas_si), array('on', 2)) ?  true : false, ['class'=>' ', 'id'=>'antefam_chagas_si']) !!} Si
                          </label>
                          <label class="btn btn-primary @if($paciente->epidemiologia->antefam_chagas_no=="2") active @endif">
                            {!! Form::checkbox('antefam_chagas_no', old('antefam_chagas_no'), in_array(old('antefam_chagas_no', $paciente->epidemiologia->antefam_chagas_no), array('on', 2)) ?  true : false, ['class'=>' ', 'id'=>'antefam_chagas_no']) !!} No
                          </label>
                          <label class="btn btn-primary @if($paciente->epidemiologia->antefam_chagas_ns=="2") active @endif" >
                            {!! Form::checkbox('antefam_chagas_ns', old('antefam_chagas_ns'), in_array(old('antefam_chagas_ns', $paciente->epidemiologia->antefam_chagas_ns), array('on', 2)) ?  true : false, ['class'=>' ', 'id'=>'antefam_chagas_ns']) !!} No sabe
                          </label>
                        </div>
                      </div>
                      <div class="col-xs-7"  id="container_chagas" @if($paciente->epidemiologia->antefam_chagas_no=="2") style="display:none" @endif >
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default  @if($paciente->epidemiologia->antefam_chagas_madre=="2") active  @endif">
                                {!! Form::checkbox('antefam_chagas_padre', old('antefam_chagas_padre'), in_array(old('antefam_chagas_padre', $paciente->epidemiologia->antefam_chagas_madre), array('on', 2)) ?  true : false, ['class'=>' ', 'id'=>'antefam_chagas_padre']) !!}
                                Padre
                            </label>
                           
                            <label class="btn btn-default  @if($paciente->epidemiologia->antefam_chagas_madre=="2") active @endif">
                               {!! Form::checkbox('antefam_chagas_madre', old('antefam_chagas_madre'), in_array(old('antefam_chagas_madre', $paciente->epidemiologia->antefam_chagas_madre), array('on', 2)) ?  true : false, ['class'=>' ', 'id'=>'antefam_chagas_madre']) !!}
                                Madre
                            </label>

                            <label class="btn btn-default  @if($paciente->epidemiologia->antefam_chagas_hermano=="2") active @endif">
                               {!! Form::checkbox('antefam_chagas_hermano', old('antefam_chagas_hermano'), in_array(old('antefam_chagas_hermano', $paciente->epidemiologia->antefam_chagas_hermano), array('on', 2)) ?  true : false, ['class'=>' ', 'id'=>'antefam_chagas_hermano']) !!}
                                Hermano
                            </label>

                            <label class="btn btn-default  @if($paciente->epidemiologia->antefam_chagas_hijo=="2") active  @endif">
                               {!! Form::checkbox('antefam_chagas_hijo', old('antefam_chagas_hijo'), in_array(old('antefam_chagas_hijo', $paciente->epidemiologia->antefam_chagas_hijo), array('on', 2)) ?  true : false, ['class'=>' ', 'id'=>'antefam_chagas_hijo']) !!}
                                Hijo
                            </label>

                            <label class="btn btn-default  @if($paciente->epidemiologia->antefam_chagas_otros=="2") active @endif">
                               {!! Form::checkbox('antefam_chagas_otros', old('antefam_chagas_otros'), in_array(old('antefam_chagas_otros', $paciente->epidemiologia->antefam_chagas_otros), array('on', 2)) ?  true : false, ['class'=>' ', 'id'=>'antefam_chagas_otros']) !!}
                                Otro familiar
                            </label>

                            <label class="btn btn-default  @if($paciente->epidemiologia->antefam_chagas_desc=="2") active @endif">
                               {!! Form::checkbox('antefam_chagas_desc', old('antefam_chagas_desc'), in_array(old('antefam_chagas_desc', $paciente->epidemiologia->antefam_chagas_desc), array('on', 2)) ?  true : false, ['class'=>' ', 'id'=>'antefam_chagas_desc']) !!}
                                Desconocido
                            </label>
                        </div>
                      </div>
                  </div>
 
                     <hr/>
                     <div class="row">
                        <div class="col-lg-12">
                           {{--Campo Descripción Antecedentes Familiares--}}
                           <div class="form-group">
                              <label for="antefam_descrip" style="vertical-align: bottom;"
                                 class="col-lg-2 text-left">Descripción antecedentes</label>
                              <div class="col-lg-10">
                                 <textarea class="form-control" id="antefam_descrip" name="antefam_descrip">{!! old('antefam_descrip', $paciente->epidemiologia->antefam_descrip) !!}</textarea>
                              </div>
                           </div>
                        </div>
                     </div>


                     <div class="row">
                       <div class="col-lg-12">
                          {{--Sangre--}}
                          <div class="portlet box blue">
                             <div class="portlet-title">
                                <div class="caption"> Sangre Dador – Receptor</div>
                             </div>
                             <div class="portlet-body">
                             <div class="row hover-row">
                                 
                            <div class="col-xs-4">
                                <div class="form-group">
                                   <label for="embarazo"
                                      class="col-lg-5 text-left">¿Está embarazada?</label>
                                   <div class="col-lg-4">
                                      {!! Form::checkbox('embarazo', old('embarazo'), in_array(old('embarazo', $paciente->epidemiologia->embarazo), array('on', 2)) ?  true : false, ['class'=>'', 'id'=>'embarazo']) !!}
                                   </div>
                                </div>                             
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                   <label for="dador_sangre"
                                      class="col-lg-5 text-left">¿Donó sangre?</label>
                                   <div class="col-lg-4">
                                      <select class="form-control" id="dador_sangre" name="dador_sangre">
                                         <option value=""></option>
                                         <option value="S" @if($paciente->epidemiologia->dador_sangre=="S") selected @endif>Si</option>
                                         <option value="N" @if($paciente->epidemiologia->dador_sangre=="N") selected @endif>No</option>
                                         @if(! in_array($paciente->epidemiologia->dador_sangre, array("S", "N", "")))
                                         <option value="{!! $paciente->epidemiologia->dador_sangre!!}" selected>{!! $paciente->epidemiologia->dador_sangre !!}</option>
                                         @endif
                                      </select>
                                   </div>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                   <label for="dador_sangre_cant"
                                      class="col-lg-8 text-left">¿Cuántas veces donó sangre?</label>
                                   <div class="col-lg-4">
                                      <input type="number" class="form-control" id="dador_sangre_cant" name="dador_sangre_cant" value="{!! old('dador_sangre_cant', $paciente->epidemiologia->dador_sangre_cant) !!}">
                                   </div>
                                </div>

                            </div>
                            </div>
                            <div class="row hover-row">
                            <div class="col-xs-4">
                                <div class="form-group">
                                   <label for="dador_sangre_hosp"
                                      class="col-lg-6 text-left">¿En qué hospital/es donó?</label>
                                   <div class="col-lg-6">
                                      <input type="text" class="form-control" id="dador_sangre_hosp" name="dador_sangre_hosp" value="{!! old('dador_sangre_hosp', $paciente->epidemiologia->dador_sangre_hosp) !!}">
                                   </div>
                                </div>                                
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                   <label for="recep_sangre"
                                      class="col-lg-8 text-left">¿Cuántas veces recibió sangre?</label>
                                   <div class="col-lg-4">
                                      <input type="number" class="form-control" id="recep_sangre" name="recep_sangre" value="{!! old('recep_sangre', $paciente->epidemiologia->recep_sangre) !!}">
                                   </div>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                   <label for="recep_sangre_hosp"
                                      class="col-lg-8 text-left">¿En qué hospital/es recibió sangre?</label>
                                   <div class="col-lg-4">
                                      <input type="text" class="form-control" id="recep_sangre_hosp" name="recep_sangre_hosp" value="{!! old('recep_sangre_hosp', $paciente->epidemiologia->recep_sangre_hosp) !!}">
                                   </div>
                                </div>                                
                            </div>
                            </div>
                            <div class="row hover-row">
                            <div class="col-xs-9">
                                <div class="form-group">
                                   <label for="recep_sangre_motivo"
                                      class="col-lg-3 text-left">Motivo de la transfusión</label>
                                   <div class="col-lg-9">
                                   <textarea  class="form-control" id="recep_sangre_motivo" name="recep_sangre_motivo">{!! old('recep_sangre_motivo', $paciente->epidemiologia->recep_sangre_motivo) !!}</textarea>
                                    </div>
                                </div>
                            </div>
                            </div>
                             </div>
                          </div>
                       </div>
                    </div>

                             <div class="row">
            <div class="col-lg-12">
               {{--Preguntas de Chagas--}}
               <div class="portlet box blue">
                  <div class="portlet-title">
                     <div class="caption"> Preguntas de Chagas </div>
                  </div>
                  <div class="portlet-body">
                  <div class="row hover-row">
                      

                  <div class="col-xs-4">
                     <div class="form-group">
                        <label for="conoce_vinchuca"
                           class="col-lg-5 text-left">¿Conoce vinchuca?</label>
                        <div class="col-lg-7">
                           <select class="form-control" id="conoce_vinchuca" name="conoce_vinchuca">
                              <option value=""></option>
                              <option value="S" @if($paciente->epidemiologia->conoce_vinchuca=="S") selected @endif>Si</option>
                              <option value="N" @if($paciente->epidemiologia->conoce_vinchuca=="N") selected @endif>No</option>
                              @if(! in_array($paciente->epidemiologia->conoce_vinchuca, array("S", "N", "")))
                              <option value="{!! $paciente->epidemiologia->conoce_vinchuca!!}" selected>{!! $paciente->epidemiologia->conoce_vinchuca !!}</option>
                              @endif
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="col-xs-4">

                     <div class="form-group">
                        <label for="puerta_entrada"
                           class="col-lg-7 text-left">¿Conoce la puerta de entrada?</label>
                        <div class="col-lg-5">
                           <input type="text" class="form-control" id="puerta_entrada" name="puerta_entrada" value="{!! old('puerta_entrada', $paciente->epidemiologia->puerta_entrada) !!}">
                        </div>
                     </div>
                  </div>
                  <div class="col-xs-4">
                     <div class="form-group">
                        <label for="sabe_chagasico"
                           class="col-lg-5 text-left">¿Se sabe chagásico?</label>
                        <div class="col-lg-7">
                           <select class="form-control" id="sabe_chagasico" name="sabe_chagasico">
                              <option value=""></option>
                              <option value="S" @if($paciente->epidemiologia->sabe_chagasico=="S") selected @endif>Si</option>
                              <option value="N" @if($paciente->epidemiologia->sabe_chagasico=="N") selected @endif>No</option>
                              @if(! in_array($paciente->epidemiologia->sabe_chagasico, array("S", "N", "")))
                              <option value="{!! $paciente->epidemiologia->sabe_chagasico!!}" selected>{!! $paciente->epidemiologia->sabe_chagasico !!}</option>
                              @endif
                           </select>
                        </div>
                     </div>

                  </div>
                  </div>
                  <div class="row hover-row">
                  <div class="col-xs-4">

                     <div class="form-group">
                        <label for="motivo_det_chagas"
                           class="col-lg-5 text-left">¿Motivo por el cual detectan Chagas?</label>
                        <div class="col-lg-7">
                           {!! Form::select('motivo_det_chagas',array("CA"=>"Catastro","CO"=>"Consulta","ES"=>"Espontáneamente","HE"=>"Hemoterapia","LA"=>"Exámen Laboral","PR"=>"Exámen Preocupacional","MI"=>"Migraciones","OT"=>"Otros","?"=>"Desconocido","EM"=>"Embarazo"), $paciente->epidemiologia->motivo_det_chagas, ['id' => 'motivo_det_chagas', 'class'=>'form-control selectTags ']) !!}
                        </div>
                     </div>
                  </div>
                  <div class="col-xs-4">
                     <div class="form-group">
                        <label for="fecha_det_chagas" class="col-lg-7 text-left">Fecha de detección de Chagas</label>
                        <div class="col-lg-5">
                           <input type="text" class="form-control datepicker" id="fecha_det_chagas"
                              name="fecha_det_chagas"
                              value="@if($paciente->epidemiologia->fecha_det_chagas){!! old('fecha_det_chagas',$paciente->epidemiologia->fecha_det_chagas->format('d/m/Y')) !!}@endif">
                        </div>
                     </div>

                </div>

                <div class="col-xs-4">

                     <div class="form-group">
                        <label for="confirmacion_chagas"
                           class="col-lg-6 text-left">Confirmación de Chagas</label>
                        <div class="col-lg-6">
                           <select class="form-control" id="confirmacion_chagas" name="confirmacion_chagas">
                              <option value=""></option>
                              <option value="S" @if($paciente->epidemiologia->confirmacion_chagas=="S") selected @endif>Si</option>
                              <option value="N" @if($paciente->epidemiologia->confirmacion_chagas=="N") selected @endif>No</option>
                              @if(! in_array($paciente->epidemiologia->confirmacion_chagas, array("S", "N", "")))
                              <option value="{!! $paciente->epidemiologia->confirmacion_chagas!!}" selected>{!! $paciente->epidemiologia->confirmacion_chagas !!}</option>
                              @endif
                           </select>
                        </div>
                     </div>

                </div>
                </div>
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
               <div class="portlet box blue">
                  <div class="portlet-title">
                     <div class="caption"> Composición de Vivienda </div>
                  </div>
                  <div class="portlet-body">
                     <div class="form-group">
                        <label for="conyuge"
                           class="col-lg-8 text-left">¿Vive con su esposo/a?</label>
                        <div class="col-lg-4">
                           <select class="form-control" id="conyuge" name="conyuge">
                              <option value=""></option>
                              <option value="S" @if($paciente->epidemiologia->conyuge=="S") selected @endif>Si</option>
                              <option value="N" @if($paciente->epidemiologia->conyuge=="N") selected @endif>No</option>
                              @if(! in_array($paciente->epidemiologia->conyuge, array("S", "N", "")))
                              <option value="{!! $paciente->epidemiologia->conyuge!!}" selected>{!! $paciente->epidemiologia->conyuge !!}</option>
                              @endif
                           </select>
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="cant_hijos"
                           class="col-lg-8 text-left">¿Cuántos hijos tiene?</label>
                        <div class="col-lg-4">
                           <input type="number" class="form-control" id="cant_hijos" name="cant_hijos" value="{!! old('cant_hijos', $paciente->epidemiologia->cant_hijos) !!}">
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="cant_pers_casa"
                           class="col-lg-8 text-left">Cantidad de personas en vivienda</label>
                        <div class="col-lg-4">
                           <input type="number" class="form-control" id="cant_pers_casa" v-model="cantPersCasa" name="cant_pers_casa" value="{!! old('cant_pers_casa', $paciente->epidemiologia->cant_pers_casa) !!}">
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="cant_habit_casa"
                           class="col-lg-8 text-left">Nro. de habitaciones (dormitorios y comedor)</label>
                        <div class="col-lg-4">
                           <input type="number" class="form-control" id="cant_habit_casa" v-model="cantHabitCasa" name="cant_habit_casa" value="{!! old('cant_habit_casa', $paciente->epidemiologia->cant_habit_casa) !!}">
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="indice_hacinamiento" style="vertical-align: bottom;"
                           class="col-lg-8 text-left">Indice de hacinamiento</label>
                        <div class="col-lg-4">
                           <input type="number" step="any" class="form-control" id="indice_hacinamiento" value="@{{ indiceHacinamiento }}" readonly>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-4">
               <div class="row">
                  <div class="col-lg-12">
                     {{--Servicios--}}
                     
                  </div>
               </div>
               <div class="row">
                  <div class="col-lg-12">
                     {{--Estudios--}}
                     <div class="portlet box blue">
                        <div class="portlet-title">
                           <div class="caption"> Estudios </div>
                        </div>
                        <div class="portlet-body">
                           <div class="form-group">
                              <label for="escolaridad"
                                 class="col-lg-8 text-left">Nivel de escolaridad</label>
                              <div class="col-lg-4">
                                 <select class="form-control" id="escolaridad" name="escolaridad">
                                    <option value=""></option>
                                    <option value="AN" @if($paciente->epidemiologia->escolaridad=="AN") selected @endif>Analfabeto</option>
                                    <option value="AL" @if($paciente->epidemiologia->escolaridad=="AL") selected @endif>Alfabeto</option>
                                    <option value="PI" @if($paciente->epidemiologia->escolaridad=="PI") selected @endif>Primario Incompleto</option>
                                    <option value="PC" @if($paciente->epidemiologia->escolaridad=="PC") selected @endif>Primario Completo</option>
                                    <option value="SI" @if($paciente->epidemiologia->escolaridad=="SI") selected @endif>Secundario Incompleto</option>
                                    <option value="SC" @if($paciente->epidemiologia->escolaridad=="SC") selected @endif>Secundario Completo</option>
                                    <option value="TI" @if($paciente->epidemiologia->escolaridad=="TI") selected @endif>Terciario Incompleto</option>
                                    <option value="TC" @if($paciente->epidemiologia->escolaridad=="TC") selected @endif>Terciario Completo</option>
                                    <option value="UI" @if($paciente->epidemiologia->escolaridad=="UI") selected @endif>Universitario Incompleto</option>
                                    <option value="UC" @if($paciente->epidemiologia->escolaridad=="UC") selected @endif>Universitario Completo</option>
                                    <option value="?" @if($paciente->epidemiologia->escolaridad=="?") selected @endif>No se sabe</option>
                                    @if(! in_array($paciente->epidemiologia->escolaridad, array("AN", "AL", "PI", "PC", "SI", "SC", "TI", "TC", "UI", "UC", "?", "")))
                                    <option value="{!! $paciente->epidemiologia->escolaridad!!}" selected>{!! $paciente->epidemiologia->escolaridad !!}</option>
                                    @endif
                                 </select>
                              </div>
                           </div>
                           <div class="form-group">
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
               <div class="portlet box blue">
                  <div class="portlet-title">
                     <div class="caption"> Situación Laboral </div>
                  </div>
                  <div class="portlet-body">
                     <div class="form-group">
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
                              @if(! in_array($paciente->epidemiologia->trabajo, array("S", "N", "NOAC", "NOJU", "NOES", "NODE", "?", "")))
                              <option value="{!! $paciente->epidemiologia->trabajo!!}" selected>{!! $paciente->epidemiologia->trabajo !!}</option>
                              @endif
                           </select>
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="tipo_trabajo"
                           class="col-lg-4 text-left">Tipo de trabajo</label>
                        <div class="col-lg-8">
                           <input type="text" class="form-control" id="tipo_trabajo" name="tipo_trabajo" value="{!! old('tipo_trabajo', $paciente->epidemiologia->tipo_trabajo) !!}">
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="rechazado_empleo_chagas"
                           class="col-lg-8 text-left">¿Fue rechazado de algún empleo por Chagas?</label>
                        <div class="col-lg-4">
                           <select class="form-control" id="rechazado_empleo_chagas" name="rechazado_empleo_chagas">
                              <option value=""></option>
                              <option value="S" @if($paciente->epidemiologia->rechazado_empleo_chagas=="S") selected @endif>Si</option>
                              <option value="N" @if($paciente->epidemiologia->rechazado_empleo_chagas=="N") selected @endif>No</option>
                              <option value="?" @if($paciente->epidemiologia->rechazado_empleo_chagas=="?") selected @endif>No se sabe</option>
                              @if(! in_array($paciente->epidemiologia->rechazado_empleo_chagas, array("S", "N", "?", "")))
                              <option value="{!! $paciente->epidemiologia->rechazado_empleo_chagas!!}" selected>{!! $paciente->epidemiologia->rechazado_empleo_chagas !!}</option>
                              @endif
                           </select>
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="nombre_empresa_rech"
                           class="col-lg-6 text-left">¿Qué empresa lo rechazó?</label>
                        <div class="col-lg-6">
                           <input type="text" class="form-control" id="nombre_empresa_rech" name="nombre_empresa_rech" value="{!! old('nombre_empresa_rech', $paciente->epidemiologia->nombre_empresa_rech) !!}">
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="obra_social"
                           class="col-lg-6 text-left">Nombre Obra Social</label>
                        <div class="col-lg-6">
                           <input type="text" class="form-control" id="obra_social" name="obra_social" value="{!! old('obra_social', $paciente->epidemiologia->obra_social) !!}">
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="cant_conviv_trabajan"
                           class="col-lg-8 text-left">Cant. Familiares convivientes que trabajan</label>
                        <div class="col-lg-4">
                           <input type="number" class="form-control" id="cant_conviv_trabajan" v-model="cantConvivTrabajan" name="cant_conviv_trabajan" value="{!! old('cant_conviv_trabajan', $paciente->epidemiologia->cant_conviv_trabajan) !!}">
                        </div>
                     </div>
                     <div class="form-group">
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