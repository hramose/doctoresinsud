@extends('infopage')

@include('shared.estilos')

@section('title', 'Panel de Historias Clínicas')

@section('content')


 

<div class="containe-fluid ">
    <div class="row">
        <div class="col-md-12">
            <form class="form-horizontal form-row-seperated" action="#">
                <div class="portlet box grey-cascade">
                    <div class="portlet-title">
                        
                        <div class="caption">Historial de Modificación</div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-container">
                            
                            <table class="table table-striped table-bordered table-hover" >
                                <thead>
                                    <tr>
                                        <th>Fecha Modificación</th>
                                        <th>Valor</th>
                                        <th>Modificado por</th>
                                        <th>Estado</th>
                                     </tr>
                                </thead>
                                <tbody>
                                @foreach($historial as $h)
                                    <tr>
                                        <td>{{$h->created_at}}</td>
                                        <td>{{$h->valor}}</td>
                                        <td>{{$h->name}}</td>
                                        <td>@if($h->estado==1) Creación @else Modificación @endif</td>
                                     </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

