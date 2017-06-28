@extends('infopage')

@section('title')
    Historia Clínica - {!! $paciente->apellido . "," . $paciente->nombre !!} - Direcciones
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

@endsection

@section('content')
    <div class="panel panel-primary" style="margin-top: -20px   ">
        
        <div class="  col-md-8 col-md-offset-2">
            <div class="well well bs-component">
                <form class="form-inline" method="post">

                    @foreach ($errors->all() as $error)
                        <p class="alert alert-danger">{{ $error }}</p>
                    @endforeach

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <input type="hidden" name="id_paciente" value="{!! $paciente->id !!}">
                    <fieldset>
                        <legend>Agregar nueva dirección</legend>
                        <div class="row">
                            <div class="col-xs-5 ">
                                <div class="form-group ">
                                    <div class="input-group">
                                        <div class="input-group-addon">Calle</div>
                                        <input type="text" class="form-control col-lg-12" id="calle" name="calle" value="{!! old('calle') !!}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group ">
                                    <div class="input-group">
                                        <div class="input-group-addon">Altura</div>
                                            <input type="text" class="form-control" id="altura" name="altura" value="{!! old('altura') !!}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group ">
                                    <div class="input-group">
                                        <div class="input-group-addon">Piso</div>
                                        <input type="number" class="form-control" id="piso" name="piso" value="{!! old('piso') !!}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br/>
                        <div class="row ">
                            
                            <div class="col-xs-4 ">
                                <div class="form-group ">
                                    <div class="input-group">
                                        <div class="input-group-addon">Departamento</div>
                                        <input type="text" class="form-control" id="departamento" name="departamento" value="{!! old('departamento') !!}">

                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group ">
                                    <div class="input-group">
                                        <div class="input-group-addon">Código Postal</div>
                                        <input type="text" class="form-control" id="codigo_postal" name="codigo_postal" value="{!! old('codigo_postal') !!}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                
                                <div class="form-group ">
                                    <div class="input-group">
                                        <div class="input-group-addon">Pais</div>
                                         
                                        <select class="form-control" onchange="cambiarProvincia(this.value)" id="pais" name="pais">
                                            <option value="ARG">Argentina</option>
                                            <option value="BOL">Bolivia</option>
                                            <option value="BRA">Brasil</option>
                                            <option value="CHI">Chile</option>
                                            <option value="PAR">Paraguay</option>
                                            <option value="PER">Perú</option>
                                            <option value="URU">Uruguay</option>
                                        </select>
                                    </div>
                                </div>
                                
                            </div>
                        </div>                        
                        
                        <br/>

                        <div class="row">
                            <div class="col-xs-5 ">
                                <div class="form-group ">
                                    <div class="input-group">
                                        <div class="input-group-addon">Localidad</div>
                                        <input type="text" class="form-control" id="localidad" name="localidad"
                                       value="{!! old('localidad') !!}">

                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group ">
                                    <div class="input-group">
                                        <div class="input-group-addon">Provincia</div>
                                 
                                        <select class="form-control"   id="provincia" name="provincia">
                                            <option value="BA">Buenos Aires</option>
                                            <option value="CF">Capital Federal</option>
                                            <option value="CA">Catamarca</option>
                                            <option value="CB">Córdoba</option>
                                            <option value="CH">Chaco</option>
                                            <option value="CO">Corrientes</option>
                                            <option value="CU">Chubut</option>
                                            <option value="ER">Entre Rios</option>
                                            <option value="FO">Formosa</option>
                                            <option value="JU">Jujuy</option>
                                            <option value="LP">La Pampa</option>
                                            <option value="LR">La Rioja</option>
                                            <option value="ME">Mendoza</option>
                                            <option value="MI">Misiones</option>
                                            <option value="NE">Neuquén</option>
                                            <option value="RN">Rio Negro</option>
                                            <option value="SA">Salta</option>
                                            <option value="SC">Santa Cruz</option>
                                            <option value="SE">Santiago del Estero</option>
                                            <option value="SF">Santa Fe</option>
                                            <option value="SJ">San Juan</option>
                                            <option value="SL">San Luis</option>
                                            <option value="TF">Tierra del Fuego</option>
                                            <option value="TU">Tucumán</option>
                                            <option value="EX">Provincias Externas</option>
                                            <option value="BOL">Bolivia</option>
                                            <option value="BRA">Brasil</option>
                                            <option value="CHI">Chile</option>
                                            <option value="PAR">Paraguay</option>
                                            <option value="PER">Perú</option>
                                            <option value="URU">Uruguay</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <!--<div class="form-group ">
                                    <div class="input-group">
                                        <div class="input-group-addon">{!! Form::checkbox('activo', old('activo',2), in_array(old('activo'), array('on', 2)) ?  true : false, ['class'=>'form-control', 'id'=>'activo']) !!} </div>
                                        <input type="text" class="form-control" id="pais" name="pais"
                                       value="{!! old('pais') !!}">
                                    </div>
                                </div>-->
                                 
                            <div class="input-group">
                                <span class="input-group-addon">
                                  <input type="checkbox" aria-label="...">
                                </span>
                                <input type="text" class="form-control" value="¿Activo?" disabled="">
                              </div><!-- /input-group -->
                            </div>
                        </div> 
                        
                      <br/>
                      <div class="row">
                          <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <button type="reset" class="btn btn-default">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                      </div>
                        
                    </fieldset>
                </form>
            </div>
        </div>
        <div class="  col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                @if ($direcciones->isEmpty())
                    <p>El paciente no posee direcciones.</p>
                @else
                    <div class="table-responsive">
                        <table class="table" id="direcciones">
                            <thead>
                            <tr>
                                <th>Calle</th>
                                <th>Altura</th>
                                <th>Piso</th>
                                <th>Departamento</th>
                                <th>Cod. Postal</th>
                                <th>Localidad</th>
                                <th>Provincia</th>
                                <th>País</th>
                                <th>Activo</th>
                                <th>Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($direcciones as $direccion)
                                <tr>
                                    <td>{!! $direccion->calle !!}</td>
                                    <td>{!! $direccion->altura !!}</td>
                                    <td>{!! $direccion->piso !!}</td>
                                    <td>{!! $direccion->departamento !!}</td>
                                    <td>{!! $direccion->codigo_postal !!}</td>
                                    <td>{!! $direccion->localidad !!}</td>
                                    <td>{!! $direccion->provincia !!}</td>
                                    <td>{!! $direccion->pais !!}</td>
                                    <td>{!! $direccion->activo == 2 ? 'Si' : 'No' !!}</td>
                                    <td>
                                        <a href="{!! action('Panel\DireccionesController@edit', ['id_p' => $paciente->id, 'id_d' => $direccion->id]) !!}"
                                           class="btn btn-xs btn-primary">Editar</a>
                                        <a href="{!! action('Panel\DireccionesController@showForDelete', ['id_p' => $paciente->id, 'id_d' => $direccion->id]) !!}"
                                           class="btn btn-xs btn-danger">Borrar</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

<script>
function cambiarProvincia(value){
    if(value!="ARG"){
        $("#provincia").val(value);
    }else{
        $("#provincia").val("CF");
    }
 }

</script>
@endsection