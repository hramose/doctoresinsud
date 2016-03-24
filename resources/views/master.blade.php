<html>
<head>
<meta name="csrf-token" content="{{ csrf_token() }}" />
    <title> @yield('title') </title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet"> 
     <!-- Material Design fonts -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Include roboto.css to use the Roboto web font, material.css to include the theme and ripples.css to style the ripple effect -->
    <link href="/css/roboto.min.css" rel="stylesheet">
    <link href="/css/material.min.css" rel="stylesheet">
    <link href="/css/ripples.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css">

    <style>

        /**
 * For the correct positioning of the placeholder element, the dnd-list and
 * it's children must have position: relative
 */
.simpleDemo ul[dnd-list],
.simpleDemo ul[dnd-list] > li {
    position: relative;
}

/**
 * The dnd-list should always have a min-height,
 * otherwise you can't drop to it once it's empty
 */
.simpleDemo ul[dnd-list] {
    min-height: 42px;
    padding-left: 0px;
}

/**
 * The dndDraggingSource class will be applied to
 * the source element of a drag operation. It makes
 * sense to hide it to give the user the feeling
 * that he's actually moving it.
 */
.simpleDemo ul[dnd-list] .dndDraggingSource {
    display: none;
}

/**
 * An element with .dndPlaceholder class will be
 * added to the dnd-list while the user is dragging
 * over it.
 */
.simpleDemo ul[dnd-list] .dndPlaceholder {
    display: block;
    background-color: #ddd;
    min-height: 42px;
}

/**
 * The dnd-lists's child elements currently MUST have
 * position: relative. Otherwise we can not determine
 * whether the mouse pointer is in the upper or lower
 * half of the element we are dragging over. In other
 * browsers we can use event.offsetY for this.
 */
.simpleDemo ul[dnd-list] li {
    background-color: #fff;
    border: 1px solid #ddd;
    border-top-right-radius: 4px;
    border-top-left-radius: 4px;
    display: block;
    padding: 10px 15px;
    margin-bottom: -1px;
}

/**
 * Show selected elements in green
 */
.simpleDemo ul[dnd-list] li.selected {
    background-color: #dff0d8;
    color: #3c763d;
}
    </style>
</head>
<body>

@include('shared.navbar')

@yield('content')

<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script src="/js/ripples.min.js"></script>
<script src="/js/material.min.js"></script>



<script>
    $(document).ready(function() {
        // This command is used to initialize some elements and make them work properly
        $.material.init();

    });
</script>
<script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>

@yield('scripts')
<script src="/js/angular.min.js"></script>
 <script src="/js/angular-route.min.js"></script>
 <script src="/js/angular-drag-and-drop-lists.min.js"></script>
 <script src="/js/app.js"></script>
</body>

<script>
    $(document).ready(function(){
    $('#myTable').DataTable( {
        "language": {
            "url": "../lang/datatables_es.json"
        }
    });

    $('#tombo').on('click', function(){
       
            $('#cont').append($('#campos').html());
        })
    

});
</script>
</html>