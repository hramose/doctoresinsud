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
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($estudios as $estudio)
                        <tr>
                            <td>
                                <button class="btn btn-link"  onclick="chargeItemAjax('{!! action('Panel\PanelHistoriasController@verEstudio', ['id_p' => $estudio->id_hc,'id_e' => $estudio->id]) !!}')" >{!! $estudio->nombre !!}</button>
                            </td>
                            <td>{!! \Carbon\Carbon::parse($estudio->fecha)->format('d/m/Y') !!}</td>
                            <td>{!! substr($estudio->titulo, 0, 40) !!}</td>
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
    $(document).ready(function(){
        $('#modalTableEstudios').DataTable( {
            "language": {
                "url": "../../../lang/datatables_es.json"
            }
        });
    });
</script>

</body>