@extends('master')
@section('title', 'Campos Base')
@section('content')

    <div class="container col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2> Campos base </h2>
            </div>
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
<div class="form-group">
        <div class="col-lg-10 col-lg-offset-2">
            <a href="{!! action('Admin\PagesController@home') !!}" class="btn btn-primary"> <- Volver a panel de administración</a>
            
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