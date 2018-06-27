     <link href="{{ asset('/css/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>

    <div class="containe-fluid ">
        <div class="well well-lg">
            <fieldset>
                <legend>
                    {!! $estudioPaciente[0]->estudio->nombre !!}
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
            </fieldset>
        </div>
        <div class="well well-lg" style=" overflow-y: auto;">
            <fieldset>
                <legend>Campos del estudio</legend>
                <table class="table table-hover" >
                    <thead>
                        <th>Fecha</th>
                    @foreach($estudioPaciente[0]->valores as $lineValue)
                        <th>
                            {!! $lineValue->campoBase->descripcion !!}
                        </th>
                    @endforeach
                    </thead>
                    <tbody>
                        @foreach($estudioPaciente as $lineValueBody)
                            <tr>
                                <td>
                                    {!! \Carbon\Carbon::parse($lineValueBody->fecha)->format('d/m/Y') !!}
                                  
                                </td>
                                @foreach($lineValueBody->valores as $valores)
                                <td>
                                @if($valores->campoBase->tipo=="número entero"){!!  $valores->valor !!}
                                @elseif($valores->campoBase->tipo=="número con decimales") {!!  $valores->valor !!}
                                @elseif($valores->campoBase->tipo=="Verdadero/Falso") @if($valores->valor=="T" or $valores->valor=="on") Si @else
                                        No @endif
                                @else {!! $valores->valor !!}
                                @endif    
                        
                                </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </fieldset>
        </div>