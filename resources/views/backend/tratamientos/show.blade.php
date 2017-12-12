@extends('master')
@section('title', '>Ver un tratamiento')

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
                    <legend>Ver Tratamiento</legend>

                    
                    

                    <div class="form-group">
                        <label for="titulo" class="col-lg-2 control-label">Titulo</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="titulo" name="titulo"  value="{{ $tratamiento->titulo }}" disabled>
                        </div>
                    </div>
                     

                     <div class="form-group">
                        <label for="nombre" class="col-lg-2 control-label">Descripci&oacute;n</label>
                        <div class="col-lg-10">
                            <textarea  class="form-control" id="descripcion" name="descripcion" disabled>{{ $tratamiento->descripcion }}</textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="nombre" class="col-lg-2 control-label">Observaciones</label>
                        <div class="col-lg-10">
                            <textarea  class="form-control" id="observacion" name="observacion"  disabled>{{ $tratamiento->observaciones }}</textarea>
                        </div>
                    </div>




                   
                   


                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <a href="{!! action('Admin\TratamientosController@index') !!}" class="btn btn-primary"> <- Volver</a>
                            
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection 