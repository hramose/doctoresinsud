@extends('master')
@section('title', '>Crea un nuevo Paciente')

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
                    <legend>Crea un nuevo Paciente</legend>


                    <div class="form-group">
                        <label for="select" class="col-lg-2 control-label">Médico</label>

                        <div class="col-lg-10">
                            
                            <select class="form-control" id="medico" name="medico[]" multiple>
                                @foreach($usuarios as $usuario)
                                    <option value="{!! $usuario->id !!}"  @if(in_array($usuario->id, $selectedUsers))
                                            selected="selected" @endif >{!! $usuario->name !!}
                                    </option>
                                @endforeach
                            </select>
                        </div>



                    </div>

                    <div class="form-group">
                        <label for="nombre" class="col-lg-2 control-label">Nombre</label>
                        <div class="col-lg-10">
                            <input type="name" class="form-control" id="nombre" name="nombre"  value="{{ $paciente->nombre }}">
                        </div>
                    </div>
                      <div class="form-group">
                        <label for="nombre" class="col-lg-2 control-label">Apellido</label>
                        <div class="col-lg-10">
                            <input type="name" class="form-control" id="apellido" name="apellido" value="{{ $paciente->apellido }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="telefonos" class="col-lg-2 control-label">Telefonos</label>
                        <div class="col-lg-10">
                            <input type="phone" class="form-control" id="telefono" name="telefono" value="{{ $paciente->telefono }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="telefonos" class="col-lg-2 control-label">Dirección</label>
                        <div class="col-lg-10">
                            <input type="phone" class="form-control" id="direccion" name="direccion" value="{{ $paciente->direccion }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="telefonos" class="col-lg-2 control-label">Email</label>
                        <div class="col-lg-10">
                            <input type="phone" class="form-control" id="email" name="email" value="{{ $paciente->email }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="telefonos" class="col-lg-2 control-label">sexo</label>
                        <div class="col-lg-10">
                            <select type="phone" class="form-control" id="sexo" name="sexo">

                                <option value="f" @if($paciente->sexo == 'f') selected="selected" @endif>Femenino</option>
                                <option value="m" @if($paciente->sexo == 'm') selected="selected" @endif>Masculino</option>
                                
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="telefonos" class="col-lg-2 control-label">Origen</label>
                        <div class="col-lg-10">
                            <input type="phone" class="form-control" id="origen" name="origen" value="{{ $paciente->origen }}">
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="reset" class="btn btn-default">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection 