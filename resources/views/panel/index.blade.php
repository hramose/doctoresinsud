@extends('master')

@include('shared.estilos')

@section('title', 'Panel de Historias Clínicas')

@section('content')


<h3 class="page-title">Listado de <b>Historias clínicas</b></h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{ URL::to('/') }}/">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="#">Historias Clínicas</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="#">Listar</a>
        </li>
    </ul>
</div>


<div class="row">
                <div class="col-md-12">
                    <form class="form-horizontal form-row-seperated" action="#">
                        <div class="portlet box grey-cascade">
                            <div class="portlet-title">
                                
                                <div class="actions btn-set">
                                    <a href="{{ URL::to('/') }}/" type="button" name="back" class="btn default"><i class="fa fa-angle-left"></i> Atras</a>
                                  </div>
                            </div>
                            <div class="portlet-body">
                                <div class="table-container">
                                    <div class="table-toolbar">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="btn-group">
                                            <a href="{!! action('Panel\PanelHistoriasController@create') !!}" id="sample_editable_1_new" class="btn green">
                                           Cargar nueva Historia Clínica <i class="fa fa-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="btn-group pull-right">
                                          
                                        </div>
                                    </div>
                                </div>
                            </div>

                                    <table class="table table-striped table-bordered table-hover" id="myTable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>ID Historia Clinica</th>
                                                <th>Apellido</th>
                                                <th>Nombre</th>
                                                <th>Fecha de Ingreso</th>
                                                <th>Fecha de Ultima Consulta</th>
                                                {{--<th>Opciones</th>--}}
                                            </tr>
                                        </thead>

                                    </table>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
 

    

     
@endsection

@section('script_datatables')
    ,"ajax": {
        "url":"{{ asset('/panel/ajax/hhcc') }}",
        "dataSrc": ""
    },
    "columns": [
        { "data": "id" },
        { "data": "id_hc",
           "render": function(data, type, row){
                return '<a href="{{ asset('/panel/paciente') }}/' + row.id +'">' + row.id_hc + '</a>'
            }
        },
        { "data": "apellido" },
        { "data": "nombre" },
        { "data": "fecha_alta",
          "render": function(data, type, row){ return moment(row.fecha_alta).format('DD/MM/YYYY')}
        },
        { "data": "fecha_ult_consulta",
          "render": function(data, type, row){ return moment(row.fecha_ult_consulta).format('DD/MM/YYYY')}
        }
    ],
    "columnDefs": [
        {
            "targets": 0,
            "visible": false,
            "searchable": false
        }
    ]
@endsection
