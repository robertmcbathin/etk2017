@extends('layouts.master')

@section('description')
Единая транспортная карта
@endsection
@section('keywords')
ЕТК
@endsection
@section('title')
Контакты
@endsection
@section('content')
<div class="page-header header-filter simple-page-bg" data-parallax="active" style="background-image: url(&quot;/images/bgs/bg_temp3.jpg&quot;); transform: translate3d(0px, 0px, 0px);">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <h1 class="title">Контакты</h1>
      </div>
    </div>
  </div>
</div>
<div class="contactus-2">

 <div id="map" class="map">
 </div>
</div>
<div class="main main-raised">
  <div class="contact-content">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="info info-horizontal">
            <div class="icon icon-primary">
              <i class="material-icons">pin_drop</i>
            </div>
            <div class="description">
              <h4 class="info-title">Режим работы</h4>
              <p><strong>с 6 по 19</strong> число каждого месяца: Пн-Пт <strong>c 8:00 до 17:00</strong>, обед с 12 до 13</p>
              <p><strong>с 20 по 5</strong> число: Пн-Пт <strong>c 8:00 до 17:30</strong>, без обеда. Сб.: <strong>c 9:00 до 15:00</strong></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function initMap() {
    var myLatLng = {lat: 56.141757, lng: 47.199441};
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
        mapBlock = document.getElementById('map');
        var map = new google.maps.Map(mapBlock, {
          center: myLatLng,
          scrollwheel: false,
          styles: styleArray,
          zoom: 16
        });
        var marker = new google.maps.Marker({
          position: {lat: 56.140717, lng: 47.199408},
          map: map
        });
        var contentString = '<div id="content">'+
        '<div id="siteNotice">'+
        '</div>'+
        '<h3 id="firstHeading" class="firstHeading">Московский проспект, д.41/1, помещение 1</h3>'+
        '<i>Остановка <strong>улица Кривова</strong></i>' +
        '<div id="bodyContent">'+
        '<p>Телефоны: <strong>(8352) 36-03-30, 36-33-30</strong></p>'+
        '<p>Электронная почта: Uluru, <a href="mailto:transkarta@bk.ru">'+
        'transkarta@bk.ru</a> </p>'+
        '</div>'+
        '</div>';

        var infowindow = new google.maps.InfoWindow({
          position: {lat: 56.140717, lng: 47.199408},
          content: contentString
        });
        infowindow.open(map,marker);
        marker.addListener('click', function() {
          infowindow.open(map, marker);
        }); 
      }
      
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDsfO8qFpSStho6O8-HQwpZEkaOv1ynK5A&callback=initMap"
    async defer></script>

  </div>

  @endsection
