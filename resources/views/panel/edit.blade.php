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
       $(".datepicker").datepicker({ changeYear: true,yearRange: "-100:+0",changeMonth: true });
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
         <a href="#">Editar</a>
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
         <div id="cabecera" class="col-lg-12">
            <div class="row">
               <div class="col-lg-4">
                  <div class="btn-group btn-group-justified btn-group-raised">
                     {{--<a href="javascript:void(0)" class="btn btn-raised btn-success">Guardar Historia</a>--}}
                     <label for="submit-guardar" class="btn btn-raised btn-success">Guardar Historia</label>
                  </div>
               </div>
            </div>
            <hr/>
            <div class="row">
               {{--Columna Documento y Seguimiento--}}
               <div class="col-lg-12">
                  <div class="portlet box blue">
                     <div class="portlet-body">
                        <div class="row  ">
                           <div class="col-lg-2">
                              <label for="tipo_doc" class="control-label">Tipo Documento</label> 
                              <select class="form-control" id="tipo_doc" name="tipo_doc">
                              <option value="DNI" @if($paciente->tipo_doc =="DNI") selected @endif>Documento Único</option>
                              <option value="LE" @if($paciente->tipo_doc =="LE") selected @endif>Libreta de Enrolamiento</option>                                                <option value="LC" @if($paciente->tipo_doc =="LC") selected @endif>Libreta Cívica</option>                                                <option value="OTRO" @if($paciente->tipo_doc =="OTRO") selected @endif>Otro</option>
                              </select>
                           </div>
                           <div class="col-lg-2"> 
                              <label for="numero_doc" class="  control-label">Nro. Documento </label> 
                              <input type="text" class="form-control" id="numero_doc" name="numero_doc" value="{!! $paciente->numero_doc !!}">
                           </div>
                           <div class="col-lg-2">
                              <label for="vivo" class=" control-label">¿Vivo?</label> 
                              <select class="form-control" id="vivo" name="vivo">
                                 <option value=""> </option>
                                 <option value="S" @if($paciente->vivo =="S") selected @endif>Si</option>
                                 <option value="N" @if($paciente->vivo =="N") selected @endif>No</option>
                                 <option value="?" @if($paciente->vivo =="?") selected @endif>NO SABE</option>
                                 <option value="NULL" @if($paciente->vivo =="NULL") selected @endif>NULL</option>
                              </select>
                           </div>
                           <div class="col-lg-6">
                              <label for="causa_muerte" class=" control-label">¿Causa de muerte?</label>
                              <div class="col-lg-12">
                                 <textarea  id="causa_muerte" class="form-control" name="causa_muerte">{!! $paciente->causa_muerte !!}</textarea>
                              </div>
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
                           <div class="portlet-title">
                              <div class="caption"> Seguimiento </div>
                           </div>
                           <div class="portlet-body">
                              <div class="row">
                                 <div class="col-lg-6">
                                    <div class="form-group">
                                       <div class="row">
                                          <label for="fecha_nac" class="col-lg-6 control-label">Fecha Nac.</label>
                                          <div class="col-lg-6">
                                             <input type="text" class="form-control datepicker" id="fecha_nac" name="fecha_nac"
                                                value="@if($paciente->fecha_nac){!! $paciente->fecha_nac->format('d/m/Y') !!}@endif">
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-lg-6">
                                    <div class="form-group">
                                       <label for="edad_ing" class="col-lg-6 control-label">Edad al ingreso</label>
                                       <div class="col-lg-6">
                                          <input type="number" class="form-control" id="edad_ing" name="edad_ing"
                                             value="@if($paciente->fecha_alta and $paciente->fecha_nac){!! $paciente->fecha_alta->diffInYears($paciente->fecha_nac) !!}@else 0 @endif" readonly>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-lg-6">
                                    <div class="form-group">
                                       <div class="row">
                                          <label for="fecha_alta" class="col-lg-6 control-label">Fecha Ing.</label>
                                          <div class="col-lg-6">
                                             <input type="text" class="form-control" id="fecha_alta"
                                                name="fecha_alta"
                                                value="@if($paciente->fecha_alta){!! $paciente->fecha_alta->format('d/m/Y') !!}@endif" readonly>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-lg-6">
                                    <div class="form-group">
                                       <label for="anios_seg" class="col-lg-6 control-label">Años
                                       Seguimiento.</label>
                                       <div class="col-lg-6">
                                          <input type="number" class="form-control" id="anios_seg"
                                             name="anios_seg"
                                             value="@if($paciente->fecha_alta){!! \Carbon\Carbon::now()->diffInYears($paciente->fecha_alta) !!}@endif" readonly>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-lg-6">
                                    <div class="form-group">
                                       <div class="row">
                                          <label for="fecha_ult_consulta" class="col-lg-6 control-label">Fecha Ult.
                                          Consulta</label>
                                          <div class="col-lg-6">
                                             <input type="text" class="form-control" id="fecha_ult_consulta"
                                             name="fecha_ult_consulta"
                                             {{--value="@if($paciente->fecha_ult_consulta){!! $paciente->fecha_ult_consulta->format('d/m/Y') !!}@endif"--}}
                                             value="@if($maxConsulta){!! \Carbon\Carbon::parse($maxConsulta)->format('d/m/Y') !!}@elseif($paciente->fecha_ult_consulta){!! $paciente->fecha_ult_consulta->format('d/m/Y') !!}@endif"
                                             readonly>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-lg-6">
                                    <div class="form-group">
                                       <label for="proxima_cita" class="col-lg-6 control-label">Próxima
                                       Cita</label>
                                       <div class="col-lg-6">
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
                  </div>
               </div>
                
                 <div class="col-lg-6">
                  {{--//Columna Serología--}}
                  <div class="col-lg-12">
                     <div class="portlet box blue">
                        <div class="portlet-title">
                           <div class="caption">Serología</div>
                        </div>
                        <div class="portlet-body">
                           <div class="form-group">
                              <label for="tres_negativas" class="col-lg-8 control-label">3 pruebas serológicas
                              negativas</label>
                              <div class="col-lg-4">
                                 {!! Form::hidden('tres_negativas', 1) !!}
                                 <input type="checkbox" id="tres_negativas"
                                 name="tres_negativas" @if($paciente->tres_negativas == 2) checked
                                 @endif>
                              </div>
                           </div>
                           <div class="form-group">
                              <label for="serologia_ing" class="col-lg-8 control-label">Serología al
                              ingreso</label>
                              <div class="col-lg-4">
                                 <input type="text" class="form-control" id="serologia_ing"
                                    name="serologia_ing" value="{!! $paciente->serologia_ing !!}">
                              </div>
                           </div>
                           <div class="form-group">
                              <label for="titulos_sero_ing" class="col-lg-8 control-label">Titulos serológicos
                              al ingreso</label>
                              <div class="col-lg-4">
                                 <input type="text" class="form-control" id="titulos_sero_ing"
                                    name="titulos_sero_ing" value="{!! $paciente->titulos_sero_ing !!}">
                              </div>
                           </div>
                           <div class="form-group">
                              <label for="trat_etio" class="col-lg-8 control-label">Tratamiento
                              Etiológico</label>
                              <div class="col-lg-4">
                                 <select class="form-control" id="trat_etio" name="trat_etio">
                                 <option value="S" @if($paciente->trat_etio =="S") selected @endif>Si</option>
                                 <option value="N" @if($paciente->trat_etio =="N") selected @endif>No</option>
                                 <option value="?" @if($paciente->trat_etio =="?") selected @endif>NO SABE</option>
                                 <option value="NULL" @if($paciente->trat_etio =="NULL") selected @endif>NULL</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
                
               <div class="col-lg-6">
                  <div class="portlet box blue">
                     <div class="portlet-title">
                        <div class="caption"> ECG </div>
                     </div>
                     <div class="portlet-body">
                        <div class="form-group">
                           <label for="ecg"
                              class="col-lg-7 text-left {{--control-label --}}">Consignación</label>
                           <div class="col-lg-5">
                              <select class="form-control" id="ecg" name="ecg">
                                 <option value=""></option>
                                 <option value="N" name="N" @if($paciente->ecg=="N") selected @endif>N</option>
                                 <option value="E" name="E" @if($paciente->ecg=="E") selected @endif>E</option>
                                 <option value="I" name="I" @if($paciente->ecg=="I") selected @endif>I</option>
                                 <option value="?" name="?" @if($paciente->ecg=="?") selected @endif>?</option>
                              </select>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="tipo_ecg"
                              class="col-lg-6 text-left {{--control-label --}}">Descripción</label>
                           <div class="col-lg-6">
                              <input type="text" class="form-control" id="tipo_ecg"
                                 name="tipo_ecg" value="{!! $paciente->tipo_ecg !!}">
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="nuevos_cambios_ecg" class="col-lg-6 text-left {{--control-label --}}">Nuevos
                           cambios</label>
                           <div class="col-lg-6">
                            

                              <select class="form-control" id="ecg" name="ecg">
                                 <option value=""></option>
                                 <option value="S" @if($paciente->nuevos_cambios_ecg=="S") selected @endif>S</option>
                                 <option value="N" @if($paciente->nuevos_cambios_ecg=="N") selected @endif>N</option>
                                 <option value="?" @if($paciente->nuevos_cambios_ecg=="?") selected @endif>NO SABE</option>
                                 <option value="NULL" @if($paciente->nuevos_cambios_ecg=="NULL") selected @endif>NULL</option>
                                 
                              </select>


                           </div>
                        </div>
                        <div class="form-group">
                           <label for="fecha_cambios_ecg" class="col-lg-8 text-left {{--control-label --}}">Fecha
                           del cambio</label>
                           <div class="col-lg-4">
                              <input type="text" class="form-control datepicker" id="fecha_cambios_ecg"
                                 name="fecha_cambios_ecg"
                                 value="@if($paciente->fecha_cambios_ecg){!! $paciente->fecha_cambios_ecg->format('d/m/Y') !!}@endif">
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="tipo_cambio_ecg" class="col-lg-8 text-left {{--control-label --}}">Tipo
                           de cambio</label>
                           <div class="col-lg-4">
                              <input type="text" class="form-control" id="tipo_cambio_ecg"
                                 name="tipo_cambio_ecg" value="{!! $paciente->tipo_cambio_ecg !!}">
                           </div>
                        </div>
                        <div class="form-group">
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
               <div class="col-lg-6">
                  {{--//Columna Grupo Clínico--}}
                  <div class="col-lg-12">
                     <div class="portlet box blue">
                        <div class="portlet-title">
                           <div class="caption"> Grupo Clínico </div>
                        </div>
                        <div class="portlet-body">
                           <div class="form-group">
                              <label for="grupo_clinico_ing" class="col-lg-6 control-label">Grupo Clínico al
                              Ingreso</label>
                              <div class="col-lg-6">
                                 <select class="form-control" id="grupo_clinico_ing"
                                    name="grupo_clinico_ing">
                                    <option value="0" 
                                       @if($paciente->grupo_clinico_ing==0) selected @endif>
                                       0
                                    </option>
                                    <option value="1" 
                                       @if($paciente->grupo_clinico_ing==1) selected @endif>
                                       1
                                    </option>
                                    <option value="2" 
                                       @if($paciente->grupo_clinico_ing==2) selected @endif>
                                       2
                                    </option>
                                    <option value="3" 
                                       @if($paciente->grupo_clinico_ing==3) selected @endif>
                                       3
                                    </option>
                                    <option value="4" 
                                       @if($paciente->grupo_clinico_ing==4) selected @endif>
                                       4
                                    </option>
                                    <option value="5" 
                                       @if($paciente->grupo_clinico_ing==5) selected @endif>
                                       F
                                    </option>
                                 </select>
                              </div>
                           </div>
                           <div class="form-group">
                              <label for="cambio_grupo_cli" class="col-lg-6 control-label">Cambio en el Grupo
                              Clínico</label>
                              <div class="col-lg-6">
                                 <select class="form-control" id="cambio_grupo_cli" name="cambio_grupo_cli">
                                    <option value="S" @if($paciente->cambio_grupo_cli=="S") selected @endif>Si</option>
                                    <option value="N" @if($paciente->cambio_grupo_cli=="N") selected @endif>No</option>
                                    <option value="?" @if($paciente->cambio_grupo_cli=="?") selected @endif>NO SABE</option>
                                   <option value="NULL" @if($paciente->cambio_grupo_cli=="NULL") selected @endif>NULL</option>
                                 </select>
                              </div>
                           </div>
                           <div class="form-group">
                              <label for="fecha_cambio_gcli" class="col-lg-6 control-label">Fecha Cambio Grupo
                              Clínico</label>
                              <div class="col-lg-6">
                                 <input type="text" class="form-control datepicker" id="fecha_cambio_gcli"
                                    name="fecha_cambio_gcli"
                                    @if($paciente->fecha_cambio_gcli)
                                    value="{!! \Carbon\Carbon::parse($paciente->fecha_cambio_gcli)->format('d/m/Y') !!}"
                                    @endif
                                    >
                              </div>
                           </div>
                           <div class="form-group">
                              <label for="nuevo_grupo_cli" class="col-lg-6 control-label">Nuevo Grupo
                              Clínico</label>
                              <div class="col-lg-6">
                                 <select class="form-control" id="nuevo_grupo_cli"
                                    name="nuevo_grupo_cli">
                                    <option value="0" @if($paciente->nuevo_grupo_cli==0) selected @endif>
                                       0
                                    </option>
                                    <option value="1" @if($paciente->nuevo_grupo_cli==1) selected @endif>
                                       1
                                    </option>                                                    
                                    <option value="2" @if($paciente->nuevo_grupo_cli==2) selected @endif>
                                       2
                                    </option>
                                    <option value="3" @if($paciente->nuevo_grupo_cli==3) selected @endif>
                                       3
                                    </option>
                                    <option value="4" @if($paciente->nuevo_grupo_cli==4) selected @endif>
                                       4
                                    </option>
                                    <option value="5" @if($paciente->nuevo_grupo_cli==5) selected @endif>
                                       F
                                    </option>
                                 </select>
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
                     <div class="portlet-title">
                        <div class="caption"> Tratamiento con BNZ </div>
                     </div>
                     <div class="portlet-body">
                        <div class="form-group">
                           <label for="trat_bnz" class="col-lg-8 text-left {{--control-label --}}">Tratamiento
                           con Benznidazol</label>
                           <div class="col-lg-4">
                              {!! Form::hidden('trat_bnz', 1) !!}
                              <input type="checkbox" id="trat_bnz"
                              name="trat_bnz" @if($paciente->trat_bnz == 2) checked
                              @endif>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="fecha_ini_trat_bnz" class="col-lg-8 text-left {{--control-label --}}">Fecha
                           Inicio Tratamiento</label>
                           <div class="col-lg-4">
                              <input type="text" class="form-control datepicker" id="fecha_ini_trat_bnz"
                                 name="fecha_ini_trat_bnz"
                                 value="@if($paciente->fecha_ini_trat_bnz){!! $paciente->fecha_ini_trat_bnz->format('d/m/Y') !!}@endif">
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="efectos_adv_bnz" class="col-lg-8 text-left {{--control-label --}}">Efectos
                           Adversos</label>
                           <div class="col-lg-4">
                              {!! Form::hidden('efectos_adv_bnz', 1) !!}
                              <input type="checkbox" id="efectos_adv_bnz"
                              name="efectos_adv_bnz" @if($paciente->efectos_adv_bnz == 2) checked
                              @endif>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="efec_rash_bnz" class="col-lg-8 text-left {{--control-label --}}">Presenta
                           rash cutáneo</label>
                           <div class="col-lg-4">
                              {!! Form::hidden('efec_rash_bnz', 1) !!}
                              <input type="checkbox" id="efec_rash_bnz"
                              name="efec_rash_bnz" @if($paciente->efec_rash_bnz == 2) checked
                              @endif>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="efec_intgas_bnz" class="col-lg-8 text-left {{--control-label --}}">Presenta
                           intolerancia gástrica/digestiva</label>
                           <div class="col-lg-4">
                              {!! Form::hidden('efec_intgas_bnz', 1) !!}
                              <input type="checkbox" id="efec_intgas_bnz"
                              name="efec_intgas_bnz" @if($paciente->efec_intgas_bnz == 2) checked
                              @endif>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="efec_afhep_bnz" class="col-lg-8 text-left {{--control-label --}}">Presenta
                           afectación hepática</label>
                           <div class="col-lg-4">
                              {!! Form::hidden('efec_afhep_bnz', 1) !!}
                              <input type="checkbox" id="efec_afhep_bnz"
                              name="efec_afhep_bnz" @if($paciente->efec_afhep_bnz == 2) checked
                              @endif>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="efec_afneur_bnz" class="col-lg-8 text-left {{--control-label --}}">Presenta
                           afectación neurológica</label>
                           <div class="col-lg-4">
                              {!! Form::hidden('efec_afneur_bnz', 1) !!}
                              <input type="checkbox" id="efec_afneur_bnz"
                              name="efec_afneur_bnz" @if($paciente->efec_afneur_bnz == 2) checked
                              @endif>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="efec_afhem_bnz" class="col-lg-8 text-left {{--control-label --}}">Presenta
                           afectación hematológica</label>
                           <div class="col-lg-4">
                              {!! Form::hidden('efec_afhem_bnz', 1) !!}
                              <input type="checkbox" id="efec_afhem_bnz"
                              name="efec_afhem_bnz" @if($paciente->efec_afhem_bnz == 2) checked
                              @endif>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="susp_bnz" class="col-lg-8 text-left {{--control-label --}}">Suspensión
                           del tratamiento</label>
                           <div class="col-lg-4">
                              {!! Form::hidden('susp_bnz', 1) !!}
                              <input type="checkbox" id="susp_bnz"
                              name="susp_bnz" @if($paciente->susp_bnz == 2) checked
                              @endif>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="efec_otros_bnz" class="col-lg-6 text-left {{--control-label --}}">Otros
                           efectos adversos</label>
                           <div class="col-lg-6">
                              <textarea class="form-control" id="efec_otros_bnz"
                                 name="efec_otros_bnz">{!! $paciente->efec_otros_bnz !!}</textarea>
                           </div>
                        </div>
                     </div>
                     {{--Fin Nuevo--}}
                  </div>
               </div>
               <div class="col-lg-4">
                  <div class="portlet box blue">
                     <div class="portlet-title">
                        <div class="caption"> Tratamiento con Nifurtimox</div>
                     </div>
                     <div class="portlet-body">
                        <div class="form-group">
                           <label for="trat_nifur" class="col-lg-8 text-left {{--control-label --}}">Tratamiento
                           con Nifurtimox</label>
                           <div class="col-lg-4">
                              {!! Form::hidden('trat_nifur', 1) !!}
                              <input type="checkbox" id="trat_nifur"
                              name="trat_nifur" @if($paciente->trat_nifur == 2) checked
                              @endif>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="fecha_ini_trat_nifur" class="col-lg-8 text-left {{--control-label --}}">Fecha
                           Inicio Tratamiento</label>
                           <div class="col-lg-4">
                              <input type="text" class="form-control datepicker" id="fecha_ini_trat_nifur"
                                 name="fecha_ini_trat_nifur"
                                 value="@if($paciente->fecha_ini_trat_nifur){!! $paciente->fecha_ini_trat_nifur->format('d/m/Y') !!}@endif">
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="efectos_adv_nifur" class="col-lg-8 text-left {{--control-label --}}">Efectos
                           Adversos</label>
                           <div class="col-lg-4">
                              {!! Form::hidden('efectos_adv_nifur', 1) !!}
                              <input type="checkbox"   id="efectos_adv_nifur"
                              name="efectos_adv_nifur" @if($paciente->efectos_adv_nifur == 2) checked
                              @endif>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="efec_rash_nifur" class="col-lg-8 text-left {{--control-label --}}">Presenta
                           rash cutáneo</label>
                           <div class="col-lg-4">
                              {!! Form::hidden('efec_rash_nifur', 1) !!}
                              <input type="checkbox"   id="efec_rash_nifur"
                              name="efec_rash_nifur" @if($paciente->efec_rash_nifur == 2) checked
                              @endif>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="efec_intgas_nifur" class="col-lg-8 text-left {{--control-label --}}">Presenta
                           intolerancia gástrica/digestiva</label>
                           <div class="col-lg-4">
                              {!! Form::hidden('efec_intgas_nifur', 1) !!}
                              <input type="checkbox"  id="efec_intgas_nifur"
                              name="efec_intgas_nifur" @if($paciente->efec_intgas_nifur == 2) checked
                              @endif>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="efec_afhep_nifur" class="col-lg-8 text-left {{--control-label --}}">Presenta
                           afectación hepática</label>
                           <div class="col-lg-4">
                              {!! Form::hidden('efec_afhep_nifur', 1) !!}
                              <input type="checkbox"  id="efec_afhep_nifur"
                              name="efec_afhep_nifur" @if($paciente->efec_afhep_nifur == 2) checked
                              @endif>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="efec_afneur_nifur" class="col-lg-8 text-left {{--control-label --}}">Presenta
                           afectación neurológica</label>
                           <div class="col-lg-4">
                              {!! Form::hidden('efec_afneur_nifur', 1) !!}
                              <input type="checkbox"   id="efec_afneur_nifur"
                              name="efec_afneur_nifur" @if($paciente->efec_afneur_nifur == 2) checked
                              @endif>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="efec_afhem_nifur" class="col-lg-8 text-left {{--control-label --}}">Presenta
                           afectación hematológica</label>
                           <div class="col-lg-4">
                              {!! Form::hidden('efec_afhem_nifur', 1) !!}
                              <input type="checkbox"  id="efec_afhem_nifur"
                              name="efec_afhem_nifur" @if($paciente->efec_afhem_nifur == 2) checked
                              @endif>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="susp_nifur" class="col-lg-8 text-left {{--control-label --}}">Suspención
                           del tratamiento</label>
                           <div class="col-lg-4">
                              {!! Form::hidden('susp_nifur', 1) !!}
                              <input type="checkbox"   id="susp_nifur"
                              name="susp_nifur" @if($paciente->susp_nifur == 2) checked
                              @endif>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="efec_otros_nifur" class="col-lg-6 text-left {{--control-label --}}">Otros
                           efectos adversos</label>
                           <div class="col-lg-6">
                              <textarea class="form-control" id="efec_otros_nifur"
                                 name="efec_otros_nifur">{!! $paciente->efec_otros_nifur !!}</textarea>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-lg-4">
                  {{--Observaciones Tratamiento Etiológico--}}
                  <div class="portlet box blue">
                     <div class="portlet-title">
                        <div class="caption">Otros efectos adversos</div>
                     </div>
                     <div class="portlet-body">
                        <div class="row">
                           <div class="col-lg-12">
                              <textarea class="form-control" name="trat_etio_obs" id="trat_etio_obs" cols="30"
                                 rows="15">{!! $paciente->trat_etio_obs !!}</textarea>
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
                        <div class="caption">Patología Asociada</div>
                     </div>
                     <div class="portlet-body">
                        <div class="row">
                           <div class="col-lg-3">
                              <div class="form-group">
                                 <label for="sin_patologia"
                                    class="col-lg-8 text-left {{--control-label --}}">Paciente sin
                                 patología asociada</label>
                                 <div class="col-lg-4">
                                    {!! Form::hidden('sin_patologia', 1) !!}
                                    <input type="checkbox" id="sin_patologia"
                                    name="sin_patologia" @if($paciente->sin_patologia == 2) checked
                                    @endif>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label for="tuberculosis" class="col-lg-8 text-left {{--control-label --}}">Tuberculosis</label>
                                 <div class="col-lg-4">
                                    {!! Form::hidden('tuberculosis', 1) !!}
                                    <input type="checkbox" id="tuberculosis"
                                    name="tuberculosis" @if($paciente->tuberculosis == 2) checked
                                    @endif>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label for="epoc"
                                    class="col-lg-8 text-left {{--control-label --}}">E.P.O.C.</label>
                                 <div class="col-lg-4">
                                    {!! Form::hidden('epoc', 1) !!}
                                    <input type="checkbox" id="epoc"
                                    name="epoc" @if($paciente->epoc == 2) checked
                                    @endif>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label for="dbt"
                                    class="col-lg-8 text-left {{--control-label --}}">Diabetes</label>
                                 <div class="col-lg-4">
                                    {!! Form::hidden('dbt', 1) !!}
                                    <input type="checkbox" id="dbt"
                                    name="dbt" @if($paciente->dbt == 2) checked
                                    @endif>
                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-3">
                              <div class="form-group">
                                 <label for="colageno" class="col-lg-8 text-left {{--control-label --}}">Colagenopatías</label>
                                 <div class="col-lg-4">
                                    {!! Form::hidden('colageno', 1) !!}
                                    <input type="checkbox" id="colageno"
                                    name="colageno" @if($paciente->colageno == 2) checked
                                    @endif>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label for="obesidad" class="col-lg-8 text-left {{--control-label --}}">Obesidad
                                 mórbida</label>
                                 <div class="col-lg-4">
                                    {!! Form::hidden('obesidad', 1) !!}
                                    <input type="checkbox" id="obesidad"
                                    name="obesidad" @if($paciente->obesidad == 2) checked
                                    @endif>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label for="alcoholismo" class="col-lg-8 text-left {{--control-label --}}">Alcoholismo</label>
                                 <div class="col-lg-4">
                                    {!! Form::hidden('alcoholismo', 1) !!}
                                    <input type="checkbox" id="alcoholismo"
                                    name="alcoholismo" @if($paciente->alcoholismo == 2) checked
                                    @endif>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label for="acv" class="col-lg-8 text-left {{--control-label --}}">Accidente
                                 Cerebrovascular</label>
                                 <div class="col-lg-4">
                                    {!! Form::hidden('acv', 1) !!}
                                    <input type="checkbox" id="acv"
                                    name="acv" @if($paciente->acv == 2) checked
                                    @endif>
                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-3">
                              <div class="form-group">
                                 <label for="hipotiroidismo"
                                    class="col-lg-8 text-left {{--control-label --}}">Hipotiroidismo</label>
                                 <div class="col-lg-4">
                                    {!! Form::hidden('hipotiroidismo', 1) !!}
                                    <input type="checkbox" id="hipotiroidismo"
                                    name="hipotiroidismo" @if($paciente->hipotiroidismo == 2) checked
                                    @endif>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label for="hipertiroidismo"
                                    class="col-lg-8 text-left {{--control-label --}}">Hipertiroidismo</label>
                                 <div class="col-lg-4">
                                    {!! Form::hidden('hipertiroidismo', 1) !!}
                                    <input type="checkbox" id="hipertiroidismo"
                                    name="hipertiroidismo"
                                    @if($paciente->hipertiroidismo == 2) checked
                                    @endif>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label for="cardio_congenitas"
                                    class="col-lg-8 text-left {{--control-label --}}">Cardiopatías
                                 congénitas</label>
                                 <div class="col-lg-4">
                                    {!! Form::hidden('cardio_congenitas', 1) !!}
                                    <input type="checkbox" id="cardio_congenitas"
                                    name="cardio_congenitas"
                                    @if($paciente->cardio_congenitas == 2) checked
                                    @endif>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label for="valvulopatias"
                                    class="col-lg-8 text-left {{--control-label --}}">Valvulopatias</label>
                                 <div class="col-lg-4">
                                    {!! Form::hidden('valvulopatias', 1) !!}
                                    <input type="checkbox" id="valvulopatias"
                                    name="valvulopatias" @if($paciente->valvulopatias == 2) checked
                                    @endif>
                                 </div>
                              </div>
                           </div>
                           <div class="col-xs-3">
                              <div class="form-group">
                                 <label for="cardio_isquemica"
                                    class="col-lg-8 text-left {{--control-label --}}">Cardiopatía
                                 isquémica</label>
                                 <div class="col-lg-4">
                                    {!! Form::hidden('cardio_isquemica', 1) !!}
                                    <input type="checkbox" id="cardio_isquemica"
                                    name="cardio_isquemica"
                                    @if($paciente->cardio_isquemica == 2) checked
                                    @endif>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label for="ht_arterial_leve"
                                    class="col-lg-8 text-left {{--control-label --}}">Hipertensión
                                 arterial leve</label>
                                 <div class="col-lg-4">
                                    {!! Form::hidden('ht_arterial_leve', 1) !!}
                                    <input type="checkbox" id="ht_arterial_leve"
                                    name="ht_arterial_leve"
                                    @if($paciente->ht_arterial_leve == 2) checked
                                    @endif>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label for="ht_arterial_mode"
                                    class="col-lg-8 text-left {{--control-label --}}">Hipertensión
                                 arterial moderada</label>
                                 <div class="col-lg-4">
                                    {!! Form::hidden('ht_arterial_mode', 1) !!}
                                    <input type="checkbox" id="ht_arterial_mode"
                                    name="ht_arterial_mode"
                                    @if($paciente->ht_arterial_mode == 2) checked
                                    @endif>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label for="ht_arterial_severa"
                                    class="col-lg-8 text-left {{--control-label --}}">Hipertensión
                                 arterial severa</label>
                                 <div class="col-lg-4">
                                    {!! Form::hidden('ht_arterial_severa', 1) !!}
                                    <input type="checkbox" id="ht_arterial_severa"
                                    name="ht_arterial_severa"
                                    @if($paciente->ht_arterial_severa == 2) checked
                                    @endif>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="col-lg-2">
                              <label for="otras_pat_asoc"
                                 class="  text-left {{--control-label --}}">Otras
                              patologías</label>
                           </div>
                           <div class="col-lg-10">
                              <textarea class="form-control" name="otras_pat_asoc" id="otras_pat_asoc"
                                 cols="145" rows="2">{!! $paciente->otras_pat_asoc !!}</textarea>
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
                        <div class="caption">Exámen al ingreso</div>
                     </div>
                     <div class="portlet-body">
                        <div class="row">
                           <div class="col-lg-3">
                              <div class="form-group">
                                 <label for="asintomatico" class="col-lg-8 text-left {{--control-label --}}">Asintomático</label>
                                 <div class="col-lg-4">
                                    {!! Form::hidden('asintomatico', 1) !!}
                                    <input type="checkbox" id="asintomatico"
                                    name="asintomatico" @if($paciente->asintomatico == 2) checked
                                    @endif>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label for="palpitaciones"
                                    class="col-lg-8 text-left {{--control-label --}}">Palpitaciones</label>
                                 <div class="col-lg-4">
                                    {!! Form::hidden('palpitaciones', 1) !!}
                                    <input type="checkbox" id="palpitaciones"
                                    name="palpitaciones" @if($paciente->palpitaciones == 2) checked
                                    @endif>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label for="angor"
                                    class="col-lg-8 text-left {{--control-label --}}">Angor</label>
                                 <div class="col-lg-4">
                                    {!! Form::hidden('angor', 1) !!}
                                    <input type="checkbox" id="angor"
                                    name="angor" @if($paciente->angor == 2) checked
                                    @endif>
                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-3">
                              <div class="form-group">
                                 <label for="disnea"
                                    class="col-lg-8 text-left {{--control-label --}}">Disnea</label>
                                 <div class="col-lg-4">
                                    {!! Form::hidden('disnea', 1) !!}
                                    <input type="checkbox" id="disnea"
                                    name="disnea" @if($paciente->disnea == 2) checked
                                    @endif>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label for="disnea1" class="col-lg-8 text-left {{--control-label --}}">Disnea
                                 Clase Funcional I</label>
                                 <div class="col-lg-4">
                                    {!! Form::hidden('disnea1', 1) !!}
                                    <input type="checkbox" id="disnea1"
                                    name="disnea1" @if($paciente->disnea1 == 2) checked
                                    @endif>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label for="disnea2" class="col-lg-8 text-left {{--control-label --}}">Disnea
                                 Clase Funcional II</label>
                                 <div class="col-lg-4">
                                    {!! Form::hidden('disnea2', 1) !!}
                                    <input type="checkbox" id="disnea2"
                                    name="disnea2" @if($paciente->disnea2 == 2) checked
                                    @endif>
                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-3">
                              <div class="form-group">
                                 <label for="disnea3" class="col-lg-8 text-left {{--control-label --}}">Disnea
                                 Clase Funcional III</label>
                                 <div class="col-lg-4">
                                    {!! Form::hidden('disnea3', 1) !!}
                                    <input type="checkbox" id="disnea3"
                                    name="disnea3" @if($paciente->disnea3 == 2) checked
                                    @endif>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label for="disnea4" class="col-lg-8 text-left {{--control-label --}}">Disnea
                                 Clase Funcional IV</label>
                                 <div class="col-lg-4">
                                    {!! Form::hidden('disnea4', 1) !!}
                                    <input type="checkbox" id="disnea4"
                                    name="disnea4" @if($paciente->disnea4 == 2) checked
                                    @endif>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label for="valvulopatias"
                                    class="col-lg-8 text-left {{--control-label --}}">Valvulopatias</label>
                                 <div class="col-lg-4">
                                    {!! Form::hidden('valvulopatias', 1) !!}
                                    <input type="checkbox" id="valvulopatias"
                                    name="valvulopatias" @if($paciente->valvulopatias == 2) checked
                                    @endif>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label for="mareos"
                                    class="col-lg-8 text-left {{--control-label --}}">Mareos</label>
                                 <div class="col-lg-4">
                                    {!! Form::hidden('mareos', 1) !!}
                                    <input type="checkbox" id="mareos"
                                    name="mareos" @if($paciente->mareos == 2) checked
                                    @endif>
                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-3">
                              <div class="form-group">
                                 <label for="perdida_conoc"
                                    class="col-lg-8 text-left {{--control-label --}}">Pérdida de
                                 conocimiento</label>
                                 <div class="col-lg-4">
                                    {!! Form::hidden('perdida_conoc', 1) !!}
                                    <input type="checkbox" id="perdida_conoc"
                                    name="perdida_conoc" @if($paciente->perdida_conoc == 2) checked
                                    @endif>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label for="insuf_cardiaca"
                                    class="col-lg-8 text-left {{--control-label --}}">Insuficiencia
                                 cardíaca</label>
                                 <div class="col-lg-4">
                                    {!! Form::hidden('insuf_cardiaca', 1) !!}
                                    <input type="checkbox" id="insuf_cardiaca"
                                    name="insuf_cardiaca" @if($paciente->insuf_cardiaca == 2) checked
                                    @endif>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label for="tipo_insuf_card"
                                    class="col-lg-6 text-left {{--control-label --}}">Tipo de
                                 insuficiencia cardíaca</label>
                                 <div class="col-lg-6">
                                    <input type="text" class="form-control" id="tipo_insuf_card"
                                       name="tipo_insuf_card" value="{!! $paciente->tipo_insuf_card !!}">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="col-lg-2">
                              <label for="otros_sintomas_ing"
                                 class=" text-left {{--control-label --}}">Otros síntomas al
                              ingreso</label>
                           </div>
                           <div class="col-lg-10">
                              <textarea class="form-control"  id="otros_sintomas_ing"
                                 name="otros_sintomas_ing">{!! $paciente->otros_sintomas_ing !!}</textarea>
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
                        <div class="caption">Nuevos Síntomas</div>
                     </div>
                     <div class="portlet-body">
                        <div class="form-group">
                           <label for="nuevos_sintomas"
                              class="col-lg-8 text-left {{--control-label --}}">¿Hubo nuevos
                           síntomas?</label>
                           <div class="col-lg-4">
                              <select class="form-control" id="nuevos_sintomas" name="nuevos_sintomas">
                                 <option value=""> </option>
                                 <option value="S" @if($paciente->nuevos_sintomas=="S") selected @endif>Si</option>
                                 <option value="N" @if($paciente->nuevos_sintomas=="N") selected @endif>No</option>
                                 <option value="?" @if($paciente->nuevos_sintomas=="?") selected @endif>NO SABE</option>
                                 <option value="NULL" @if($paciente->nuevos_sintomas=="NULL") selected @endif>NULL</option>
                              </select>
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="col-lg-12">
                              <label for="obs_sintomas"
                                 class="col-lg-8 text-left {{--control-label --}}">Observaciones</label>
                           </div>
                           <div class="col-lg-12">
                              <textarea class="form-control" name="obs_sintomas" id="obs_sintomas" cols="30"
                                 rows="6">{!! $paciente->obs_sintomas !!}</textarea>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
              
               <div class="col-lg-6">
                  <div class="portlet box blue">
                     <div class="portlet-title">
                        <div class="caption">Radiografía</div>
                     </div>
                     <div class="portlet-body">
                        <div class="form-group">
                           <label for="fecha_rx_torax" class="col-lg-8 text-left {{--control-label --}}">Fecha
                           de Radiografía de Tórax</label>
                           <div class="col-lg-4">
                              <input type="text" class="form-control datepicker" id="fecha_rx_torax"
                                 name="fecha_rx_torax"
                                 value="@if($paciente->fecha_rx_torax){!! $paciente->fecha_rx_torax->format('d/m/Y') !!}@endif">
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="rx_torax"
                              class="col-lg-8 text-left {{--control-label --}}">Consignación</label>
                           <div class="col-lg-4">
                              <select class="form-control" id="rx_torax"
                                 name="rx_torax">
                              <option value="S" @if($paciente->rx_torax =="S") selected @endif>Si</option>
                              <option value="N" @if($paciente->rx_torax =="N") selected @endif>No</option>
                              <option value="?" @if($paciente->rx_torax =="?") selected @endif>NO SABE</option>
                              <option value="NULL" @if($paciente->rx_torax =="NULL") selected @endif>NULL</option>
                              </select>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="indice_cardiotorax" class="col-lg-8 text-left {{--control-label --}}">Índice
                           cardiotorácico</label>
                           <div class="col-lg-4">
                              <input  id="indice_cardiotorax"
                                 name="indice_cardiotorax" type="number" class="form-control" value="{{$paciente->indice_cardiotorax}}" step="0.01" />
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="obs_rxt"
                              class="col-lg-3 text-left {{--control-label --}}">Observación</label>
                           <div class="col-lg-8 col-lg-offset-1">
                              <textarea class="form-control" name="obs_rxt" id="obs_rxt" cols="30"
                                 rows="2">{!! $paciente->obs_rxt !!}</textarea>
                           </div>
                        </div>
                        {{--Cambios--}}
                        <div class="form-group">
                           <label for="cambios_rxt" class="col-lg-8 text-left {{--control-label --}}">Cambios
                           en la Rx</label>
                           <div class="col-lg-4">
                              <select class="form-control" id="cambios_rxt"
                                 name="cambios_rxt">
                              <option value="S" @if($paciente->cambios_rxt =="S") selected @endif>Si</option>
                              <option value="N" @if($paciente->cambios_rxt =="N") selected @endif>No</option>
                              <option value="NULL" @if($paciente->cambios_rxt =="N") selected @endif>NULL</option>
                              <option value="?" @if($paciente->cambios_rxt =="?") selected @endif>NO SABE</option>
                              </select>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="fecha_cambios_rxt" class="col-lg-8 text-left {{--control-label --}}">Fecha
                           del cambio</label>
                           <div class="col-lg-4">
                              <input type="text" class="form-control datepicker" id="fecha_cambios_rxt"
                                 name="fecha_cambios_rxt"
                                 value="@if($paciente->fecha_cambios_rxt){!! $paciente->fecha_cambios_rxt->format('d/m/Y') !!}@endif">
                           </div>
                        </div>
                        <div class="form-group">
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
            <div class="portlet box blue">
               <div class="portlet-title">
                  <div class="caption">Evolución</div>
               </div>
               <div class="portlet-body">
                  <div class="row">
                     <div class="col-lg-12">
                        <textarea class="form-control" name="evolucion" id="evolucion" cols="145"
                           rows="4" >{!! $paciente->evolucion !!}</textarea>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-4">
                  <div class="btn-group btn-group-justified btn-group-raised">
                     <label for="submit-guardar" class="btn btn-raised btn-success">Guardar Historia</label>
                  </div>
               </div>
            </div>
         </div>
         <input type="submit" class="hidden" name="submit-guardar" id="submit-guardar">
      </form>
   </div>
</div>
@endsection