@extends('master')
@section('title', 'Admin control panel')

@section('content')

<div class="container">
    <div class="row banner">

        <div class="col-lg-6">

            <div class="list-group">
                <div class="list-group-item">
                    <div class="row-action-primary">
                        <i class="mdi-action-account-box"></i>
                    </div>
                    <div class="row-content">
                        <div class="action-secondary"><i class="mdi-social-info"></i></div>
                        <h4 class="list-group-item-heading">Administración de usuarios</h4>
                        <a href="/admin/users" class="btn btn-default btn-raised">Todos los usuarios</a>
                    </div>
                </div>
                <div class="list-group-separator"></div>
                <div class="list-group-item">
                    <div class="row-action-primary">
                        <i class="mdi-action-settings-input-component"></i>
                    </div>
                    <div class="row-content">
                        <div class="action-secondary"><i class="mdi-material-info"></i></div>
                        <h4 class="list-group-item-heading">Administración de Roles</h4>
                        <a href="/admin/roles" class="btn btn-default btn-raised">Todos los Roles</a>
                        <a href="/admin/roles/create" class="btn btn-primary btn-raised">Crear un rol</a>
                    </div>
                </div>
                <!--
                <div class="list-group-separator"></div>
                <div class="list-group-item">
                    <div class="row-action-primary">
                        <i class="mdi-editor-border-color"></i>
                    </div>
                    <div class="row-content">
                        <div class="action-secondary"><i class="mdi-material-info"></i></div>
                        <h4 class="list-group-item-heading">Administración de Posts</h4>
                        <a href="/admin/posts" class="btn btn-default btn-raised">Todos los Posts</a>
                        <a href="/admin/posts/create" class="btn btn-primary btn-raised">Crear un Post</a>
                    </div>
                </div>
                <div class="list-group-separator"></div>
                <div class="list-group-item">
                    <div class="row-action-primary">
                        <i class="mdi-file-folder"></i>
                    </div>
                    <div class="row-content">
                        <div class="action-secondary"><i class="mdi-material-info"></i></div>
                        <h4 class="list-group-item-heading">Administración de Categorías</h4>
                        <a href="/admin/categories" class="btn btn-default btn-raised">Todas las categorías</a>
                        <a href="/admin/categories/create" class="btn btn-primary btn-raised">Nueva Categoría</a>
                    </div>
                </div>
                -->
                <!-- sedes -->
                <div class="list-group-separator"></div>
                <div class="list-group-item">
                    <div class="row-action-primary">
                        <i class="mdi-maps-store-mall-directory"></i>
                    </div>
                    <div class="row-content">
                        <div class="action-secondary"><i class="mdi-social-info"></i></div>
                        <h4 class="list-group-item-heading">Administrar sedes</h4>
                        <a href="/admin/sedes" class="btn btn-default btn-raised">Todas las sedes</a>
                        <a href="/admin/sedes/create" class="btn btn-primary btn-raised">Nueva Sede</a>
                    </div>
                </div>
                <!-- sedes -->
                
                <!-- pacientes -->
                <div class="list-group-separator"></div>
                <div class="list-group-item">
                    <div class="row-action-primary">
                        <i class="mdi-social-group"></i>
                    </div>
                    <div class="row-content">
                        <div class="action-secondary"><i class="mdi-social-info"></i></div>
                        <h4 class="list-group-item-heading">Administrar pacientes</h4>
                        <a href="/admin/pacientes" class="btn btn-default btn-raised">Todos los Pacientes</a>
                        <a href="/admin/pacientes/create" class="btn btn-primary btn-raised">Nuevo Paciente</a>
                    </div>
                </div>
                <!-- pacientes -->
            </div>
        </div>  <!-- Col-md -->
        <div class="col-lg-6">
            <div class="list-group">
                <!-- items -->
                <!-- <div class="list-group-separator"></div> -->
                <div class="list-group-item">
                    <div class="row-action-primary">
                        <i class="mdi-social-group"></i>
                    </div>
                    <div class="row-content">
                        <div class="action-secondary"><i class="mdi-social-info"></i></div>
                        <h4 class="list-group-item-heading">Administrar items história clínica</h4>
                        <a href="/admin/items" class="btn btn-default btn-raised">Todos los items</a>
                        <a href="/admin/items/create" class="btn btn-primary btn-raised">Nuevo Item</a>
                    </div>
                </div>
                <!-- items -->
                <!-- Campos Base -->
                <div class="list-group-separator"></div>
                <div class="list-group-item">
                    <div class="row-action-primary">
                        <i class="mdi-av-my-library-books"></i>
                    </div>
                    <div class="row-content">
                        <div class="action-secondary"><i class="mdi-social-info"></i></div>
                        <h4 class="list-group-item-heading">Administrar campos base</h4>
                        <a href="/admin/estudios/camposbase" class="btn btn-default btn-raised">Todos Campos Base</a>
                        <a href="/admin/estudios/camposbase/create" class="btn btn-primary btn-raised">Nuevo campo base</a>
                    </div>
                </div>
                <!-- Campos Base -->
                <!-- Unidades de Medida -->
                <div class="list-group-separator"></div>
                <div class="list-group-item">
                    <div class="row-action-primary">
                        <i class="mdi-editor-format-underline"></i>
                    </div>
                    <div class="row-content">
                        <div class="action-secondary"><i class="mdi-social-info"></i></div>
                        <h4 class="list-group-item-heading">Administrar Unidades de Medida</h4>
                        <a href="/admin/estudios/unidadesmedida" class="btn btn-default btn-raised">Todas U. Medida</a>
                        <a href="/admin/estudios/unidadesmedida/create" class="btn btn-primary btn-raised">Nueva unidad de medida</a>
                    </div>
                </div>
                <!-- Unidades de Medida -->

                <!-- Medicamentos -->
                <div class="list-group-separator"></div>
                <div class="list-group-item">
                    <div class="row-action-primary">
                        <i class="mdi-editor-format-underline"></i>
                    </div>
                    <div class="row-content">
                        <div class="action-secondary"><i class="mdi-social-info"></i></div>
                        <h4 class="list-group-item-heading">Administrar Medicamentos</h4>
                        <a href="/admin/medicamentos" class="btn btn-default btn-raised">Todos los Med</a>
                        <a href="/admin/medicamentos/create" class="btn btn-primary btn-raised">Nuevo Medicamento</a>
                    </div>
                </div>
                <!-- Medicamentos -->


                <!-- Estudios -->
                <div class="list-group-separator"></div>
                <div class="list-group-item">
                    <div class="row-action-primary">
                        <i class="material-icons">local_hospital</i>
                    </div>
                    <div class="row-content">
                        <div class="action-secondary"><i class="mdi-social-info"></i></div>
                        <h4 class="list-group-item-heading">Administrar Estudios</h4>
                        <a href="/admin/estudios" class="btn btn-default btn-raised">Todos los estudios</a>
                        <a href="/admin/estudios/create" class="btn btn-primary btn-raised">Nuevo estudio</a>
                    </div>
                </div>
                <!-- Estudios -->

                <!-- Tratamientos -->
                <div class="list-group-separator"></div>
                <div class="list-group-item">
                    <div class="row-action-primary">
                        <i class="material-icons">local_hospital</i>
                    </div>
                    <div class="row-content">
                        <div class="action-secondary"><i class="mdi-social-info"></i></div>
                        <h4 class="list-group-item-heading">Administrar Tratamientos</h4>
                        <a href="/admin/tratamientos" class="btn btn-default btn-raised">Todos los tratamientos</a>
                        <a href="/admin/tratamientos/create" class="btn btn-primary btn-raised">Nuevo tratamiento</a>
                    </div>
                </div>
                <!-- tratamientos -->

            </div>
        </div>


    </div>
</div>

@endsection