<!doctype html>
<html lang="ru">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="/images/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>@yield('title')</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<meta name="description" content="@yield('description')"/>
	<!--     Fonts and icons     -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

	<!-- CSS Files -->
    <link href="/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/css/material-kit.css" rel="stylesheet"/>
    <link href="/css/app.css" rel="stylesheet"/>

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<!--<link href="assets/assets-for-demo/vertical-nav.css" rel="stylesheet" />-->
	<!--<link href="assets/assets-for-demo/demo.css" rel="stylesheet" /> -->


</head>

<body class="index-page">
   @include('includes.top_nav')
   @yield('content')
   @include('includes.footer')


</body>
	<!--   Core JS Files   -->
	<script src="/js/jquery.min.js" type="text/javascript"></script>
	<script src="/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="/js/material.min.js"></script>

	<!--	Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
	<script src="/js/nouislider.min.js" type="text/javascript"></script>

	<!--	Plugin for the Datepicker, full documentation here: http://www.eyecon.ro/bootstrap-datepicker/ -->
	<script src="/js/bootstrap-datepicker.js" type="text/javascript"></script>

	<!--	Plugin for Select Form control, full documentation here: https://github.com/FezVrasta/dropdown.js -->
	<script src="/js/jquery.dropdown.js" type="text/javascript"></script>

	<!--	Plugin for Tags, full documentation here: http://xoxco.com/projects/code/tagsinput/  -->
	<script src="/js/jquery.tagsinput.js"></script>

	<!--	Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
	<script src="/js/jasny-bootstrap.min.js"></script>

	<!-- Plugin For Google Maps -->
	<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script> -->

	<!-- Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc -->
	<script src="/js/material-kit.js" type="text/javascript"></script>

	<!-- Fixed Sidebar Nav - JS For Demo Purpose, Don't Include it in your project -->
	<script src="/assets/assets-for-demo/modernizr.js" type="text/javascript"></script>
	<script src="/assets/assets-for-demo/vertical-nav.js" type="text/javascript"></script>

	<script type="text/javascript">

		$().ready(function(){
			$('#sliderRegular').noUiSlider({
	            start: 40,
	            connect: "lower",
	            range: {
	                min: 0,
	                max: 100
	            }
	        });

	        $('#sliderDouble').noUiSlider({
	            start: [20, 60] ,
	            connect: true,
	            range: {
	                min: 0,
	                max: 100
	            }
	        });

		});
	</script>
</html>
