<body>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title"> </h4>
</div>
<div class="modal-body">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Todos los estudios</h3>
        </div>
        <div class="panel-body" id="pbody-estudios">
            @if (!($estudios))
                <p>No hay estudios cargados para el paciente.</p>
            @else
                <table class="table" id="modalTableEstudios">
                    <thead>
                    <tr>
                        <th>Estudio</th>
                        <th>Fecha</th>
                        <th>Titulo</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($estudios as $estudio)
                        <tr>
                            <td>
                                <a href="{!! action('Panel\PanelHistoriasController@verEstudio', ['id_p' => $estudio->id_hc,'id_e' => $estudio->id]) !!}" target="_blank">{!! $estudio->nombre !!}</a>
                            </td>
                            <td>{!! \Carbon\Carbon::parse($estudio->fecha)->format('d/m/Y') !!}</td>
                            <td>{!! substr($estudio->titulo, 0, 40) !!}</td>
                            <td>
                                <a href="{!! action('Panel\EstudiosController@edit', ['id_p' => $estudio->id_hc, 'id_e' => $estudio->id]) !!}" class="btn btn-xs btn-primary">Editar</a>
                            </td>
                            <td>
                                <a href="{!! action('Panel\EstudiosController@showForDelete', ['id_p' => $estudio->id_hc, 'id_e' => $estudio->id]) !!}" class="btn btn-xs btn-danger">Eliminar</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
</div>

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