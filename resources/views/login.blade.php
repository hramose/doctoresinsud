
<!DOCTYPE html>
 
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title> @yield('title') </title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>




    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

     <link href="{{ asset('/css/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet">
     <link href="{{ asset('/css/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
     <link href="{{ asset('/css/global/plugins/uniform/css/uniform.default.css') }}" rel="stylesheet">
 
 <!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
     <link href="{{ asset('/css/admin/pages/css/login.css') }}" rel="stylesheet">

 <!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME STYLES -->
     <link href="{{ asset('/css/global/css/components.css') }}" rel="stylesheet">
     <link href="{{ asset('/css/global/css/plugins.css') }}" rel="stylesheet">
     <link href="{{ asset('/css/admin/layout/css/layout.css') }}" rel="stylesheet">
     <link href="{{ asset('/css/admin/layout/css/themes/blue.css') }}" rel="stylesheet">
     <link href="{{ asset('/css/admin/layout/css/custom.css') }}" rel="stylesheet">

 <!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
	<body class="login">
		<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
		<div class="menu-toggler sidebar-toggler">
		</div>
		<!-- END SIDEBAR TOGGLER BUTTON -->
		<!-- BEGIN LOGO -->
		<div class="logo">
			<a href="{{ route('home') }}">
				<img src="{{ asset('/img/logo.png') }}"  alt=""/>
			</a>
		</div>
		<!-- END LOGO -->
		<!-- BEGIN LOGIN -->
		<div class="content">

		        @yield('content')


			 
			<!-- END REGISTRATION FORM -->
		</div>
		<div class="copyright">
			 2018 © Grupo Insud - Fundacion Mundo sano.
		</div>
		 
		<!-- END JAVASCRIPTS -->
	</body>
<!-- END BODY -->
</html>