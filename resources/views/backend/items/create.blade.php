@extends('master')
@section('title', 'Create un nuevo item');

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
                <legend>Crea un nuevo item</legend>
                
                <div class="form-group">
                    <label for="select" class="col-lg-2 control-label">Médico</label>

                    <div class="col-lg-10">
                        <select class="form-control" id="user" name="user">
                            <option value="" id="vacio"></option>
                            
                            @foreach($usuarios as $usuario)
                            <option value="{!! $usuario->id !!}">
                                {!! $usuario->name !!}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="select" class="col-lg-2 control-label">Paciente</label>

                    <div class="col-lg-10">
                        <select class="form-control" id="paciente" name="paciente">
                            <option value=""></option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="title" class="col-lg-2 control-label">Titulo</label>
                    <div class="col-lg-10">
                        <input type="title" class="form-control" id="titulo" placeholder="Titulo" name="titulo">
                    </div>
                </div>
                <div class="form-group">
                    <label for="content" class="col-lg-2 control-label">Descripcion</label>
                    <div class="col-lg-10">
                        <textarea class="form-control" rows="3" id="descripcion" name="descripcion"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="title" class="col-lg-2 control-label">Path</label>
                    <div class="col-lg-10">
                        <input type="title" class="form-control" id="path" placeholder="Path" name="path">
                    </div>
                </div>
                <div class="form-group">
                    <label for="select" class="col-lg-2 control-label">Tipo de entrada</label>

                    <div class="col-lg-10">
                        <select class="form-control" id="tipo" name="tipo">
                            
                            <option value=""></option>
                            <option value="texto">texto</option>
                            <option value="video">video</option>
                            <option value="imagen">imagen</option>
                            <option value="audio">audio</option>
                            <option value="estudio">estudio</option>
                            
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <button type="reset" class="btn btn-default">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar item bitacora</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $('#user').on('change',function(){
            var data = $(this).val();
            $('#vacio').hide();
            $.ajax({
                url:data+"/getHistorias",
                type : "POST",
                data: {_token: CSRF_TOKEN},
                //data    :{ data1:data },
                dataType:"JSON",
                success : function(data){ 
                    
                        var option;
                        $('#paciente option').remove();

                       
                         $.each(data.pacientes, function() {
                            option = "<option value=" + this.id + ">" + this.nombre +"</option>";
                            $("#paciente").append(option);
                        });
                    
                }
            });
        });
    });
</script>
@endsection