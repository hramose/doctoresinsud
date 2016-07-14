@extends('master')
@section('title', 'Crea un nuevo tratamiento')

@section('scripts')
<script>
    $.datepicker.setDefaults($.datepicker.regional['es']);

    $(function() {
        $(".datepicker").datepicker();
    });
</script>
@endsection

@section('content')
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

                <fieldset>
                    <legend>Crea un nuevo tratamiento</legend>
                    <p><span class="col-lg-2 text-right"><strong>Historia Clínica </strong></span>{!! $paciente->id_hc !!}</p>
                    <p><span class="col-lg-2 text-right"><strong>Apellido, Nombre </strong></span>{!! $paciente->apellido . ", " . $paciente->nombre !!}</p>
                    {!! Form::hidden('id_hc', $paciente->id_hc) !!}
                    <div class="form-group">
                        <label for="droga" class="col-lg-2 control-label">Droga</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="droga" name="droga" value="{!! old('droga') !!}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="flia_droga" class="col-lg-2 control-label">Familia Droga</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="flia_droga" name="flia_droga" value="{!! old('flia_droga') !!}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="dosis" class="col-lg-2 control-label">Dosis</label>
                        <div class="col-lg-10">
                            <input type="number" step="0.10" class="form-control" id="dosis" name="dosis" value="{!! old('dosis') !!}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="fecha_trat" class="col-lg-2 control-label">Fecha</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control datepicker" id="fecha_trat" name="fecha_trat" value="{!! old('fecha_trat') !!}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="obs_trat" class="col-lg-2 control-label">Descripción</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="obs_trat" name="obs_trat" value="{!! old('obs_trat') !!}">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <a href="{{ action('Panel\PanelHistoriasController@verHistoria', $paciente->id) }}" class="btn btn-default">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection