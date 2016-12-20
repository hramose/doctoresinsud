<html>
<head>
<meta name="csrf-token" content="{{ csrf_token() }}" />
    <title> @yield('title') </title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet"> 
    <link href="https://cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="{{ asset('/css/material_icons.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/roboto.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/material.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/ripples.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/chosen.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/toastr.min.css') }}" rel="stylesheet"/>
    @yield('estilos')

</head>
<body>

@include('shared.navbar')

@yield('content')

<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script src="{{ asset('/js/ripples.min.js') }}"></script>
<script src="{{ asset('/js/material.min.js') }}"></script>
<script src="{{ asset('/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('/js/moment.min.js') }}"></script>
<script src="{{ asset('/js/chosen.jquery.js') }}"></script>
<script src="{{ asset('/js/form-validator/jquery.form-validator.min.js') }}"></script>
<script src="{{ asset('/js/toastr.min.js') }}"></script>
<script src="{{ asset('/js/jquery.ui.datepicker-es.js') }}"></script>
<script>
    $(document).ready(function() {
        $.material.init();
    });
</script>
<script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>

@yield('scripts')

<script>
    $(document).ready(function(){
    $('#myTable').DataTable( {
        "language": {
            "url": "{{ asset('/lang/datatables_es.json') }}"
        }
        @yield('script_datatables')
    });

});
</script>
</body>
</html>
