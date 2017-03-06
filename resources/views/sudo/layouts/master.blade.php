<!doctype html>
<html lang="ru">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="/admin/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="/admin/img/favicon.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>@yield('title')</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!--  Social tags      -->
    <meta name="keywords" content="">
    <meta name="description" content="">
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="Material Dashboard PRO by Creative Tim | Premium Bootstrap Admin Template">
    <meta itemprop="description" content="Material Dashboard PRO is a Premium Material Bootstrap Admin with a fresh, new design inspired by Google's Material Design.">
    <meta itemprop="image" content="http://s3.amazonaws.com/creativetim_bucket/products/51/opt_mdp_thumbnail.jpg">
    <!-- Bootstrap core CSS     -->
    <link href="/admin/css/bootstrap.min.css" rel="stylesheet" />
    <!--  Material Dashboard CSS    -->
    <link href="/admin/css/material-dashboard.css" rel="stylesheet" />
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="/admin/css/demo.css" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" />
</head>

<body>
    <div class="wrapper">
        @include('sudo.includes.sidebar')
        @yield('content')
    </div>
</body>
<!--   Core JS Files   -->
<script src="/admin/js/jquery-3.1.1.min.js" type="text/javascript"></script>
<script src="/admin/js/jquery-ui.min.js" type="text/javascript"></script>
<script src="/admin/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/admin/js/material.min.js" type="text/javascript"></script>
<script src="/admin/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
<!-- Forms Validations Plugin -->
<script src="/admin/js/jquery.validate.min.js"></script>
<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
<script src="/admin/js/moment.min.js"></script>
<!--  Charts Plugin -->
<script src="/admin/js/chartist.min.js"></script>
<!--  Plugin for the Wizard -->
<script src="/admin/js/jquery.bootstrap-wizard.js"></script>
<!--  Notifications Plugin    -->
<script src="/admin/js/bootstrap-notify.js"></script>
<!--   Sharrre Library    -->
<script src="/admin/js/jquery.sharrre.js"></script>
<!-- DateTimePicker Plugin -->
<script src="/admin/js/bootstrap-datetimepicker.js"></script>
<!-- Vector Map plugin -->
<script src="/admin/js/jquery-jvectormap.js"></script>
<!-- Sliders Plugin -->
<script src="/admin/js/nouislider.min.js"></script>
<!-- Select Plugin -->
<script src="/admin/js/jquery.select-bootstrap.js"></script>
<!--  DataTables.net Plugin    -->
<script src="/admin/js/jquery.datatables.js"></script>
<!-- Sweet Alert 2 plugin -->
<script src="/admin/js/sweetalert2.js"></script>
<!--    Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="/admin/js/jasny-bootstrap.min.js"></script>
<!-- TagsInput Plugin -->
<script src="/admin/js/jquery.tagsinput.js"></script>
<!-- Material Dashboard javascript methods -->
<script src="/admin/js/material-dashboard.js"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="/admin/js/demo.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();

        demo.initVectorMap();
    });
</script>
</html>