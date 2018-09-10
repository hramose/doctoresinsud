@extends('master')
@section('title', 'Editar tratamiento')

@section('scripts')
<script>
    $.datepicker.setDefaults($.datepicker.regional['es']);

    $(function() {
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
            <div class="caption">Editar tratamiento</div>
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

                <fieldset>
                     <p><span class="col-lg-2 text-right"><strong>Historia Clínica </strong></span>{!! $paciente->id_hc !!}</p>
                    <p><span class="col-lg-2 text-right"><strong>Apellido, Nombre </strong></span>{!! $paciente->apellido . ", " . $paciente->nombre !!}</p>
                    {!! Form::hidden('id_hc', $paciente->id_hc) !!}
                    <div class="form-group">
                        <label for="droga" class="col-lg-2 control-label">Droga</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="droga" name="droga" value="@if(old('droga')){!! old('droga') !!}@else{!! $tratamiento->droga !!}@endif">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="flia_droga" class="col-lg-2 control-label">Familia Droga</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="flia_droga" name="flia_droga" value="@if(old('flia_droga')){!! old('flia_droga') !!}@else{!! $tratamiento->flia_droga !!}@endif">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="dosis" class="col-lg-2 control-label">Dosis</label>
                        <div class="col-lg-10">
                            <input type="number" step="0.10" class="form-control" id="dosis" name="dosis" value="@if(old('dosis')){!! old('dosis') !!}@else{!! $tratamiento->dosis !!}@endif">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="fecha_trat" class="col-lg-2 control-label">Fecha</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control datepicker" id="fecha_trat" name="fecha_trat" value="@if(old('fecha_trat')){!! old('fecha_trat') !!}@else{!! \Carbon\Carbon::parse($tratamiento->fecha_trat)->format('d/m/Y') !!}@endif">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="obs_trat" class="col-lg-2 control-label">Descripción</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="obs_trat" name="obs_trat" value="@if(old('obs_trat')){!! old('obs_trat') !!}@else{!! $tratamiento->obs_trat !!}@endif">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <a href="{{ URL::previous() }}" class="btn btn-default">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection