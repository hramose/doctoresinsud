<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Diagnóstico y Tratamiento de Chagas<img style="float: right; margin-top: -25px;" height="75" width="100" src="/img/heart_cardio_pulse.png"></a>
        </div>

        <!-- Navbar Right -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="{{(Request::is('/') ? 'active' : '')}}"><a href="{{ URL::to('/') }}/">Home <i class="material-icons" style="position: relative; top: 5px;">home</i></a></li>
                @if(Auth::check())
                    @if(Auth::user()->hasRole('Medico'))
                        <li class="{{(Request::is('reportes') ? 'active' : '')}}"><a href="{{ action('ReportController@index') }}">Reportes <i class="material-icons" style="position: relative; top: 5px;">content_paste</i></a></li>
                    @endif
                @endif

                @if(Auth::check())
                    @if(Auth::user()->hasRole('Medico'))
                        <li class="{{(Request::is('panel') ? 'active' : '')}}"><a href="{{ action('Panel\PanelHistoriasController@index') }}">Panel Historias Clínicas <i class="material-icons" style="position: relative; top: 5px;">content_paste</i></a></li>
                    @endif
                @endif

                @if (Auth::check())
                    @if(Auth::user()->hasRole('Manager'))
                        <li class="{{(Request::is('admin') ? 'active' : '')}}"><a href="{{ action('Admin\PagesController@home') }}">Administrar <i class="material-icons" style="position: relative; top: 5px;">settings</i></a></li>
                    @endif
                    <li><a href="{{ action('Auth\AuthController@getLogout') }}">Salir <i class="material-icons" style="position: relative; top: 5px;">forward</i></a></li>
                @else
                    <li class="{{(Request::is('users/register') ? 'active' : '')}}"><a href="{{ action('Auth\AuthController@getRegister') }}">Registrar <i class="material-icons"><img src="/img/registrar_icon.png" style="width: 20px; height: 20px;" alt=""></i></a></li>
                    <li class="{{(Request::is('users/login') ? 'active' : '')}}"><a href="{{ action('Auth\AuthController@getLogin') }}">Ingresar <i class="material-icons"><img src="/img/ingresar_icon.png" style="width: 20px; height: 20px;" alt=""></i></a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>