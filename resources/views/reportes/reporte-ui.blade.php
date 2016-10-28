@extends('master')
@section('title', 'Home')

@include('shared.estilos')

@section('content')


    <div class="container">
        <div class="well well bs-component">
            <div id="report-main" class="row banner">

                @foreach ($tables as $table)
                <div class="col-lg-4">
                    @if (!in_array($table->Tables_in_dyt, $hide_tables))

                        <h2 class="choose-title">
                            <input type="checkbox" value="{{ $table->Tables_in_dyt }}" class="choose">
                            {{ str_replace('_', ' ', ucfirst($table->Tables_in_dyt)) }}
                            {{-- <span class="pull-right">&#8595;</span> --}}
                        </h2>

                        <ul class="list-unstyled">
                        @foreach (\DB::getSchemaBuilder()->getColumnListing($table->Tables_in_dyt) as $key => $value)
                            @if (!in_array($value, $hide_fields))

                            <li>
                                <input type="checkbox"
                                       value="{{ $value }}"
                                       style="margin-left: 4px"
                                       data-choose="{{ $table->Tables_in_dyt }}"
                                       id="{{ $table->Tables_in_dyt }}__{{ $value }}"
                                       name="{{ $table->Tables_in_dyt }}__{{ $value }}">
                                <label for="{{ $table->Tables_in_dyt }}__{{ $value }}" style="cursor: pointer">
                                    {{ str_replace('_', ' ', ucfirst($value)) }} <br>
                                </label>
                                <div class="controlls pull-right">
                                    <button data-view="{{ $table->Tables_in_dyt }}__{{ $value }}_close" class="hidden pull-right close-button">&times;</button>
                                    <button data-view="{{ $table->Tables_in_dyt }}__{{ $value }}_filter_value" class="hidden pull-right"></button>
                                    <button data-view="{{ $table->Tables_in_dyt }}__{{ $value }}_filter" class="hidden pull-right"></button>

                                    <button data-view="{{ $table->Tables_in_dyt }}__{{ $value }}_call" class="display-modal pull-right add-filter"
                                            data-toggle="modal"
                                            onclick="lightBox('{{ $table->Tables_in_dyt }}__{{ $value }}')"
                                            data-target=".modal">A&ntilde;adir filtro</button>
                                </div>
                            </li>
                            @endif

                        @endforeach
                        </ul>
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
                        <select name="filter" id="filter">
                            <option value="">-- Elegir --</option>
                            <option value="=">igual</option>
                            <option value="&gt;=">mayor o igual</option>
                            <option value="&lt;=">menor o igual</option>
                            <option value="&gt;&lt;">distinto</option>
                        </select>
                    </td>
                    <td>
                        <input type="text" value="" name="filter_value" id="filter_value">
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
