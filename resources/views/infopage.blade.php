<html>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}"/>
        <title> @yield('title') </title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
        <!-- Material Design fonts -->
        {{--<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">--}}
        {{--<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">--}}
        <link href="/css/material_icons.css" rel="stylesheet">
        <!-- Include roboto.css to use the Roboto web font, material.css to include the theme and ripples.css to style the ripple effect -->
        <link href="/css/roboto.min.css" rel="stylesheet">
        <link href="/css/material.min.css" rel="stylesheet">
        <link href="/css/ripples.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="/css/jquery-ui.min.css">
        <link rel="stylesheet" href="/css/chosen.css">
        @yield('estilos')
    </head>
    <body>
        @yield('content')

        <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
        <script src="/js/ripples.min.js"></script>
        <script src="/js/material.min.js"></script>
        <script src="/js/jquery-ui.min.js"></script>
        <script src="/js/moment.min.js"></script>

        <script>
            $(document).ready(function () {
                // This command is used to initialize some elements and make them work properly
                $.material.init();

            });
        </script>
        <script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>

        @yield('scripts')
    </body>
</html>