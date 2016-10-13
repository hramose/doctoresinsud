@extends('master')
@section('title', 'Admin control panel')

@section('content')

    <div style="margin: 0 5%">
        <div class="row banner">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Configuración del sistema</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="list-group">
                                <div class="list-group-item">
                                    <div class="row-action-primary">
                                        <i class="mdi-action-account-box"></i>
                                    </div>
                                    <div class="row-content">
                                        <div class="action-secondary"><i class="mdi-social-info"></i></div>
                                        <h1 class="list-group-item-heading" style="font-size: 1.5em;">Usuarios</h1>
                                        <a href="/admin/users" class="btn btn-default btn-raised">Mostrar todos</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="list-group">
                                <div class="list-group-item">
                                    <div class="row-action-primary">
                                        <i class="mdi-action-settings-input-component"></i>
                                    </div>
                                    <div class="row-content">
                                        <div class="action-secondary"><i class="mdi-material-info"></i></div>
                                        <h4 class="list-group-item-heading">Roles</h4>
                                        <a href="/admin/roles" class="btn btn-default btn-raised">Mostrar todos</a>
                                        <a href="/admin/roles/create" class="btn btn-primary btn-raised">Crear</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="list-group">
                                <div class="list-group-item">
                                    <div class="row-action-primary">
                                        <i class="mdi-maps-store-mall-directory"></i>
                                    </div>
                                    <div class="row-content">
                                        <div class="action-secondary"><i class="mdi-social-info"></i></div>
                                        <h4 class="list-group-item-heading">Sedes</h4>
                                        <a href="/admin/sedes" class="btn btn-default btn-raised">Mostrar todas</a>
                                        <a href="/admin/sedes/create" class="btn btn-primary btn-raised">Crear</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="margin: 0 5%">
        <div class="row banner">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Configuración de datos maestros</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="list-group">
                                <!-- Campos Base -->
                                <div class="list-group-item">
                                    <div class="row-action-primary">
                                        <i class="mdi-av-my-library-books"></i>
                                    </div>
                                    <div class="row-content">
                                        <div class="action-secondary"><i class="mdi-social-info"></i></div>
                                        <h4 class="list-group-item-heading">Campos Base</h4>
                                        <a href="/admin/estudios/camposbase" class="btn btn-default btn-raised">Mostrar
                                            todos</a>
                                        <a href="/admin/estudios/camposbase/create" class="btn btn-primary btn-raised">Nuevo</a>
                                    </div>
                                </div>
                                <!-- Campos Base -->
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!-- Unidades de Medida -->
                            <div class="list-group">
                                <div class="list-group-item">
                                    <div class="row-action-primary">
                                        <i class="mdi-editor-format-underline"></i>
                                    </div>
                                    <div class="row-content">
                                        <div class="action-secondary"><i class="mdi-social-info"></i></div>
                                        <h4 class="list-group-item-heading">Unidades de Medida</h4>
                                        <a href="/admin/estudios/unidadesmedida" class="btn btn-default btn-raised">Mostrar
                                            todos</a>
                                        <a href="/admin/estudios/unidadesmedida/create"
                                           class="btn btn-primary btn-raised">Nueva</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Unidades de Medida -->
                        </div>
                        <div class="col-lg-4">
                            <!-- Medicamentos -->
                            <div class="list-group">
                                <div class="list-group-item">
                                    <div class="row-action-primary">
                                        <i class="material-icons">favorite</i>
                                        {{--<i class="favorite"></i>--}}
                                    </div>
                                    <div class="row-content">
                                        <div class="action-secondary"><i class="mdi-social-info"></i></div>
                                        <h4 class="list-group-item-heading">Medicamentos</h4>
                                        <a href="/admin/medicamentos" class="btn btn-default btn-raised">Mostrar
                                            todos</a>
                                        <a href="/admin/medicamentos/create"
                                           class="btn btn-primary btn-raised">Nuevo</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Medicamentos -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <!-- Estudios -->
                            <div class="list-group">
                                <div class="list-group-item">
                                    <div class="row-action-primary">
                                        <i class="material-icons">accessibility</i>
                                    </div>
                                    <div class="row-content">
                                        <div class="action-secondary"><i class="mdi-social-info"></i></div>
                                        <h4 class="list-group-item-heading">Estudios</h4>
                                        <a href="/admin/estudios" class="btn btn-default btn-raised">Mostrar todos</a>
                                        <a href="/admin/estudios/create" class="btn btn-primary btn-raised">Nuevo</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Estudios -->
                        <div class="col-lg-4">
                            <!-- Sintomas -->
                            <div class="list-group">
                                <div class="list-group-item">
                                    <div class="row-action-primary">
                                        <i class="material-icons">
                                            <img src="/img/sintomas_icon_solid.png" style="position: relative; top: 30%; left: 30%; width: 24px; height: 24px;" alt="">
                                        </i>
                                    </div>
                                    <div class="row-content">
                                        <div class="action-secondary"><i class="mdi-social-info"></i></div>
                                        <h4 class="list-group-item-heading">Sintomas</h4>
                                        <a href="/admin/sintomas" class="btn btn-default btn-raised">Mostrar todos</a>
                                        <a href="/admin/sintomas/create" class="btn btn-primary btn-raised">Nuevo</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Sintomas -->
                        </div>
                        <div class="col-lg-4">
                            <!-- Patologias -->
                            <div class="list-group">
                                <div class="list-group-item">
                                    <div class="row-action-primary">
                                        <i class="material-icons"><img src="/img/sintomas_icon_solid.png" style="position: relative; top: 30%; left: 30%; width: 24px; height: 24px;" alt=""></i>
                                    </div>
                                    <div class="row-content">
                                        <div class="action-secondary"><i class="mdi-social-info"></i></div>
                                        <h4 class="list-group-item-heading">Patologias</h4>
                                        <a href="/admin/patologias" class="btn btn-default btn-raised">Mostrar todos</a>
                                        <a href="/admin/patologias/create" class="btn btn-primary btn-raised">Nueva</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Patologias -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection