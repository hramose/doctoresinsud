@extends('infopage')

@section('title')
    Historia Clínica - {!! $paciente->apellido . "," . $paciente->nombre !!} - Editar dirección
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
    var provincia="{!! old('provincia', $direccion->provincia) !!}";
    var pais="{!! old('pais', $direccion->pais) !!}";
     
    
    $(function() {
    $("#pais").val(pais);
    $("#provincia").val(provincia);
    
   
});
    
     function cambiarProvincia(value){
        if(value!="ARG"){
            $("#provincia").val(value);
        }else{
            $("#provincia").val("CF");
        }
    }
    
</script>
@endsection

@section('content')
    <div class="panel panel-primary" style="margin-top: -20px   ">
         
        <div class="container col-md-8 col-md-offset-2">
            <div class="well well bs-component">
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
                    <input type="hidden" name="id_paciente" value="{!! $paciente->id !!}">

                    <fieldset>
                        <legend>Editar dirección</legend>
                        <div class="row">
                            <label for="calle" class="col-lg-2 control-label">Calle</label>
                            <div class="col-lg-5">
                                <input type="text" class="form-control" id="calle" name="calle"
                                       value="{!! old('calle', $direccion->calle) !!}">
                            </div>
                            <label for="altura" class="col-lg-2 control-label">Altura</label>
                            <div class="col-lg-2">
                                <input type="number" class="form-control" id="altura" name="altura"
                                       value="{!! old('altura', $direccion->altura) !!}">
                            </div>
                        </div>
                        <div class="row">
                            <label for="piso" class="col-lg-2 control-label">Piso</label>
                            <div class="col-lg-2">
                                <input type="number" class="form-control" id="piso" name="piso"
                                       value="{!! old('piso', $direccion->piso) !!}">
                            </div>
                            <label for="departamento" class="col-lg-2 control-label">Departamento</label>
                            <div class="col-lg-2">
                                <input type="text" class="form-control" id="departamento" name="departamento"
                                       value="{!! old('departamento', $direccion->departamento) !!}">
                            </div>
                            <label for="codigo_postal" class="col-lg-2 control-label">Código Postal</label>
                            <div class="col-lg-2">
                                <input type="text" class="form-control" id="codigo_postal" name="codigo_postal"
                                       value="{!! old('codigo_postal', $direccion->codigo_postal) !!}">
                            </div>
                        </div>
                        
                            
                        <div class="row">
                            <label for="pais" class="col-lg-2 control-label">Pais</label>
                            <div class="col-lg-10">
                                 
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
                        

                        <div class="row">
                            <label for="provincia" class="col-lg-2 control-label">Provincia</label>
                            <div class="col-lg-10">
                               
                                
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
                        <div class="row">
                            <label for="localidad" class="col-lg-2 control-label">Localidad</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="localidad" name="localidad"
                                       value="{!! old('localidad', $direccion->localidad) !!}">
                            </div>
                        </div>                        <div class="row">
                            <label for="activo" class="col-lg-2 control-label">Activo</label>
                            <div class="col-lg-2">
                                {!! Form::checkbox('activo', old('activo',2), in_array(old('activo', $direccion->activo), array('on', 2)) ?  true : false, ['class'=>'form-control', 'id'=>'activo']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <a href="{!! action('Panel\DireccionesController@index', $paciente->id) !!}" class="btn btn-default">Cancelar</a>
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@endsection