<body>
 
            @if ($tratamientos->isEmpty())
                <p>No hay tratamientos cargados para el paciente.</p>
            @else
                <table class="table" id="modalTableTrat">
                    <thead>
                        <tr>
                            <th>Droga</th>
                            <th>Dosis</th>
                            <th>Fecha</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Droga</th>
                        <th>Dosis</th>
                        <th>Fecha</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
                    <tbody>
                    @foreach($tratamientos as $tratamiento)
                        <tr>
                            <td>
                                
                                {!! $tratamiento->droga !!}
                        
                            </td>
                            <td>{!! $tratamiento->dosis !!}</td>
                            <td>{!! \Carbon\Carbon::parse($tratamiento->fecha_trat)->format('d/m/Y') !!}</td>
                            <td>
                                 <button class="btn btn-success  btn-xs"  onclick="chargeItemAjax('{!! action('Panel\PanelHistoriasController@verTratamiento', ['id_p' => $tratamiento->id, 'id_t' => $tratamiento->id]) !!}')"  >Ver</button>
                            </td>
                            <td>
                                <a href="{!! action('Panel\TratamientosController@edit', ['id_p' => $paciente->id, 'id_t' => $tratamiento->id]) !!}" class="btn btn-xs btn-primary">Editar</a>
                            </td>
                            <td>
                                <a href="{!! action('Panel\TratamientosController@showForDelete', ['id_p' => $paciente->id, 'id_t' => $tratamiento->id]) !!}" class="btn btn-xs btn-danger">Eliminar</a>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
       

<script>


$(document).ready(function() {
    $('#modalTableTrat').DataTable( {

    "iDisplayLength": 7,
        initComplete: function () {
            this.api().columns().every( function (i) {
               if(i==0){

                
                 var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.header()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {

                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
                }

            } );
        }
    } );
} );

 
</script>

</body>