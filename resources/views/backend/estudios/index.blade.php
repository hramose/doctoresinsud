@extends('master')
@section('title', 'Todos los estudios')
@section('content')

<h3 class="page-title">Estudios  </h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{ URL::to('/') }}/">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{!! action('Admin\PagesController@home') !!}">Admin</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="#">Estudios</a>
         </li>
    </ul>
</div>
  <div class="portlet box grey-cascade"  >
        <div class="portlet-title">
            <div class="caption">
                 <a href="{!! action('Admin\EstudiosController@create') !!}" class="btn btn-info btn-raised">Crear</a>
            </div>
             <div class="actions btn-set">
                <a href="{{ URL::previous() }}" type="button" name="back" class="btn default"><i class="fa fa-angle-left"></i> Atras</a>
            </div>

        </div>
        <div class="portlet-body">
            
           
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if ($estudios->isEmpty())
                <p> No hay estudios creados.</p>
            @else
                <table class="table" id="myTable">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($estudios as $estudio)
                        <tr>
                            <td>
                                <a href="{!! action('Admin\EstudiosController@edit', $estudio->id) !!}">{!! $estudio->nombre !!} </a>
                            </td>
                            <td>{{-- <a class="btn btn-success btn-xs"   href="{!! action('Admin\EstudiosController@show', $estudio->id) !!}">Ver</a>--}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
      
@endsection