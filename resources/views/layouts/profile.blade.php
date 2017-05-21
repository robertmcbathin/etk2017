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
	<meta name="keywords" content="@yield('keywords')"/>
	<!--     Fonts and icons     -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

	<!-- CSS Files -->
    <link href="/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/css/material-kit.css" rel="stylesheet"/>
    <link href="/css/app.css" rel="stylesheet"/>


</head>

<body class="profile-page">
   @include('includes.profile_login_top_nav')
   @yield('content')
   @include('includes.login-footer')


</body>
	<!--   Core JS Files   -->
	<script src="/js/jquery.min.js" type="text/javascript"></script>
	<script src="/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="/js/material.min.js"></script>
        <!--    Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
    <script src="/js/jasny-bootstrap.min.js"></script>
	<!-- Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc -->
	<script src="/js/material-kit.js" type="text/javascript"></script>
            <!--    Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker   -->
    <script src="/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script>
      $('#card_number').on('keyup', function(){
    html = '';
    if ($('#card_number').val().length >= 3) {
        serie = $('#card_number').val().toString().substring(0,3);
        switch(serie){
            case '023':
              serie = '023';
              break;
            case '021':
              serie = '021';
              break;
            case '025':
              serie = '025';
              break;
            case '026':
              serie = '026';
              break;
            case '033':
              serie = '033';
              break;
            case '034':
              serie = '034';
              break;
            
            default :
              serie = '999';
              break; 
        }
        $('#card_type').val(serie);
        html = '<span class="material-input" id="reg-card-thumbnail">'
             + '<img class="reg-thumbnail" src="/images/cards_thumbnails/'
              + serie.toString() + '_80.png\"></span>';
        $('#reg-card-thumbnail').replaceWith(html);
    } else {
        html = '<span class="material-input" id="reg-card-thumbnail">Номер карты</span>';
        $('#reg-card-thumbnail').replaceWith(html);
    }
});
    </script>
	<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter42928324 = new Ya.Metrika({
                    id:42928324,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/42928324" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
</html>
