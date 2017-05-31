@extends('master')
@section('title', 'Editar Estudio')

@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <form class="form-horizontal" method="post">
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
                    <legend>Editar estudio</legend>

                    <!-- Nombre -->
                    <div class="form-group">
                        <label for="nombre" class="col-lg-2 control-label">Nombre</label>
                        <div class="col-lg-10">
                            <input type="name" class="form-control" id="nombre" name="nombre" value="{!! $estudio->nombre !!}">
                        </div>
                    </div>

                    <!-- Nombre -->
                    <!-- Observaciones -->
                    <div class="form-group">
                        <label for="observaciones" class="col-lg-2 control-label">Observaciones</label>
                        <div class="col-lg-10">
                            <input type="textarea" class="form-control" id="observaciones" name="observaciones" value="{!! $estudio->obs !!}">
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            {{--<button type="reset">--}}
                                <a class="btn btn-default" href="{{ URL::previous() }}">Cancelar</a>
                            {{--</button>--}}
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                    </div>
                </fieldset>

            </div>
            <div class="well well bs-component">
                {{--<button type="button" id="agrega">Agregar</button>--}}
                <fieldset id="campos">
                    <legend>Campos del Estudio</legend>
                    <div id="ui_campo_1">
                        {{--<label for="campo_1">Campo 1: </label>--}}
                        <select class="chosen-select" multiple name="campos[]" id="campo_1">
                            @foreach($camposbase as $campo)
                                <option value="{!! $campo->id !!}" @if(in_array($campo->id, $camposSeleccionados))
                                selected="selected" @endif> {!! $campo->descripcion !!}</option>
                            @endforeach
                        </select>
                    </div>
                </fieldset>
            </div>
        </form>
    </div>

@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $(".chosen-select").chosen({
            no_results_text: "No se encontraron resultados para las palabras ingresadas",
            width: "95%",
            placeholder_text_multiple: "Seleccione del listado los campos o escriba para reducir los resultados "
        });
    });
</script>
@endsection