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
  <link rel="stylesheet" href="/css/charts.css">
</head>
<script>
var depositPoints = [
            [1,'Мини-офис СЗР', 56.145866, 47.185343, 'г.Чебоксары, улица Гузовского, 17', 'Пн-Пт: с 9 до 18, обед с 13 до 14'],
            [1,'Мини-офис Центр', 56.143072, 47.250576, 'г.Чебоксары, улица Карла Маркса, 22', 'Пн-Пт: с 9 до 18, обед с 13 до 14'],
             [1,'Мини-офис НЮР', 56.101350, 47.301017, 'г.Чебоксары, проспект Тракторостроителей, 35а', 'Пн-Пт: с 9 до 18, обед с 13 до 14'],
            [1,'Мини-офис Нчк', 56.109684, 47.480350, 'г.Новочебоксарск, улица Винокурова, 51', 'Пн-Пт: с 9 до 18, обед с 13 до 14'],
            [1,'Диспетчерский павильон', 56.1121833, 47.2623013, 'г.Чебоксары, ул. Привокзальная, 1а', 'с 20 по 5 число следующего месяца Пн-Пт: с 7 до 19, Сб-Вс: с 8 до 17 (технический перервы с 11:30 до 12:00)'],
            [3, 'Главпочтамт', 56.1311188,47.2451268, 'г.Чебоксары, пр. Ленина, 2', 'не указано'],
            [3, 'Отделение почтовой службы №22', 56.1310005,47.2828466, 'г.Чебоксары, ул. Космонавта Николаева, 57', 'Пн-Пт: с 8 до 20, Сб: с 9 до 18'],
            [3, 'Отделение почтовой службы №23', 56.1192491,47.1867621, 'г.Чебоксары, ул. Энтузиастов, 23', 'Пн-Пт: с 8 до 20, Сб: с 9 до 18'],
            [3, 'Отделение почтовой службы №27', 56.097769, 47.282568, 'г.Чебоксары, проспект 9-й Пятилетки, 19/37', 'Пн-Пт: с 8 до 20, Сб: с 9 до 18'],
            [3, 'Отделение почтовой службы №28', 56.105118, 47.316313, 'г.Чебоксары, проспект Тракторостроителей, 63/2', 'Пн-Пт: с 8 до 20, Сб: с 9 до 18'],
            [3, 'Отделение почтовой службы №32', 56.144240, 47.248615, 'г.Чебоксары, улица Ленинградская, 16', 'Пн-Пт: с 8 до 20, Сб: с 9 до 18'],
            [3, 'Отделение почтовой службы №34', 56.138373, 47.167928, 'г.Чебоксары, улица Мичмана Павлова, 58А', 'Пн-Пт: с 8 до 20, Сб: с 9 до 18'],
            [3, 'Отделение почтовой службы №37', 56.108906, 47.306779, 'г.Чебоксары, улица Ленинского Комсомола, 68/2', 'Пн-Пт: с 8 до 20, Сб: с 9 до 18'],
            [3, 'Отделение почтовой службы №38', 56.116199, 47.178237, 'г.Чебоксары, улица Чернышевского, 8', 'Пн-Пт: с 8 до 20, Сб: с 9 до 18'],
            [3, 'Отделение почтовой службы №1Н', 56.123935, 47.490056, 'г.Новочебоксарск, бульвар Гидростроителей, 4', 'Пн-Пт: с 8 до 20, Сб: с 9 до 18'],
            [3, 'Отделение почтовой службы №5Н', 56.117345, 47.494747, 'г.Новочебоксарск, улица Винокурова, 23', 'Пн-Пт: с 8 до 20, Сб: с 9 до 18'],
            [3, 'Отделение почтовой службы №6Н', 56.114306, 47.452784, 'г.Новочебоксарск, улица Винокурова, 111', 'Пн-Пт: с 8 до 20, Сб: с 9 до 18'],
            [3, 'Отделение почтовой службы', 56.105973, 47.470150, 'г.Новочебоксарск, улица 10-й Пятилетки, 24', 'Пн-Пт: с 8 до 20, Сб: с 9 до 18'],
            [4, 'Головной офис Чувашкредитпромбанк', 56.145468, 47.235417, 'г. Чебоксары, Московский пр-кт, 3', 'Пн-Пт: с 9 до 19'],
            [4, 'Дополнительный офис №1', 56.144552, 47.213620, 'г. Чебоксары, Московский пр-т, 21/1', 'Пн-Пт: с 9 до 19'],
            [4, 'Дополнительный офис №2', 56.118616, 47.183836, 'г. Чебоксары, ул. Энтузиастов, 34', 'Пн-Пт: с 9 до 19'],
            [4, 'Дополнительный офис №3', 56.090443, 47.290075, 'г. Чебоксары, Эгерский бульвар, 48', 'Пн-Пт: с 9 до 19'],
            [4, 'Дополнительный офис №4', 56.134131, 47.163428, 'г. Чебоксары, ул. Университетская, 36', 'Пн-Пт: с 9 до 19'],
            [4, 'Дополнительный офис №5', 56.135563, 47.239917, 'г. Чебоксары, Президентский б-р, 20', 'Пн-Пт: с 9 до 19'],
            [4, 'Операционный офис «Гагаринский»', 56.123470, 47.252501, 'г. Чебоксары, ул. Ю. Гагарина, 5', 'Пн-Пт: с 9 до 19'],
            [2, 'Филиал Сбербанка №8613/0001', 56.1122284,47.2580311, 'г.Чебоксары, пр. И. Яковлева, 3а', 'не указано'],
            [2, 'Филиал Сбербанка №8613/0002', 56.126737, 47.277230, 'г.Чебоксары, улица 50 лет Октября, 17', 'не указано'],
            [2, 'Филиал Сбербанка №8613/0004', 56.143072, 47.250576, 'г.Чебоксары, улица Карла Маркса, 22', 'не указано'],
           /* [2, 'Филиал Сбербанка №8613/0005', 56.143072, 47.270044, 'г.Чебоксары, улица Ивана Франко, 14', 'не указано'],*/
            [2, 'Филиал Сбербанка №8613/0009', 56.112810, 47.220510, 'г.Чебоксары, улица Б. Хмельницкого, 109', 'не указано'],
            [2, 'Филиал Сбербанка №8613/0010', 56.124213, 47.252096, 'г.Чебоксары, пр. Ленина, 28', 'не указано'],
            [2, 'Филиал Сбербанка №8613/0011', 56.119586, 47.187119, 'г.Чебоксары, улица Энтузиастов, 23', 'не указано'],
            [2, 'Филиал Сбербанка №8613/0013', 56.145963, 47.185244, 'г.Чебоксары, улица Гузовского, 17', 'не указано'],
            [2, 'Филиал Сбербанка №8613/0014', 56.144226, 47.177542, 'г.Чебоксары, улица Ахазова, 8', 'не указано'],
           /* [2, 'Филиал Сбербанка №8613/0015', 56.106358, 47.287476, 'г.Чебоксары, улица 324 Стрелковой дивизии, 3б', 'не указано'],*/
            /*[2, 'Филиал Сбербанка №8613/0016', 56.080871, 47.276525, 'г.Чебоксары, улица Ашмарина, 19', 'не указано'],*/
            [2, 'Филиал Сбербанка №8613/0017', 56.098597, 47.285199, 'г.Чебоксары, проспект Тракторостроителей, 1/34', 'не указано'],
            [2, 'Филиал Сбербанка №8613/0018', 56.105011, 47.316115, 'г.Чебоксары, проспект Тракторостроителей, 63/21', 'не указано'],
            [2, 'Филиал Сбербанка №8613/0019', 56.144175, 47.167390, 'г.Чебоксары, улица Университетская, 20/1', 'не указано'],
            [2, 'Филиал Сбербанка №8613/0020', 56.104390, 47.263490, 'г.Чебоксары, пр. И. Яковлева, 2а', 'не указано'],
            [2, 'Филиал Сбербанка №8613/0021', 56.069488, 47.282231, 'г.Чебоксары, улица Болгарстроя, 9/11', 'не указано'],
            [2, 'Филиал Сбербанка №8613/0022', 56.101343, 47.301192, 'г.Чебоксары, проспект Тракторостроителей, 35а', 'не указано'],
            [2, 'Филиал Сбербанка №8613/0023', 56.143646, 47.204706, 'г.Чебоксары, Московский проспект, 40', 'не указано'],
            [2, 'Филиал Сбербанка №8613/0024', 56.118189, 47.256539, 'г.Чебоксары, улица Космонавта Николаева, 3', 'не указано'],
            [2, 'Филиал Сбербанка №8613/0025', 56.128616, 47.268191, 'г.Чебоксары, улица Гагарина, 27', 'не указано'],
            [2, 'Филиал Сбербанка №8613/0026', 56.144915, 47.215535, 'г.Чебоксары, улица улица Спиридона Михайлова, 1', 'не указано'],
            [2, 'Филиал Сбербанка №8613/0027', 56.149266, 47.177117, 'г.Чебоксары, проспект Максима Горького, 32/25', 'не указано'],
            [2, 'Филиал Сбербанка №8613/0028', 56.124033, 47.205348, 'г.Чебоксары, улица Гражданская, 83', 'не указано'],
            [2, 'Филиал Сбербанка №8613/0029', 56.117160, 47.181170, 'г.Чебоксары, улица Матэ Залка, 11', 'не указано'],
            [2, 'Филиал Сбербанка №8613/0030', 56.096445, 47.278718, 'г.Чебоксары, проспект 9-й Пятилетки, 18/2', 'не указано'],
            [2, 'Филиал Сбербанка №8613/0032', 56.149229, 47.197682, 'г.Чебоксары, проспект Максима Горького, 10', 'не указано'],
            [2, 'Филиал Сбербанка №8613/0034', 56.133704, 47.245169, 'г.Чебоксары, улица Карла Маркса, 52', 'не указано'],
            [2, 'Филиал Сбербанка №8613/0038', 56.135405, 47.161848, 'г.Чебоксары, улица Мичмана Павлова, 39', 'не указано'],
            [2, 'Филиал Сбербанка №8613/0052', 56.146039, 47.232626, 'г.Чебоксары, Московский проспект, 5', 'не указано'],
            [2, 'Филиал Сбербанка №8613/0053', 56.105230, 47.279417, 'г.Чебоксары, Эгерский бульвар, 21', 'не указано'],
            [2, 'Филиал Сбербанка №8613/90001', 56.105680, 47.287780, 'г.Чебоксары, улица 324 Стрелковой дивизии, 13а', 'не указано'],
            [2, 'Гимназия №5', 56.137089, 47.243491, 'г.Чебоксары, Президентский бульвар, 21', 'не указано'],
            [2, 'Офис интернет-провайдера Дом.ру', 56.130023, 47.248099, 'г.Чебоксары, проспект Ленина, 7', 'не указано'],
            [2, 'Многофункциональный центр (МФЦ)', 56.138037, 47.245665, 'г.Чебоксары, улица Ленинградская, 36', 'не указано'],
            [2, 'Остановка "Агрегатный завод" (мини-офис Сбербанка)', 56.122876, 47.282548, 'г.Чебоксары, проспект Мира, 1', 'не указано'],
            [2, 'Остановка "Дом мод" (офис самообслуживания Сбербанка)', 56.144028, 47.248046, 'г.Чебоксары, улица Композиторов Воробьевых, 20', 'не указано'],
            [2, 'Остановка "Дорисс-парк" (офис самообслуживания Сбербанка)', 56.095241, 47.267660, 'г.Чебоксары, проспект 9 Пятилетки, 2/3', 'не указано'],
            [2, 'Остановка "Кооперативный институт" (офис самообслуживания Сбербанка)', 56.148908, 47.184112, 'г.Чебоксары, проспект М. Горького, 24', 'не указано'],
            [2, 'Остановка "Пригородный автовокзал" (офис самообслуживания Сбербанка)', 56.111560, 47.259592, 'г.Чебоксары, проспект Ивана Яковлева, 3', 'не указано'],
            [2, 'Остановка "Роща" (офис самообслуживания Сбербанка)', 56.138422, 47.189772, 'г.Чебоксары, улица Гузовского, 4а', 'не указано'],
            [2, 'Остановка "Энергозапчасть" (офис самообслуживания Сбербанка)', 56.131049, 47.287563, 'г.Чебоксары, улица Калинина, 112', 'не указано'],
            [2, 'Управление пенсионного фонда России по г.Чебоксары', 56.131676, 47.287950, 'г.Чебоксары, улица Калинина, 109/1', 'не указано'],
            [2, 'ФБУ "Кадастровая палата по Чувашской Республике"', 56.141376, 47.201622, 'г.Чебоксары, Московский проспект, 37', 'не указано'],
            [2, 'ТРЦ "Каскад"', 56.135455, 47.241108, 'г.Чебоксары, Президентский бульвар, 20', 'не указано'],
            [2, 'МТВ-Центр', 56.101702, 47.264731, 'г.Чебоксары, проспект Ивана Яковлева, 4', 'не указано'],
            [2, 'ТРЦ "Мега Молл"', 56.137794, 47.276818, 'г.Чебоксары, улица Калинина, 105а', 'не указано'],
            [2, 'Остановка "Улица Афанасьева" (мини-офис)', 56.146249, 47.219717, 'г.Чебоксары, Московский проспект, 17, корпус 1', 'не указано'],
            [2, ' Филиал Сбербанка №8613/0100', 56.109739, 47.480300, 'г.Новочебоксарск, улица Винокурова, 51', 'не указано'],
            [2, ' Филиал Сбербанка №8613/0101', 56.119729, 47.493115, 'г.Новочебоксарск, улица Винокурова, 20', 'не указано'],
            [2, ' Филиал Сбербанка №8613/0102', 56.124745, 47.499654, 'г.Новочебоксарск, улица Ж.Крутовой, 10а', 'не указано'],
            [2, ' Филиал Сбербанка №8613/0104', 56.112210, 47.489162, 'г.Новочебоксарск, улица Советская, 7', 'не указано'],
            [2, ' Филиал Сбербанка №8613/0105', 56.115889, 47.482263, 'г.Новочебоксарск, улица Советская, 15', 'не указано'],
            [2, ' Филиал Сбербанка №8613/0107', 56.109990, 47.447433, 'г.Новочебоксарск, улица 10-й Пятилетки, 31', 'не указано'],
            [2, ' Филиал Сбербанка №8613/0108', 56.115387, 47.456455, 'г.Новочебоксарск, улица Строителей, 16', 'не указано'],
            [2, ' Филиал Сбербанка №8613/0109', 56.103622, 47.477337, 'г.Новочебоксарск, улица 10-й Пятилетки, 2', 'не указано'],
          /*  [2, ' Филиал Сбербанка №8613/0110', 56.119384, 47.453556, 'г.Новочебоксарск, улица Советская, 65', 'не указано'], */
            [2, ' Филиал Сбербанка №8613/0111', 56.029714, 47.294007, 'п.г.т.Кугеси, улица Советская, 23', 'не указано'],
            [2, ' Филиал Сбербанка №8613/0400', 55.512156, 47.478812, 'г.Канаш, улица Железнодорожная, 87', 'не указано'],
            [2, ' Филиал Сбербанка №8613/0202', 55.494465, 46.413524, 'г.Шумерля, улица Октябрьская, 11', 'не указано'],
            [2, ' Филиал Сбербанка №8613/0300', 55.863542, 47.469771, 'г.Цивильск, улица Никитина, 2б', 'не указано'],
            [2, ' Филиал Сбербанка №8613/0226', 55.936969, 46.207218, 'г.Ядрин, улица Карла Маркса, 20', 'не указано'],
          ];
</script>
<body class="profile-page">

 @include('includes.profile_login_top_nav')
 @yield('content')
 @include('includes.profile-footer')


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
        type = 'Электронный кошелек';
        break;
        case '021':
        serie = '021';
        type = 'Месячный проездной на троллейбус Чебоксары';
        break;
        case '025':
        serie = '025';
        type = 'Месячный единый проездной';
        break;
        case '026':
        serie = '026';
        type = 'Месячный проездной на троллейбус Новочебоксарск';
        break;
        case '033':
        serie = '033';
        type = 'Карта учащегося';
        break;
        case '034':
        serie = '034';
        type = 'Карта студента';
        break;
        case '036':
        serie = '036';
        type = 'Карта учащегося Новочебоксарск';
        break;
        case '037':
        serie = '037';
        type = 'Карта студента Новочебоксарск';
        break;
        case '040':
        serie = '040';
        type = 'Месячный проездной на троллейбус Чебоксары';
        break;
        case '041':
        serie = '041';
        type = 'Месячный проездной на троллейбус Чебоксары';
        break;
        case '043':
        serie = '043';
        type = 'Месячный единый проездной Чебоксары';
        break;
        case '044':
        serie = '044';
        type = 'Месячный проездной на троллейбус Новочебоксарск';
        break;
        case '097':
        serie = '097';
        type = 'Банковская транспортная карта';
        break;
        case '099':
        serie = '099';
        type = 'УЭК';
        break;

        default :
        serie = '999';
        type = 'Неизвестный тип карты';
        break; 
      }
      $('#card_type').val(serie);
      html = '<span class="material-input" id="card_preview">'
      + type + '</span>';
      $('#card_preview').replaceWith(html);
    } else {
      html = '<span class="material-input" id="card_preview">Тип карты</span>';
      $('#card_preview').replaceWith(html);
    }
  });
</script>
    <script>
      $('#payment_value').on('keyup', function(){
        var value = ($('#payment_value').val() * 1.03);
        valueStr = value.toString();
        console.log('Перейти к оплате (' + valueStr + ' р.)');
        $('#submit_payment').val('Перейти к оплате (' + valueStr + ' р.)');
      });
    </script>
<script src="/js/chartist.min.js"></script>
<script src="/js/md.js"></script>

    <script>
      function initMap(withLocation) {
        var pos = null;
        var myLatLng = {lat: 56.113534, lng: 47.177142};
        var styleArray = [
          {
            featureType: 'all',
            stylers: [
              { saturation: -80 }
            ]
          },{
            featureType: 'road.arterial',
            elementType: 'geometry',
            stylers: [
              { hue: '#00ffee' },
              { saturation: 50 }
            ]
          },{
            featureType: 'poi.business',
            elementType: 'labels',
            stylers: [
              { visibility: 'off' }
            ]
          }
        ];
        // Create a map object and specify the DOM element for display.
        var geoinfoWindow = new google.maps.InfoWindow({map: map});
        mapBlock = document.getElementById('np-map');
        var map = new google.maps.Map(mapBlock, {
          center: myLatLng,
          scrollwheel: false,
          styles: styleArray,
          zoom: 11
        });
        if (withLocation == 1){
          if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
              pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
              };
              geoinfoWindow.setPosition(pos);
              geoinfoWindow.setContent('Вы находитесь здесь');
              map.setCenter(pos);
            }, function() {
              handleLocationError(true, geoinfoWindow, map.getCenter());
            });
        }
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, geoinfoWindow, map.getCenter());
        }
        console.log(pos);
        setMarkers(map);
      }
        // Create a marker and set its position.
        // 
        function handleLocationError(browserHasGeolocation, geoinfoWindow, pos) {
          geoinfoWindow.setPosition(pos);
          geoinfoWindow.setContent(browserHasGeolocation ?
                                'Произошла ошибка: геолокация недоступна.' :
                                'Произошла ошибка: Ваш браузер не поддерживает геолокацию.');
        }
        function setMarkers(map){
          for (var i = 0; i < depositPoints.length; i++) {
            var depositPoint = depositPoints[i];
            /*GET the variables */
            pointType = depositPoint[0];
            title = depositPoint[1];
            address = depositPoint[4];
            /*
             * Define the marker icon 
             */
            var image = {
              url: '/pictures/icons/' + depositPoint[0] + '.png',
              size: new google.maps.Size(25, 25),
              // The origin for this image is (0, 0).
              origin: new google.maps.Point(0, 0),
              // The anchor for this image is the base of the flagpole at (0, 32).
              anchor: new google.maps.Point(0, 25)
            }
            var shape = {
              coords: [1, 1, 1, 20, 18, 20, 18, 1],
              type: 'poly'
            };
            /*------------------*/
            var marker = new google.maps.Marker({
              position: {lat: depositPoint[2], lng: depositPoint[3]},
              map: map,
              icon: image,
              shape: shape,
              shadow: true,
              title: depositPoint[1],
              address: depositPoint[4],
              workhours: depositPoint[5]
            });
            var contentString = '<div id="content"' + 
                    '<div id="siteNotice">'+
                    '</div>'+
                    '<h4 id="firstHeading" class="firstHeading">' + title + '</h4>'+
                    '<div id="bodyContent">'+
                    '<p>Адрес: <strong>' + address + '</strong></p>'
                    '</div>';
            var infowindow = new google.maps.InfoWindow({
                content: contentString
            });
              google.maps.event.addListener(marker,'click', (function(marker,contentString,infowindow){ 
                  return function() {
                    //  infowindow.setContent(contentString);
                    //  infowindow.open(map,marker);
                      window.document.getElementById('deposit-point-title').innerHTML = marker.title;
                      window.document.getElementById('deposit-point-address').innerHTML = marker.address;
                      window.document.getElementById('deposit-point-workhours').innerHTML = marker.workhours;
                      map.setCenter(marker.getPosition());
                      map.setZoom(16);
                  };
              })(marker,contentString,infowindow)); 
            /*
            marker.addListener('click', function() {
             infowindow.open(map, marker);
             console.log(contentString);
            });*/
          }
        } //End setMarkers

       /* marker.setMap(map);*/
    </script>

<script>
  charts = {
    initCharts: function(){

      /* ----------==========    Rounded Line Chart initialization    ==========---------- */

      dataRoundedLineChart = {
        labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S'],
        series: [
        [12, 17, 7, 17, 23, 18, 38]
        ]
      };

      optionsRoundedLineChart = {
        lineSmooth: Chartist.Interpolation.cardinal({
          tension: 10
        }),
        axisX: {
          showGrid: false,
        },
        low: 0,
            high: 50, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
            chartPadding: { top: 0, right: 0, bottom: 0, left: 0},
            showPoint: false
          }

          var RoundedLineChart = new Chartist.Line('#roundedLineChart', dataRoundedLineChart, optionsRoundedLineChart);

          md.startAnimationForLineChart(RoundedLineChart);


          /*  **************** Straight Lines Chart - single line with points ******************** */

          dataStraightLinesChart = {
            labels: ['\'07','\'08','\'09', '\'10', '\'11', '\'12', '\'13', '\'14', '\'15'],
            series: [
            [10, 16, 8, 13, 20, 15, 20, 34, 30]
            ]
          };

          optionsStraightLinesChart = {
            lineSmooth: Chartist.Interpolation.cardinal({
              tension: 0
            }),
            low: 0,
            high: 50, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
            chartPadding: { top: 0, right: 0, bottom: 0, left: 0},
            classNames: {
              point: 'ct-point ct-white',
              line: 'ct-line ct-white'
            }
          }

          var straightLinesChart = new Chartist.Line('#straightLinesChart', dataStraightLinesChart, optionsStraightLinesChart);

          md.startAnimationForLineChart(straightLinesChart);




          /*  **************** Coloured Rounded Line Chart - Line Chart ******************** */


          dataColouredBarsChart = {
            labels: ['\'06','\'07','\'08','\'09', '\'10', '\'11', '\'12', '\'13', '\'14','\'15'],
            series: [
            [1000, 385, 490, 554, 586, 698, 695, 752, 788, 846, 944],
            [67, 152, 143,  287, 335, 435, 437, 539, 542, 544, 647],
            [23, 113, 67, 190, 239, 307, 308, 439, 410, 410, 509]
            ]
          };

          optionsColouredBarsChart = {
            lineSmooth: Chartist.Interpolation.cardinal({
              tension: 10
            }),
            axisY: {
              showGrid: true,
              offset: 40
            },
            axisX: {
              showGrid: false,
            },
            low: 0,
            high: 1000,
            showPoint: true,
            height: '300px'
          };


          var colouredBarsChart = new Chartist.Line('#colouredBarsChart', dataColouredBarsChart, optionsColouredBarsChart);

          md.startAnimationForLineChart(colouredBarsChart);



          /*  **************** Public Preferences - Pie Chart ******************** */

          var dataPreferences = {
            labels: percentages,
            series: amounts
          };

          var optionsPreferences = {
            height: '230px',
            donut: true,
            labelInterpolationFnc: function(value) {
              return value[0]
            }
          };
          var responsiveOptions = [
          ['screen and (min-width: 640px)', {
            chartPadding: 30,
            labelOffset: 100,
            labelDirection: 'explode',
            labelInterpolationFnc: function(value) {
              return value;
            }
          }],
          ['screen and (min-width: 1024px)', {
            labelOffset: 40,
            chartPadding: 20
          }]
          ];
       
       var chart =   Chartist.Pie('#chartPreferences', dataPreferences, optionsPreferences, responsiveOptions);

chart.on('draw', function(data) {
  if(data.type === 'slice') {
    // Get the total path length in order to use for dash array animation
    var pathLength = data.element._node.getTotalLength();

    // Set a dasharray that matches the path length as prerequisite to animate dashoffset
    data.element.attr({
      'stroke-dasharray': pathLength + 'px ' + pathLength + 'px'
    });

    // Create animation definition while also assigning an ID to the animation for later sync usage
    var animationDefinition = {
      'stroke-dashoffset': {
        id: 'anim' + data.index,
        dur: 1000,
        from: -pathLength + 'px',
        to:  '0px',
        easing: Chartist.Svg.Easing.easeOutQuint,
        // We need to use `fill: 'freeze'` otherwise our animation will fall back to initial (not visible)
        fill: 'freeze'
      }
    };

    // If this was not the first slice, we need to time the animation so that it uses the end sync event of the previous animation
    if(data.index !== 0) {
      animationDefinition['stroke-dashoffset'].begin = 'anim' + (data.index - 1) + '.end';
    }

    // We need to set an initial value before the animation starts as we are not in guided mode which would do that for us
    data.element.attr({
      'stroke-dashoffset': -pathLength + 'px'
    });

    // We can't use guided mode as the animations need to rely on setting begin manually
    // See http://gionkunz.github.io/chartist-js/api-documentation.html#chartistsvg-function-animate
    data.element.animate(animationDefinition, false);
  }
});

// For the sake of the example we update the chart every time it's created with a delay of 8 seconds
chart.on('created', function() {
  if(window.__anim21278907124) {
    clearTimeout(window.__anim21278907124);
    window.__anim21278907124 = null;
  }
  window.__anim21278907124 = setTimeout(chart.update.bind(chart), 10000);
});


/*  **************** Simple Bar Chart - barchart ******************** */

var dataSimpleBarChart = {
  labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
  series: amounts
};

var optionsSimpleBarChart = {
  seriesBarDistance: 10,
  axisX: {
    showGrid: false
  }
};

var responsiveOptionsSimpleBarChart = [
['screen and (max-width: 640px)', {
  seriesBarDistance: 5,
  axisX: {
    labelInterpolationFnc: function (value) {
      return value[0];
    }
  }
}]
];

var simpleBarChart = Chartist.Bar('#simpleBarChart', dataSimpleBarChart, optionsSimpleBarChart, responsiveOptionsSimpleBarChart);

        //start animation for the Emails Subscription Chart
        md.startAnimationForBarChart(simpleBarChart);


        var dataMultipleBarsChart = {
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
          series: [
          [542, 443, 320, 780, 553, 453, 326, 434, 568, 610, 756, 895],
          [412, 243, 280, 580, 453, 353, 300, 364, 368, 410, 636, 695]
          ]
        };

        var optionsMultipleBarsChart = {
          seriesBarDistance: 10,
          axisX: {
            showGrid: false
          },
          height: '300px'
        };

        var responsiveOptionsMultipleBarsChart = [
        ['screen and (max-width: 640px)', {
          seriesBarDistance: 5,
          axisX: {
            labelInterpolationFnc: function (value) {
              return value[0];
            }
          }
        }]
        ];

        var multipleBarsChart = Chartist.Bar('#multipleBarsChart', dataMultipleBarsChart, optionsMultipleBarsChart, responsiveOptionsMultipleBarsChart);

        //start animation for the Emails Subscription Chart
        md.startAnimationForBarChart(multipleBarsChart);
      }
    }
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
      charts.initCharts();
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
