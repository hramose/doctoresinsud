@extends('master')
@section('title', 'Crea un nuevo campo base')

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
                    <legend>Crea un nuevo campo base</legend>
                    <div class="form-group">
                        <label for="nombre" class="col-lg-2 control-label">Nombre</label>
                        <div class="col-lg-10">
                            <input type="nombre" class="form-control" id="nombre" name="nombre">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="descripcion" class="col-lg-2 control-label">Descripción</label>
                        <div class="col-lg-10">
                            <input type="descripcion" class="form-control" id="descripcion" name="descripcion">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tipo" class="col-lg-2 control-label">Tipo</label>
                        <div class="col-lg-10">
                            <input type="tipo" class="form-control" id="tipo" name="tipo">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="select" class="col-lg-2 control-label">Unidad de Medida</label>

                        <div class="col-lg-10">
                            <select class="form-control" id="id_unidad" name="id_unidad">
                                <option value="" id="vacio"></option>
                                
                                @foreach($unidadesMedida as $unidadMedida)
                                <option value="{!! $unidadMedida->id !!}">
                                    {!! $unidadMedida->unidad !!}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ref_min" class="col-lg-2 control-label">Valor de Referencia Mínimo</label>
                        <div class="col-lg-10">
                            <input type="ref_min" class="form-control" id="ref_min" name="ref_min">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ref_max" class="col-lg-2 control-label">Valor de Referencia Máximo</label>
                        <div class="col-lg-10">
                            <input type="ref_max" class="form-control" id="ref_max" name="ref_max">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="reset" class="btn btn-default">Cancel</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection