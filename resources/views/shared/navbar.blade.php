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
                <li {{(Request::is('/') ? 'class=active' : '')}}><a href="{{ URL::to('/') }}/">Home</a></li>
                {{--<li class="active"><a href="/">Home</a></li>--}}
               <!-- <li><a href="/tickets">Tickets</a></li>
                <li><a href="/blog">Blog</a></li>-->
                {{--<li><a href="/about">About</a></li>--}}
                {{--<li><a href="/contact">Carga un ticket</a></li>--}}
                @if(Auth::check())
                    @if(Auth::user()->hasRole('Medico'))
                        <li {{(Request::is('panel') ? 'class=active' : '')}}><a href="{{ action('Panel\PanelHistoriasController@index') }}">Panel Historias Clínicas</a></li>
                    @endif
                @endif

                @if (Auth::check())
                    @if(Auth::user()->hasRole('Manager'))
                        <li><a href="{{ action('Admin\PagesController@home') }}">Administrar</a></li>
                    @endif
                    <li><a href="{{ action('Auth\AuthController@getLogout') }}">Salir</a></li>
                @else
                    <li><a href="{{ action('Auth\AuthController@getRegister') }}">Registrar</a></li>
                    <li><a href="{{ action('Auth\AuthController@getLogin') }}">Ingresar</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>
