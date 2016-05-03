<body>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title"> </h4>
</div>
<div class="modal-body">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Todos los tratamientos</h3>
        </div>
        <div class="panel-body" id="pbody-trat">
            @if ($tratamientos->isEmpty())
                <p>No hay tratamientos cargados para el paciente.</p>
            @else
                <table class="table" id="modalTableTrat">
                    <thead>
                    <tr>
                        <th>Droga</th>
                        <th>Dosis</th>
                        <th>Fecha</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tratamientos as $tratamiento)
                        <tr>
                            <td>
                                <a href="{!! action('Panel\PanelHistoriasController@verTratamiento', ['id_p' => $paciente->id, 'id_t' => $tratamiento->id]) !!}" target="_blank">{!! $tratamiento->droga !!}</a>
                            </td>
                            <td>{!! $tratamiento->dosis !!}</td>
                            <td>{!! $tratamiento->fecha_trat->format('d/m/Y') !!}</td>
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
        $('#modalTableTrat').DataTable( {
            "language": {
                "url": "../../../lang/datatables_es.json"
            }
        });
    });
</script>

</body>