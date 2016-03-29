@extends('master')

@include('shared.estilos')

@section('title', 'Historia Clínica - {!! $paciente->apellido . "," . $paciente->nombre !!}')

@section('content')
    <div class="panel panel-primary" style="margin-top: -20px   ">
        <div class="panel-heading">
            <h2 class="text-left" style="border-radius: 0">Historia Clínica de {!! $paciente->apellido . ", " . $paciente->nombre . " (H.C.:" . $paciente->id_hc . ")"!!}</h2>
        </div>
        <div class="panel-body">
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

                <div class="row">
                    <div class="col-lg-4">
                        {{--Columna Documento y Seguimiento--}}
                        {{--<div class="form-group">--}}
                            <label for="tipo_doc" class="col-lg-3 control-label">Tipo Documento</label>
                            <div class="col-lg-3">
                                <input type="text" class="form-control" id="tipo_doc" name="tipo_doc" value="{!! $paciente->tipo_doc !!}" readonly>
                            </div>
                        {{--</div>--}}
                        {{--<div class="form-group">--}}
                            <label for="numero_doc" class="col-lg-3 control-label">Nro. Documento</label>
                            <div class="col-lg-3">
                                <input type="text" class="form-control" id="numero_doc" name="numero_doc" value="{!! $paciente->numero_doc !!}" readonly>
                            </div>
                        {{--</div>--}}
                        <div class="row">
                            <div class="col-lg-12">
                                <fieldset style="border: solid 1px black">
                                    <legend>Seguimiento</legend>
                                    <div class="row">
                                        <label for="fecha_nac" class="col-lg-3 control-label">Fecha Nac.</label>
                                        <div class="col-lg-3">
                                            <input type="date" class="form-control" id="fecha_nac" name="fecha_nac" value="{!! $paciente->fecha_nac->format('d/m/Y') !!}" readonly>
                                        </div>
                                        <label for="edad_ing" class="col-lg-3 control-label">Edad al ingreso</label>
                                        <div class="col-lg-3">
                                            <input type="number" class="form-control" id="edad_ing" name="edad_ing" value="{!! $paciente->fecha_alta->diffInYears($paciente->fecha_nac) !!}" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="fecha_alta" class="col-lg-3 control-label">Fecha Ing.</label>
                                        <div class="col-lg-3">
                                            <input type="date" class="form-control" id="fecha_alta" name="fecha_alta" value="{!! $paciente->fecha_alta->format('d/m/Y') !!}" readonly>
                                        </div>
                                        <label for="anios_seg" class="col-lg-3 control-label">Años Seguimiento.</label>
                                        <div class="col-lg-3">
                                            <input type="number" class="form-control" id="anios_seg" name="anios_seg" value="{!! \Carbon\Carbon::now()->diffInYears($paciente->fecha_alta) !!}" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="fecha_ult_consulta" class="col-lg-3 control-label">Fecha Ult. Consulta</label>
                                        <div class="col-lg-3">
                                            <input type="date" class="form-control" id="fecha_ult_consulta" name="fecha_ult_consulta" value="{!! $paciente->fecha_ult_consulta->format('d/m/Y') !!}" readonly>
                                        </div>
                                        <label for="proxima_cita" class="col-lg-3 control-label">Próxima Cita</label>
                                        <div class="col-lg-3">
                                            <input type="date" class="form-control" id="proxima_cita" name="proxima_cita" value="{!! $paciente->proxima_cita->format('d/m/Y') !!}" readonly>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        {{--//Columna Serología--}}
                        <div class="col-lg-12">
                        <fieldset style="border: solid 1px black">
                            <legend>Serología</legend>
                            <div class="row">
                                <label for="tres_negativas" class="col-lg-8 control-label">3 pruebas serológicas negativas</label>
                                <div class="col-lg-4">
                                    <input type="checkbox" class="form-control" id="tres_negativas" name="tres_negativas" @if($paciente->tres_negativas == 2) checked @endif readonly>
                                </div>
                            </div>
                            <div class="row">
                                <label for="serologia_ing" class="col-lg-8 control-label">Serología al ingreso</label>
                                <div class="col-lg-4">
                                    <input type="text" class="form-control" id="serologia_ing" name="serologia_ing" value="{!! $paciente->serologia_ing !!}" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <label for="titulos_sero_ing" class="col-lg-8 control-label">Titulos serológicos al ingreso</label>
                                <div class="col-lg-4">
                                    <input type="text" class="form-control" id="titulos_sero_ing" name="titulos_sero_ing" value="{!! $paciente->titulos_sero_ing !!}" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <label for="trat_etio" class="col-lg-8 control-label">Tratamiento Etiológico</label>
                                <div class="col-lg-4">
                                    <input type="text" class="form-control" id="trat_etio" name="trat_etio" value="@if($paciente->trat_etio=="S") Si @elseif($paciente->trat_etio=="N") No @endif" readonly>
                                </div>
                            </div>
                        </fieldset>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        //Columna Grupo Clínico
                    </div>
                    <div class="col-lg-1">
                        //Columna Estado Paciente
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection