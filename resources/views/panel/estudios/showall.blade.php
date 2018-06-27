<body>
 
       
             @if (!($estudios))
                <p>No hay estudios cargados para el paciente.</p>
            @else
                <table class="table" id="modalTableEstudios">
                    <thead>
                    <tr>
                        <th>Estudio</th>
                        <th>Fecha</th>
                        <th>Titulo</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($estudios as $estudio)
                        <tr>
                            <td>
                                {!! $estudio->nombre !!}
                            </td>
                            <td>{!! \Carbon\Carbon::parse($estudio->fecha)->format('d/m/Y') !!}</td>
                            <td>{!! substr($estudio->titulo, 0, 40) !!}</td>
                            <td>
                                <button class="btn btn-xs btn-info" onclick="chargeItemHistoric('{!! action('Panel\PanelHistoriasController@verHistoric', ['id_p' => $estudio->id_hc,'id_e' => $estudio->id_estudio]) !!}')"  >Hist</button> 
                            </td>
                            <td>
                                <button class="btn btn-success btn-xs"  onclick="chargeItemAjax('{!! action('Panel\PanelHistoriasController@verEstudio', ['id_p' => $estudio->id_hc,'id_e' => $estudio->id]) !!}')" >Ver</button>
                            </td>
                            <td>
                                <a href="{!! action('Panel\EstudiosController@edit', ['id_p' => $estudio->id_hc, 'id_e' => $estudio->id]) !!}" class="btn btn-xs btn-primary"  target="_blank" >Editar</a>
                            </td>
                            <td>
                                <a href="{!! action('Panel\EstudiosController@showForDelete', ['id_p' => $estudio->id_hc, 'id_e' => $estudio->id]) !!}" class="btn btn-xs btn-danger">Eliminar</a>
                            </td>
                            
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
  
 
 

<script>


$(document).ready(function() {
    $('#modalTableEstudios').DataTable( {

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