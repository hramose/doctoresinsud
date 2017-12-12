@extends('master')
@section('title', 'Campos Base')
@section('content')
<h3 class="page-title">Listado de <b>Campos Base</b>  </h3>
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
            <a href="#">Campos Base</a>
         </li>
    </ul>
</div>
   <div class="portlet box grey-cascade"  >
        <div class="portlet-title">
            <div class="caption">
                 <a href="{!! action('Admin\CamposBaseController@create') !!}" class="btn btn-info btn-raised">Crear</a>
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
            @if ($camposBase->isEmpty())
                <p> No hay campos base creados.</p>
            @else
                <table class="table" id="myTableCamposBase">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Tipo</th>
                        <th>Unidad</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($camposBase as $campoBase)
                        <tr>
                            <td>{!! $campoBase->nombre !!}</td>
                            <td>{!! $campoBase->descripcion !!}</td>
                            <td>{!! $campoBase->tipo !!}</td>
                            <td>{!! $campoBase->unidad !!}</td>
                            <td><a href="{!! action('Admin\CamposBaseController@edit', $campoBase->id) !!}" class="btn btn-sm btn-primary">Editar</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
 
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $('#myTableCamposBase').DataTable( {
                "language": {
                    "url": "../../lang/datatables_es.json"
                }
            });

        });
    </script>
@endsection