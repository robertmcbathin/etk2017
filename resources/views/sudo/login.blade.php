<!doctype html>
<html lang="ru">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<style>body{padding-top: 60px;}</style>
        <link href="/admin/css/bootstrap.min.css" rel="stylesheet" />
    <!--  Material Dashboard CSS    -->
    <link href="/admin/css/material-kit.css" rel="stylesheet" />
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="/admin/css/demo.css" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" />
    <link rel="stylesheet" href="/admin/login/css/app.css">
	

</head>
<body class="login-page">
        <div class="page-header header-filter" id="gradient">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                    <div class="card card-signup">
                        <form class="form" method="POST" action="{{ route('sudo.login.post') }}">
                            <div class="header header-primary text-center">
                                <h4 class="card-title">Вход в панель управления</h4>
                            </div>
                            <div class="content">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">face</i>
                                    </span>
                                    <input type="text" name="username" class="form-control" placeholder="Логин">
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">lock_outline</i>
                                    </span>
                                    <input type="password" name="password" placeholder="Пароль" class="form-control" />
                                </div>

                                <!-- If you want to add a checkbox to this form, uncomment this code

                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="optionsCheckboxes" checked>
                                        Subscribe to newsletter
                                    </label>
                                </div> -->
                                {{csrf_field()}}
                            </div>
                            <div class="footer text-center">
                            <input type="submit" class="btn btn-primary btn-simple btn-wd btn-lg" value="Войти" >
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
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
<!-- Vector Map plugin -->
<script src="/admin/js/jquery-jvectormap.js"></script>
<!-- Sliders Plugin -->
<script src="/admin/js/nouislider.min.js"></script>
<!--  Google Maps Plugin    -->
<script src="/admin/js/jquery.select-bootstrap.js"></script>
<!--  DataTables.net Plugin    -->
<script src="/admin/js/jquery.datatables.js"></script>
<!-- Sweet Alert 2 plugin -->
<script src="/admin/js/sweetalert2.js"></script>
<!--    Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="/admin/js/jasny-bootstrap.min.js"></script>
<!--  Full Calendar Plugin    -->
<script src="/admin/js/fullcalendar.min.js"></script>
<!-- TagsInput Plugin -->
<script src="/admin/js/jquery.tagsinput.js"></script>
<!-- Material Dashboard javascript methods -->
<script src="/admin/js/material-dashboard.js"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
</html>
