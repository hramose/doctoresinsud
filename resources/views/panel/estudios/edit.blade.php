@extends('master')

@section('title')
    Editar estudio - {!! $paciente[0]->apellido . "," . $paciente[0]->nombre !!} -  {!! $estudioPaciente->estudio->nombre !!} - {!! \Carbon\Carbon::parse($estudioPaciente->fecha)->format('d/m/Y') !!}
@endsection

@section('scripts')
    <script>
        $.datepicker.setDefaults($.datepicker.regional['es']);

        $(function () {
            $(".datepicker").datepicker();
        });
    </script>
@endsection

@section('content')
   
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
                <a href="{{ action('Panel\PanelHistoriasController@verHistoria', $paciente[0]->id) }}">Paciente</a>
                <i class="fa fa-angle-right"></i>
             </li>
            <li>
                <a href="#">Editar</a>
              </li>
        </ul>
    </div>

    <div class="portlet box grey-cascade"  >
        <div class="portlet-title">
            <div class="caption">Editar Estudio</div>
            <div class="actions btn-set">
                <a href="{{ action('Panel\PanelHistoriasController@verHistoria', $paciente[0]->id) }}" type="button" name="back" class="btn default"><i class="fa fa-angle-left"></i> Atras</a>
            </div>
        </div>
        <div class="portlet-body">
        <form id="form-estudios" class="form-horizontal" method="post">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            <div class="well well-lg">
                <fieldset>
                    
                    <div class="form-group">
                        <label for="hc" class="col-lg-2 control-label">Historia Clínica</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="hc" name="hc"
                                   value=" {!! $paciente[0]->id_hc !!}"
                                   readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nombre" class="col-lg-2 control-label">Apellido, Nombre</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="nombre" name="nombre"
                                   value=" {!! $paciente[0]->apellido.", ".$paciente[0]->nombre !!}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tipo" class="col-lg-2 control-label">Tipo de Estudio</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="tipo" name="tipo"
                                   value=" {!! $estudioPaciente->estudio->nombre !!}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fecha" class="col-lg-2 control-label">Fecha</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control datepicker" id="fecha" name="fecha"
                                   value=" {!! \Carbon\Carbon::parse($estudioPaciente->fecha)->format('d/m/Y') !!}"
                                   required
                            >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="titulo" class="col-lg-2 control-label">Titulo</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="titulo" name="titulo"
                                   value=" {!! $estudioPaciente->titulo !!}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="estudio_desc" class="col-lg-2 control-label">Descripción</label>
                        <div class="col-lg-10">
                        <textarea  class="form-control"  id="estudio_desc" name="estudio_desc" required>{!! $estudioPaciente->descripcion !!}</textarea>
                             
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <a href="{{ URL::previous() }}" class="btn btn-default">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="well well-lg">
                <fieldset>
                    <legend>Campos del estudio</legend>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Campo</th>
                            <th>Valor</th>
                            <th>Observación</th>
                            <th class="text-center">Unidad de Medida</th>
                            <th class="text-center">Ref. Min.</th>
                            <th class="text-center">Ref. Max.</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0; ?>
                        @foreach($estudioPaciente->valores as $valor)

                            <tr>
                                <td>{!! $valor->campoBase->descripcion !!}</td>
                                <td>@if($valor->campoBase->tipo=="número entero")<input type="number"
                                                                                        id="valor_{{ $i }}"
                                                                                        name=campos[{{ $i }}][valor]"
                                                                                        value="{!! (int) $valor->valor !!}">
                                    @elseif($valor->campoBase->tipo=="número con decimales") <input type="number"
                                                                                                    step="any"
                                                                                                    id="valor_{{ $i }}"
                                                                                                    name=campos[{{ $i }}][valor]"
                                                                                                    value="{!! (float) $valor->valor !!}">
                                    @elseif($valor->campoBase->tipo=="Verdadero/Falso") <input type="checkbox"
                                                                                               id="valor_{{ $i }}"
                                                                                               name=campos[{{ $i }}][valor]"
                                                                                               @if($valor->valor=="T" or $valor->valor=="on") checked @endif>
                                    @else <input type="text" id="valor_{{ $i }}" name=campos[{{ $i }}][valor]" value="{!! $valor->valor !!}">
                                    @endif
                                </td>
                                <td>
                                    <input type="text" id="obs_{{ $i }}" name=campos[{{ $i }}][obs]" value="{!! $valor->obs !!}">
                                    <input type="hidden" id="id_valor_{{ $i }}" name="campos[{{ $i }}][id_valor]" value="{!! $valor->id !!}">
                                    <input type="hidden" id="id_campo_base_{{ $i }}" name="campos[{{ $i }}][id_campo_base]" value="{!! $valor->campos_base_id !!}">
                                </td>
                                <td class="text-center">@if($valor->campoBase->UnidadMedida)
                                        @if($valor->campoBase->tipo == "Verdadero/Falso" or $valor->campoBase->tipo == "texto")
                                            N/A
                                        @else
                                            {!! $valor->campoBase->UnidadMedida->unidad !!}
                                        @endif
                                    @else -
                                    @endif
                                </td>
                                <td class="text-center">@if($valor->campoBase->tipo == "Verdadero/Falso" or $valor->campoBase->tipo == "texto")
                                        N/A
                                    @else
                                        {!! $valor->campoBase->ref_min !!}
                                    @endif
                                </td>
                                <td class="text-center">@if($valor->campoBase->tipo == "Verdadero/Falso" or $valor->campoBase->tipo == "texto")
                                        N/A
                                    @else
                                        {!! $valor->campoBase->ref_max !!}
                                    @endif
                                </td>
                            </tr>
                            <?php $i++; ?>
                        @endforeach
                        </tbody>
                    </table>
                </fieldset>
            </div>
        </form>
    </div>
     </div>
@endsection