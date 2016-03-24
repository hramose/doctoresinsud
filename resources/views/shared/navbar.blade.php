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
            <a class="navbar-brand" href="#">Diagnóstico y Tratamiento<img style="float: right; margin-top: -25px;" height="75" width="100" src="/img/heart_cardio_pulse.png"></a>
        </div>

        <!-- Navbar Right -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="/">Home</a></li>
               <!-- <li><a href="/tickets">Tickets</a></li>
                <li><a href="/blog">Blog</a></li>-->
                <li><a href="/about">About</a></li>
                <li><a href="/contact">Carga un ticket</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    @if(Auth::check())
                        {{ Auth::user()->name }}
                    @else
                        Miembros 
                    @endif
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        @if (Auth::check())
                            @if(Auth::user()->hasRole('Manager'))
                                <li><a href="/admin">Admin</a></li>
                            @endif
                            <li><a href="/users/logout">Logout</a></li>
                        @else
                            <li><a href="/users/register">Register</a></li>
                            <li><a href="/users/login">Login</a></li>
                        @endif
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>