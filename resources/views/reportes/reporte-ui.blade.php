@extends('master')
@section('title', 'Home')

@include('shared.estilos')

@section('content')


<h3 class="page-title">Reportes</b>  </h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{ URL::to('/') }}/">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        
        <li>
            <a href="#">Reportes</a>
          </li>
    </ul>
</div>
<?php $tablas_en_db = 'Tables_in_' . env('DB_DATABASE'); ?>
<div class="portlet box grey-cascade"  >
    <div class="portlet-title">
        <div class="actions btn-set">
            <a href="{{ URL::to('/') }}/" type="button" name="back" class="btn default"><i class="fa fa-angle-left"></i> Atras</a>
        </div>
    </div>
    @if(false)
    <style>
        *, *:before, *:after {box-sizing:  border-box !important;}
        .row {
         -moz-column-width: 400px;
         -webkit-column-width: 400px;
         -moz-column-gap: .5em;
         -webkit-column-gap: .5em; 
          
        }

        .panel {
         display: inline-block;
         margin:  .5em;
         padding:  0; 
         width:98%;
        }
    </style>   
    @endif
    <div id="app">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>Generar reportes</h2>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="text-center">Columnas en el informe</h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="table">Tabla</label>
                                    <select name="table" id="table" class="form-control"  v-model="tableActive">
                                        <option :value="index" v-for="(table, index) in tables" v-on:click="selectTable(index)">@{{ table.name }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="columnF">Columna</label>
                                    <select name="column" id="column" class="form-control" v-model="columnActive">
                                        <option :value="index" v-for="(column, index) in tables[tableActive].fields">@{{ column.replace('_', ' ').toUpperCase() }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <a class="btn btn-primary" v-on:click="addColumn()">Agregar columna</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="text-center">Filtros</h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="table">Tabla</label>
                                    <select name="table" id="table" class="form-control"  v-model="filterTable">
                                        <option :value="index" v-for="(table, index) in tables" >@{{ table.name }}</option>
                                    </select>
                                </div>
                                <div class="form-group" >
                                    <label for="columnF">Columna</label>
                                    <select name="columnF" id="column" class="form-control" v-model="filterColumn">
                                        <option :value="index"  v-for="(column, index) in tables[filterTable].fields">@{{ column.replace('_', ' ').toUpperCase()  }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="condition">Condición</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <select name="condition" id="condition" v-model="filterType" class="form-control">
                                                <option :value="value.value" v-for="(value, index) in values">@{{ value.name }}</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" v-model="filterValue">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <a class="btn btn-primary" v-on:click="addFilter()">Agregar filtro</a>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="#!" class="btn btn-success" v-on:click="showTables" v-if="!activeTables">Vista Previa</a>
                <div v-if="activeTables">
                    <div class="row">
                        <div class="col-md-11">
                            <ul class="nav nav-tabs" >
                                <li role="presentation"  :class="activeT">
                                    <a href="#!" v-on:click="tabActive = 0"  :class="activeT">Tabla</a>
                                </li>
                                <li role="presentation"  :class="activeF">
                                    <a href="#!" v-on:click="tabActive = 1" :class="activeF">Filtros</a>
                                </li>

                            </ul>
                        </div>
                        <div class="col-md-1" class="text-center">
                            <br>
                            <a href="#!" v-on:click="showTables" class="btn btn-danger">
                                <i class="glyphicon glyphicon-eye-close"></i>
                            </a>
                        </div>
                    </div>
                    <div class="row" v-if="tabActive == 0">
                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                    <th v-for="(column, index) in columns">
                                        @{{ column.column }}
                                        <a href="#!" v-on:click="deleteColumn(index)"><span aria-hidden="true">&times;</span></a>
                                    </th>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="row" v-if="tabActive == 1">
                        <ul>
                            <li v-for="(filter, index) in filters">@{{ filter.column }} @{{ filter.condition }} @{{ filter.value }}
                                <a href="#!" v-on:click="deleteFilter(index)" ><span aria-hidden="true">&times;</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <form action="/reportGenerate" method="post">
                    {{ csrf_field() }}
                    <div v-for="(filter, index) in filters">
                        <input type="hidden" :name="'filter['+index+'][table]'" :value="filter.table">
                        <input type="hidden" :name="'filter['+index+'][column]'" :value="filter.column">
                        <input type="hidden" :name="'filter['+index+'][condition]'" :value="filter.condition">
                        <input type="hidden" :name="'filter['+index+'][value]'" :value="filter.value">
                    </div>
                    <div v-for="(column, index) in columns">
                        <input type="hidden" :name="'column['+index+'][table]'" :value="column.table">
                        <input type="hidden" :name="'column['+index+'][column]'" :value="column.column">
                    </div>
                    <button class="btn btn-primary" role="submit">Generar</button>
                </form>
            </div>
        </div>
    </div> 
    @if(false)
    <div class="portlet-body ">
        <div id="report-main" class="row" >
            @foreach ($tables as $table)
                <div class="col-lg-12 itemmo"> 
                    @if (!in_array($table->{$tablas_en_db}, $hide_tables))
                        <div class="panel panel-default">
                            <div class="panel-heading"> 
                                <label for="table_{{ $table->{$tablas_en_db} }}">
                                    <h2  class="panel-title"> 
                                        <input type="checkbox" id="table_{{ $table->{$tablas_en_db} }}" value="{{ $table->{$tablas_en_db} }}" class="choose">
                                        {{ str_replace('_', ' ', ucfirst($table->{$tablas_en_db})) }}
                                    </h2>
                                </label>
                            </div>
                            <div class="panel-body">
                                <ul class="list-group">
                                    @foreach (\DB::getSchemaBuilder()->getColumnListing($table->{$tablas_en_db}) as $key => $value)
                                        @if (!in_array($value, $hide_fields))
                                            <li  class="list-group-item">
                                                <div class="row">
                                                    <input type="checkbox"
                                                       value="{{ $value }}"
                                                       style="margin-left: 4px"
                                                       data-choose="{{ $table->{$tablas_en_db} }}"
                                                       id="{{ $table->{$tablas_en_db} }}__{{ $value }}"
                                                       class="col-xs-1" 
                                                       name="{{ $table->{$tablas_en_db} }}__{{ $value }}">
                                                    <label for="{{ $table->{$tablas_en_db} }}__{{ $value }}" 
                                                            style="cursor: pointer"
                                                            class="col-xs-5" 
                                                            >
                                                        {{ str_replace('_', ' ', ucfirst($value)) }} <br>
                                                    </label>
                                                    <div class="col-xs-4">
                                                        <button data-view="{{ $table->{$tablas_en_db} }}__{{ $value }}_close" class="hidden pull-right close-button">&times;</button>
                                                        <button data-view="{{ $table->{$tablas_en_db} }}__{{ $value }}_filter_value" class="hidden pull-right"></button>
                                                        <button data-view="{{ $table->{$tablas_en_db} }}__{{ $value }}_filter" class="hidden pull-right"></button>
                                                        <button data-view="{{ $table->{$tablas_en_db} }}__{{ $value }}_call" class="display-modal pull-right add-filter btn btn-default"
                                                                data-toggle="modal"
                                                                onclick="lightBox('{{ $table->{$tablas_en_db} }}__{{ $value }}')"
                                                                data-target=".modal">A&ntilde;adir filtro</button>
                                                    </div>
                                                </div> 
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif      
                </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"></h3>
            </div>
            <div class="modal-body">
                <table>
                    <tr>
                        <td><span class="modal-text-name"></span></td>
                        <td>
                            <select name="filter" class="form-control" id="filter">
                                <option value="">-- Elegir --</option>
                                <option value="=">igual</option>
                                <option value="&gt;=">mayor o igual</option>
                                <option value="&lt;=">menor o igual</option>
                                <option value="&gt;&lt;">distinto</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control"  value="" name="filter_value" id="filter_value">
                        </td>
                    </tr>
                </table>
                <input type="hidden" value="" id="filter_name">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="filter-apply">Aplicar filtro</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        String.prototype.capitalizeFirstLetter = function() {
            return this.charAt(0).toUpperCase() + this.slice(1);
        }
        function lightBox(obj) {
            var title = obj.split('__');
                title = title[0].replace('_', ' ');
            $('.modal').find('.modal-title').text(title.capitalizeFirstLetter())
            $('.modal').find('.modal-text-name').text($('label[for="'+obj+'"]').text())
            $('#filter_name').val(obj);
        }
        $(function(){
            $('.choose').on('click', function() {
                var checkboxes = $('*[data-choose="'+ $(this).val() +'"]');
                checkboxes.prop("checked", !checkboxes.prop("checked"));
            });
            $('.choose-title').on('click', function() {
                $(this).find('input').click();
            });
            $('.close-button').on('click', function() {
                var v = $(this).data('view');
                $('*[data-view="' + v + '"]').toggleClass('hidden')
                $('*[data-view="' + v.replace('_close', '_call') + '"]').toggleClass('hidden')
                $('*[data-view="' + v.replace('_close', '_filter') + '"]').toggleClass('hidden')
                $('*[data-view="' + v.replace('_close', '_filter_value') + '"]').toggleClass('hidden')
            });
            $('#filter-apply').on('click', function() {
                $('.modal').modal('hide');

                var filter = $('#filter').val();
                var filter_value = $('#filter_value').val();

                $('*[data-view="'+ $('#filter_name').val() +'_call"], *[data-view="'+ $('#filter_name').val() +'_close"]')
                    .toggleClass('hidden');

                $('*[data-view="'+ $('#filter_name').val() +'_filter"]')
                    .toggleClass('hidden')
                    .text(filter);

                $('*[data-view="'+ $('#filter_name').val() +'_filter_value"]')
                    .toggleClass('hidden')
                    .text(filter_value);
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js"></script>

    <script>
        
        var tablesUnProccess = "{{ json_encode($tables) }}";
        tablesUnProccess = tablesUnProccess.replace(/&quot;/g,'"');
        var tablesPro = JSON.parse(tablesUnProccess);
        var app = new Vue({
          el: '#app',
          data: {
            message: 'Hello Vue!',
            activeTables: false,
            filters: [],
            columns: [],
            columnActive: 0,
            tableActive: 0,
            filterTable: 0,
            filterColumn: 0,
            filterValue: '',
            filterType: '',
            tabActive: 0,
            values: [
                {name: 'Mayor que', value: '>'},
                {name: 'Menor que', value: '<'},
                {name: 'Igual que', value: '='},
                {name: 'Diferente a', value: '!='},
            ],
            tables: tablesPro,
                
         
          }, 
          
          methods: {
            showTables(){
                this.activeTables = !this.activeTables;
            },
            addFilter(){
                this.filters.push({ 
                    table: this.tables[this.filterTable].name,
                    column: this.tables[this.filterTable].fields[this.filterColumn],
                    value: this.filterValue,
                    condition: this.filterType
                });
                this.filterTable = 0;
                this.filterColumn = 0;
                this.filterValue = '';
                this.filterType = '';
            },
            addColumn(){
                this.columns.push({
                    table: this.tables[this.tableActive].name,
                    column: this.tables[this.tableActive].fields[this.columnActive]
                });
                this.tableActive = 0;
                this.columnActive = 0;
            },
            deleteFilter(index){
                this.filters.splice(index, 1);
            },
            deleteColumn(index){
                this.columns.splice(index, 1);
            }
          },
          computed: {
            activeF: function(){
                if(this.tabActive == 1){
                    return 'active';
                }else{
                    return '';
                }
            },
            activeT: function(){
                if(this.tabActive == 0){
                    return 'active';
                }else{
                    return '';
                }
            }
          }
    })

    </script>
    <style>
        #report-main .list-unstyled li {
            transition: 0.2s ease 0.2s;
        }
        #report-main .list-unstyled li:hover {
            background: rgba(0,0,0,0.2);
        }
        .modal-body td {
            padding-top: 15px;
            padding-right: 20px;
        }
    </style>
@endsection
