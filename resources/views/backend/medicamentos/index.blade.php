@extends('master')
@section('title', 'Unidades de Medida')
@section('content')

<h3 class="page-title">Listado de <b>Medicamentos</b>  </h3>
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
            <a href="#">Medicamentos</a>
         </li>
    </ul>
</div>

    <div class="portlet box grey-cascade"  >
        <div class="portlet-title">
            <div class="caption">
                 <a href="{!! action('Admin\MedicamentosController@create') !!}" class="btn btn-info btn-raised">Crear</a>
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
            @if ($medicamentos->isEmpty())
                <p> No hay medicamentos cargados.</p>
            @else
                <table class="table" id="myTable">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($medicamentos as $medicamento)
                        <tr>
                            <td>{!! $medicamento->nombre_medicamento !!}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
 
@endsection