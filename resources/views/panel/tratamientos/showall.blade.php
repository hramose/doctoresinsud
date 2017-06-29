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
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tratamientos as $tratamiento)
                        <tr>
                            <td>
                                

                     <button class="btn btn-link"  onclick="chargeItemAjax('{!! action('Panel\PanelHistoriasController@verTratamiento', ['id_p' => $paciente->id, 'id_t' => $tratamiento->id]) !!}')"  >{!! $estudio->nombre !!}</button>
                            </td>
                            <td>{!! $tratamiento->dosis !!}</td>
                            <td>{!! $tratamiento->fecha_trat->format('d/m/Y') !!}</td>
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
    $(document).ready(function(){
        $('#modalTableTrat').DataTable( {
            "language": {
                "url": "../../../lang/datatables_es.json"
            }
        });
    });
</script>

</body>