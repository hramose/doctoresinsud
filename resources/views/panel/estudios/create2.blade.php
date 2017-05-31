@extends('master')
@section('title', 'Crea un nuevo estudio')

@section('scripts')
    <script src="{{url('/')."/js/vue.js"}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.7.4/vue-resource.js"></script> {{--TODO: Reemplazar por versión local--}}

    <script>
        $.datepicker.setDefaults($.datepicker.regional['es']);

        $(function() {
            $(".datepicker").datepicker();
        });


        Vue.component('myinput',{
            props: ['campo_id', 'index', 'tipo', 'campo'],
            computed: {
                tipoCalc: function () {
                    //console.log(this.tipo);
                    switch(this.tipo){
                        case "texto":
                            return "text";
                        case "número entero":
                            return "number";
                        case "número con decimales":
                            return "number";
                        case "Verdadero/Falso":
                            return "checkbox";
                    }
                },
                step: function () {
                    if (this.tipo === "número con decimales"){
                        return "any";
                    }
                    return "";
                }
            },
            template: '#input-template'
        });


        new Vue({
            el: 'body',
            data: {
                idEstudio: "",
                listado: []
            },
            methods: {
                refrescarListado: function () {
                    var vm = this;
                    if(vm.idEstudio !== "") {
                        this.$http.get(window.location.origin + '/api/estudios/' + vm.idEstudio, function (listado) {

                            this.listado = listado;

                        });
                    } else {
                        this.listado = [];
                    }
                }
            }
        });
    </script>
@endsection

@section('script_datatables')
    ,"language": {
    "url": "../../../../lang/datatables_es.json"
    }
@endsection

@section('content')
    <template id="input-template">
        <input type="@{{ tipoCalc }}" step="@{{ step }}" id="'valor_@{{ campo_id }}" name="campos[@{{index }}][valor]">
    </template>

    <div class="container col-md-8 col-md-offset-2">
            <form id="form-estudios" class="form-horizontal" method="post">
                <div class="well well bs-component">
                @foreach ($errors->all() as $error)
                    <p class="alert alert-danger">{{ $error }}</p>
                @endforeach

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <input type="hidden" name="_token" value="{!! csrf_token() !!}">

                <fieldset>
                    <legend>Crea un nuevo estudio</legend>
                    <p><span class="col-lg-2 text-right"><strong>Historia Clínica </strong></span>{!! $paciente->id_hc !!}</p>
                    <p><span class="col-lg-2 text-right"><strong>Apellido, Nombre </strong></span>{!! $paciente->apellido . ", " . $paciente->nombre !!}</p>
                    {!! Form::hidden('id_hc', $paciente->id_hc) !!}
                    <div class="form-group">
                        <label for="fecha" class="col-lg-2 control-label">Fecha</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control datepicker" id="fecha" name="fecha" value="{!! old('fecha') !!}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="titulo" class="col-lg-2 control-label">Titulo</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="titulo" name="titulo"
                                   value="{!! old('titulo') !!}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="estudio_desc" class="col-lg-2 control-label">Descripción</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="estudio_desc" name="estudio_desc"
                                   value="{!! old('estudio_desc') !!}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tipo" class="col-lg-2 control-label">Tipo de Estudio</label>
                        <div class="col-lg-10">
                            <select name="tipo" id="tipo" class="form-control" @change="refrescarListado" v-model="idEstudio" required>
                                <option value=""></option>
                                @foreach($estudios as $estudio)
                                    <option value="{!! $estudio->id !!}">{!! $estudio->nombre !!}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <input type="hidden" id="id_estudio" name="id_estudio" value="@{{ idEstudio }}">

                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <a href="{{ URL::previous() }}" class="btn btn-default">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="well well-lg">
                <fieldset>
                    <legend>Campos del estudio</legend>
                    <table class="table" {{--id="myTable"--}}>
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
                        <tbody id="campos" v-show="listado.length != 0">
                        <tr v-for="campo in listado">
                            <td>
                                <input type="hidden" id="@{{ 'tipo_' + campo.id }}" name="campos[@{{$index }}][tipo]" value="@{{campo.tipo}}">
                                <input type="hidden" id="id_campo_base" name="campos[@{{$index }}][id_campo_base]" value="@{{ campo.id }}">
                                <p> @{{ campo.descripcion }}</p>
                            </td>
                            <td>
                                {{--<input type="text" id="@{{ 'valor_' + campo.id }}" name="campos[@{{$index }}][valor]">--}}
                                <myinput :campo_id="campo.id", :index="$index", :tipo="campo.tipo", :campo="valor"></myinput>
                            </td>
                            <td>
                                <input type="text" id="@{{ 'obs_' + campo.id }}" name="campos[@{{$index }}][obs]">
                            </td>
                            <td>
                                <p v-if="campo.unidad_medida !== null">
                                    @{{ campo.unidad_medida.unidad }}
                                </p>
                            </td>
                            <td>
                                <p>@{{campo.ref_min}}</p>
                            </td>
                            <td>
                                <p>@{{campo.ref_max}}</p>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </fieldset>
            </div>
        </form>
    </div>
@endsection