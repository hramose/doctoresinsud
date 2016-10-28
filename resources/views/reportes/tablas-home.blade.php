                <div class="row">
                    <div class="col-lg-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">Últimos pacientes atendidos</h3>
                            </div>
                            <div class="panel-body pbody-reportes-home">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>ID Historia Clinica</th>
                                        <th>Apellido, Nombre</th>
                                        <th>Última Consulta</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($ultimasConsultas as $consulta)
                                        <tr>
                                            <td>
                                                <a href="{!! action('Panel\PanelHistoriasController@verHistoria', $consulta->id) !!}">{!! $consulta->id_hc !!}</a>
                                            </td>
                                            <td>
                                                <a href="{!! action('Panel\PanelHistoriasController@verHistoria', $consulta->id) !!}">{!! $consulta->apellido .', '.$consulta->nombre !!} </a>
                                            </td>
                                            <td>{!! \Carbon\Carbon::parse($consulta->fecha_ult_consulta)->format('d/m/Y') !!}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">Próximas citas</h3>
                            </div>
                            <div class="panel-body pbody-reportes-home">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>ID Historia Clinica</th>
                                        <th>Apellido, Nombre</th>
                                        <th>Última Consulta</th>
                                        <th>Próxima Cita</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($proximasCitas as $citas)
                                        <tr>
                                            <td>
                                                <a href="{!! action('Panel\PanelHistoriasController@verHistoria', $citas->id) !!}">{!! $citas->id_hc !!}</a>
                                            </td>
                                            <td>
                                                <a href="{!! action('Panel\PanelHistoriasController@verHistoria', $citas->id) !!}">{!! $citas->apellido .', '.$citas->nombre !!} </a>
                                            </td>
                                            <td>{!! \Carbon\Carbon::parse($citas->fecha_ult_consulta)->format('d/m/Y') !!}</td>
                                            <td>{!! \Carbon\Carbon::parse($citas->min_proxima_cita)->format('d/m/Y') !!}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
