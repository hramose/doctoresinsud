@extends('master')
@section('title', 'Unidades de Medida')
@section('content')
<h3 class="page-title">Listado de <b>Unidades de Medida</b>  </h3>
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
            <a href="#">Unidades de Medida</a>
         </li>
    </ul>
</div>


   <div class="portlet box grey-cascade"  >
        <div class="portlet-title">
            <div class="caption">
                 <a href="{!! action('Admin\UnidadesMedidaController@create') !!}" class="btn btn-info btn-raised">Crear</a>
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
            @if ($unidadesMedida->isEmpty())
                <p> No hay unidades de medida creadas.</p>
            @else
                <table class="table" id="myTableUnidadesMedida">
                    <thead>
                    <tr>
                        <th>Unidad</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($unidadesMedida as $unidadMedida)
                        <tr>
                            <td>{!! $unidadMedida->unidad !!}</td>
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
            $('#myTableUnidadesMedida').DataTable( {
                "language": {
                    "url": "../../lang/datatables_es.json"
                }
            });

        });
    </script>
@endsection