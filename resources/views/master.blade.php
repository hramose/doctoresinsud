<html moznomarginboxes mozdisallowselectionprint>
<head>
<meta name="csrf-token" content="{{ csrf_token() }}" />
    <title> @yield('title') </title>
   
    
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
     <link href="{{ asset('/css/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/css/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/css/global/plugins/uniform/css/uniform.default.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/css/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css"/>
     
    <!-- END GLOBAL MANDATORY STYLES -->

    <link href="{{ asset('/css/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/css/global/plugins/select2/select2.css') }}" rel="stylesheet" type="text/css"/>


    <!-- BEGIN THEME STYLES -->

    <link href="{{ asset('/css/global/css/components.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/css/global/css/plugins.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/css/admin/layout/css/layout.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/css/admin/layout/css/themes/blue.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/css/admin/layout/css/custom.css') }}" rel="stylesheet" type="text/css"/>
     <link href="{{ asset('/css/chosen.css') }}" rel="stylesheet">

     <link href="{{ asset('/css/jquery-ui.min.css') }}" rel="stylesheet">




    @yield('estilos')

</head>

<style type="text/css" media="print">
    @page 
    {
        size: auto;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */
    }
</style>
<body class="page-header-fixed page-quick-sidebar-over-content page-full-width">

@include('shared.navbar')
<div class="page-container">
  <div class="page-content-wrapper">
    <div class="page-content">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @yield('content')
    </div>
</div>  
</div>


<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script src="{{ asset('/js/ripples.min.js') }}"></script>
 <script src="{{ asset('/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('/js/moment.min.js') }}"></script>
<script src="{{ asset('/js/chosen.jquery.js') }}"></script>
<script src="{{ asset('/js/form-validator/jquery.form-validator.min.js') }}"></script>
<script src="{{ asset('/js/toastr.min.js') }}"></script>
<script src="{{ asset('/js/jquery.ui.datepicker-es.js') }}"></script>
 
<script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('/css/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('/css/global/plugins/select2/select2.js') }}"></script>

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

    $(".selectTags").select2({tags: true})
</script>
</body>
</html>
