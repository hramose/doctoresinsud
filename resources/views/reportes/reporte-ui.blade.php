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
       
        <div class="portlet-body ">
            <div id="report-main" class="row" >

                @foreach ($tables as $table)
                <div class="col-lg-12 itemmo">
                            

                       
                    @if (!in_array($table->{$tablas_en_db}, $hide_tables))

    <div class="panel panel-default">
        <div class="panel-heading"> 
                          <label for="table_{{ $table->{$tablas_en_db} }}"> <h2  class="panel-title"> 
                                <input type="checkbox" id="table_{{ $table->{$tablas_en_db} }}" value="{{ $table->{$tablas_en_db} }}" class="choose">
                                {{ str_replace('_', ' ', ucfirst($table->{$tablas_en_db})) }}
                            </h2></label>
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
