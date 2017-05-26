<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="{{ URL::to('/') }}/">
            <img style="width: 35px;margin-top: 4px;" src="{{ asset('/img/logo.png') }}" alt="logo" class="logo-default">
            </a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN HORIZANTAL MENU -->
        <!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
        <!-- DOC: This is desktop version of the horizontal menu. The mobile version is defined(duplicated) sidebar menu below. So the horizontal menu has 2 seperate versions -->
        <div class="hor-menu hor-menu-light hidden-sm hidden-xs">
            <ul class="nav navbar-nav">
                <!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the horizontal opening on mouse hover -->
                <li class="classic-menu-dropdown {{(Request::is('/') ? 'active' : '')}} {{(Request::is('home') ? 'active' : '')}}">
                    <a href="{{ URL::to('/') }}/">
                        <i class="fa fa-home" aria-hidden="true"></i>
                        Home <span class="selected">
                        </span>
                    </a>
                </li>
                 <li>
                    <a href="{!! action('Admin\UsersController@tutorial') !!}">
                    <i class="fa fa-user"></i> Tutoriales</a>
                </li>
                @if(Auth::check())
                    @if(Auth::user()->hasRole('Medico'))

                        <li class="classic-menu-dropdown {{(Request::is('reportes') ? 'active' : '')}}">
                            <a href="{{ action('ReportController@index') }}">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i>
                                Reportes <span class="selected">
                                </span>
                            </a>
                        </li>
                    @endif
                @endif

                @if(Auth::check())
                    @if(Auth::user()->hasRole('Medico'))

                        <li class="classic-menu-dropdown {{(Request::is('panel','panel/*') ? 'active' : '')}}">
                            <a href="{{ action('Panel\PanelHistoriasController@index') }}">
                               <i class="fa fa-id-card-o" aria-hidden="true"></i>
                                Historias Clínicas <span class="selected">
                                </span>
                            </a>
                        </li>
                    @endif
                @endif

          

                @if (Auth::check())
                    @if(Auth::user()->hasRole('Manager'))


                  
                    <li class="classic-menu-dropdown">
                    <a data-toggle="dropdown" href="javascript:;" aria-expanded="false">
                    <i class="fa fa-cog" aria-hidden="true"></i>
                    Administrar <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu pull-left">
    
                        <li>
                            <a href="{!! action('Admin\UsersController@index') !!}">
                            <i class="fa fa-user"></i> Usuarios</a>
                        </li>
                        <li>
                            <a href="{!! action('Admin\RolesController@index') !!}">
                            <i class="fa fa-users" aria-hidden="true"></i> Roles </a>
                        </li>
                        <li>
                            <a href="{!! action('Admin\SedesController@index') !!}">
                            <i class="fa fa-building"></i> Sedes </a>
                        </li>
                        <li>
                            <a href="{!! action('Admin\CamposBaseController@index') !!}">
                            <i class="fa fa-caret-square-o-down"></i> Campos Base</a>
                        </li>
                        <li>
                            <a href="{!! action('Admin\UnidadesMedidaController@index') !!}">
                            <i class="fa fa-percent"></i> Unidades de Medida </a>
                        </li>
                        <li>
                            <a href="{!! action('Admin\MedicamentosController@index') !!}">
                            <i class="fa fa-medkit"></i> Medicamentos</a>
                        </li>
                        <li>
                            <a href="{!! action('Admin\EstudiosController@index') !!}">
                            <i class="fa fa-id-card-o"></i> Estudios </a>
                        </li>
                        <li>
                            <a href="{!! action('Admin\SintomasController@index') !!}">
                            <i class="fa fa-hospital-o"></i> Sintomas </a>
                        </li>
                        <li>
                            <a href="{!! action('Admin\PatologiasController@index') !!}">
                            <i class="fa fa-user-md"></i> Patologias </a>
                        </li>                    
                    </ul>
                </li>
                    @endif
                   
                @endif

                
            </ul>
        </div>
         
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
        </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu hor-menu hor-menu-light pull-right">
            <ul class="nav navbar-nav pull-right">
              

                @if (Auth::check())
                    
                    
                 <li class="dropdown dropdown-quick-sidebar-toggler">
                    <a href="{{ action('Auth\AuthController@getLogout') }}" class="dropdown-toggle">
                    <i class="icon-logout"></i>
                    </a>
                </li>

                @else

                    <li class="classic-menu-dropdown  {{(Request::is('users/register') ? 'active' : '')}}">
                            <a href="{{ action('Auth\AuthController@getRegister') }}">
                            Registrar <span class="selected">
                            </span>
                            <i class="fa fa-user-plus" aria-hidden="true"></i>

                            </a>
                    </li>
                    <li class="classic-menu-dropdown {{(Request::is('users/login') ? 'active' : '')}}">
                            <a href="{{ action('Auth\AuthController@getLogin') }}">
                            Ingresar <span class="selected">
                            </span>
                            </a>
                    </li>

                @endif


               
                <!-- END QUICK SIDEBAR TOGGLER -->
            </ul>
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END HEADER INNER -->
</div>