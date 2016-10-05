@extends('master')

@include('shared.estilos')

@section('title')
    Historia Clínica - {!! $paciente->apellido . "," . $paciente->nombre !!} - Nueva Consulta
@endsection

@section('content')
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body" id="limpieza">
                    <div class="well well-lg">
                        <form id="form-nueva-consulta" method="post" action="{{ URL::action('Panel\PanelHistoriasController@nuevaConsulta') }}" class="form-horizontal">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                            <fieldset>
                                <legend>Nueva consulta</legend>

                                <div class="form-group" style="vertical-align: middle">
                                    <input type="hidden" name="id_usuario" value="{{ Auth::user()->id }}">
                                    <label for="medico" class="col-lg-2 control-label"
                                           style="padding-top:0;">Médico</label>
                                    <p id="medico" name="medico">
@if(Auth::check())
{{ Auth::user()->name }}
@endif
</p>

</div>

<input type="hidden" id="id_paciente" name="id_paciente" value="{{ $paciente->id }}">
<input type="hidden" id="hidden_descripcion" name="hidden_descripcion">

<div class="form-group">
    <label for="title" class="col-lg-2 control-label">Titulo</label>
    <div class="col-lg-10">
        <input type="text" class="form-control" id="titulo" placeholder="Titulo"
               name="titulo" data-validation="required" data-validation-length="min4">
    </div>
</div>
<div class="form-group">
    <label for="content" class="col-lg-2 control-label">Descripcion</label>
    <div class="col-lg-10">
                                        <textarea class="form-control" rows="3" id="editor_descripcion"
                                                  name="descripcion"></textarea>
    </div>
</div>
<button type="submit" class="btn btn-success" id="submitConsulta" style="float: right;">Guardar</button>
<button type="button" class="btn btn-danger" data-dismiss="modal" style="float: right;">Cancelar</button>
</fieldset>
</form>
</div>
</div>
{{--                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success" data-dismiss="modal">Guardar</button>
                </div>--}}
</div>
</div>

@endsection
