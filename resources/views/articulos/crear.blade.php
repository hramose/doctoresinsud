@extends('master')

@section('contenido')
    <h2>Crea un nuevo articulo: </h2>
    {!! Form::open() !!}
    <div class="form-group">
        {!! Form::label('titulo', 'Titulo:') !!}
        {!! Form::text('titulo', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('cuerpo', 'Cuerpo:') !!}
        {!! Form::textarea('cuerpo', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('fecha_publicacion', 'Fecha publicación:') !!}
        {!! Form::input('date', 'fecha_publicacion', Carbon\Carbon::now(), ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('categoria_id', 'Categoría:') !!}
        {!! Form::input('number', 'categoria_id', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Crear articulo', ['class'=>'btn btn-primary form-control']) !!}
    </div>


    {!! Form::close() !!}

    <a href="{{ URL::to('admin/articulos') }}">Volver a Articulos</a>
@stop