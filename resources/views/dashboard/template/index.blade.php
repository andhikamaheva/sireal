<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>{{ $title or "Dashboard Labkom Stikom Surabaya"}}</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<meta name="csrf-token" content="{{ csrf_token() }}"/>

<!-- BEGIN GLOBAL MANDATORY STYLES -->

<script src="{{asset('assets/global/plugins/sweet-alert/dist/sweetalert.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('assets/global/plugins/sweet-alert/dist/sweetalert.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/global/plugins/sweet-alert/themes/twitter/twitter.css')}}">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/uniform/css/uniform.default.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css"/>
<script src="{{asset('assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
<!-- END GLOBAL MANDATORY STYLES -->
@section('css')
@show
<!-- BEGIN THEME STYLES -->
<link href="{{asset('assets/global/css/components-md.css')}}" id="style_components" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/css/plugins-md.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/admin/layout/css/layout.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/admin/layout/css/themes/darkblue.css')}}" rel="stylesheet" type="text/css" id="style_color"/>
<link href="{{asset('assets/admin/layout/css/custom.css')}}" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="{{ asset('favicon.ico') }}"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<body class="page-md page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo ">
	@section('header')
		@include('dashboard.template.header')
	@show

<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	@section('sidebar')
@include('dashboard.template.sidebar')
	@show


	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		@yield('content')
	</div>
	<!-- END CONTENT -->

</div>
<!-- END CONTAINER -->

@section('footer')
	@include('dashboard.template.footer')
@show



<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="../../assets/global/plugins/respond.min.js"></script>
<script src="../../assets/global/plugins/excanvas.min.js"></script>
<![endif]-->

<script src="{{asset('assets/global/plugins/jquery-migrate.min.js')}}" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="{{asset('assets/global/plugins/jquery-ui/jquery-ui.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery.cokie.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/uniform/jquery.uniform.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<script src="{{asset('assets/global/scripts/stikomX.js')}}" type="text/javascript"></script>

@section('js')

@show


<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
