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
                                        <th>Campo</th>
                                        <th>Valor</th>
                                        <th>Modificado por</th>
                                      
                                     </tr>
                                </thead>
                                <tbody>
                                @foreach($historial as $h)
                                    <tr>
                                        <td>{{$h->created_at}}</td>
                                        <td>{{$h->field}}</td>
                                        <td>{{$h->valor}}</td>
                                        <td>{{$h->name}}</td>
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

