@extends('master')
@section('title', '>Crea un nuevo Tratamiento')

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
                    <legend>Crea un nuevo Tratamiento</legend>


                    

                    <div class="form-group">
                        <label for="nombre" class="col-lg-2 control-label">Titulo</label>
                        <div class="col-lg-10">
                            <input type="name" class="form-control" id="titulo" name="titulo">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nombre" class="col-lg-2 control-label">Descripci&oacute;n</label>
                        <div class="col-lg-10">
                            <textarea class="form-control" id="descripcion" name="descripcion"> </textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="nombre" class="col-lg-2 control-label">Observaciones</label>
                        <div class="col-lg-10">
                            <textarea class="form-control" id="observaciones" name="observaciones"> </textarea>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="reset" class="btn btn-default">Cancel</button>
                            <button type="submit" class="btn btn-primary">Guardar Datos</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection 