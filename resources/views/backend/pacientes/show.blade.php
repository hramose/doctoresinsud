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
                            
                            
                                @foreach($usuarios as $usuario)
                                    @if(in_array($usuario->id, $selectedUsers))
                                        {!! $usuario->name.' ,' !!}         
                                    @endif 
                                    
                                @endforeach
                           
                        </div>



                    </div>

                    <div class="form-group">
                        <label for="nombre" class="col-lg-2 control-label">Nombre</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="nombre" name="nombre"  value="{{ $paciente->nombre }}" disabled>
                        </div>
                    </div>
                      <div class="form-group">
                        <label for="Apellido" class="col-lg-2 control-label">Apellido</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="apellido" name="apellido" value="{{ $paciente->apellido }}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="telefono" class="col-lg-2 control-label">Telefonos</label>
                        <div class="col-lg-10">
                            <input type="phone" class="form-control" id="telefono" name="telefono" value="{{ $paciente->telefono }}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="direccion" class="col-lg-2 control-label">Dirección</label>
                        <div class="col-lg-10">
                            <input type="" class="form-control" id="direccion" name="direccion" value="{{ $paciente->direccion }}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-lg-2 control-label">Email</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="email" name="email" value="{{ $paciente->email }}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sexo" class="col-lg-2 control-label">sexo</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="sexo" name="sexo" value="@if($paciente->sexo == 'f') Femenino @elseif($paciente->sexo == 'm') Masculino @endif" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="origen" class="col-lg-2 control-label">Origen</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="origen" name="origen" value="{{ $paciente->origen }}">
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <a href="{!! action('Admin\PacientesController@index') !!}" class="btn btn-primary"> <- Volver</a>
                            
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection 