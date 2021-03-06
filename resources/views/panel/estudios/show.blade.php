     <link href="{{ asset('/css/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>

    <div class="containe-fluid ">
        <div class="well well-lg">
            <fieldset>
                <legend>
                    Detalle de Estudio
                </legend>
                <div class="row">
                    <label for="hc" class="col-lg-2 control-label">Historia Clínica</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="hc" name="hc" value=" {!! $paciente[0]->id_hc !!}"
                               readonly>
                    </div>
                </div>
                <div class="row">
                    <label for="nombre" class="col-lg-2 control-label">Apellido, Nombre</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="nombre" name="nombre"
                               value=" {!! $paciente[0]->apellido.", ".$paciente[0]->nombre !!}" readonly>
                    </div>
                </div>
                <div class="row">
                    <label for="tipo" class="col-lg-2 control-label">Tipo de Estudio</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="tipo" name="tipo"
                               value=" {!! $estudioPaciente->estudio->nombre !!}" readonly>
                    </div>
                </div>
                <div class="row">
                    <label for="fecha" class="col-lg-2 control-label">Fecha</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="fecha" name="fecha"
                               value=" {!! \Carbon\Carbon::parse($estudioPaciente->fecha)->format('d/m/Y') !!}"
                               readonly>
                    </div>
                </div>
                <div class="row">
                    <label for="titulo" class="col-lg-2 control-label">Titulo</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="titulo" name="titulo"
                               value=" {!! $estudioPaciente->titulo !!}" readonly>
                    </div>
                </div>
                <div class="row">
                    <label for="estudio_desc" class="col-lg-2 control-label">Descripción</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="estudio_desc" name="estudio_desc"
                               value=" {!! $estudioPaciente->descripcion !!}" readonly>
                    </div>
                </div>
                 <div class="row">
                    <label for="estudio_desc" class="col-lg-2 control-label">Imágenes</label>
                    <div class="col-lg-10">
 
                        @foreach($estudioPaciente->imagenes as $imagen)
                            <div class="col-xs-3">
                                <a href="{{$imagen->img}}" target="_blank" > <img src="{{$imagen->img}}" width="200" /></a>
                            </div>
                        @endforeach
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
                    @foreach($estudioPaciente->valores as $valor)
                        <tr>
                            <td>{!! $valor->campoBase->descripcion !!}</td>
                            <td>@if($valor->campoBase->tipo=="número entero"){!!  $valor->valor !!}
                                @elseif($valor->campoBase->tipo=="número con decimales") {!!  $valor->valor !!}
                                @elseif($valor->campoBase->tipo=="Verdadero/Falso") @if($valor->valor=="T" or $valor->valor=="on") Si @else
                                        No @endif
                                @else {!! $valor->valor !!}
                                @endif
                            </td>
                            <td>{!! $valor->obs !!}</td>
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
                    @endforeach
                    </tbody>
                </table>
            </fieldset>
        </div>
 