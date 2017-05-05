@extends('master')
@section('title', 'Todas las sedes')
@section('content')
<h3 class="page-title">Listado de <b>Sedes</b>  </h3>
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
            <a href="#">Sedes</a>
         </li>
    </ul>
</div>
 <div class="portlet box grey-cascade"  >
        <div class="portlet-title">
            <div class="caption">
                 <a href="{!! action('Admin\SedesController@create') !!}" class="btn btn-info btn-raised">Crear</a>
            </div>
             <div class="actions btn-set">
                <a href="{!! action('Admin\PagesController@home') !!}" type="button" name="back" class="btn default"><i class="fa fa-angle-left"></i> Atras</a>
            </div>

        </div>
        <div class="portlet-body">
            
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if ($sedes->isEmpty())
                <p> No hay sedes creadas.</p>
            @else
                <table class="table" id="myTable">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Teléfonos</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($sedes as $sede)
                        <tr>
                            <td>
                                <a href="{!! action('Admin\SedesController@edit', $sede->id) !!}">{!! $sede->nombre !!} </a>
                            </td>
                            <td>{!! $sede->telefonos !!}</td>
                            <td><a class="btn btn-danger btn-xs"   href="{!! action('Admin\SedesController@show', $sede->id) !!}">Eliminar</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
 
@endsection