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
              <p> Пн-Пт <strong>c 9:00 до 18:00</strong>, обед с 13 до 14</p>
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
          zoom: 11
        });
        //First Marker
        var markerOne = new google.maps.Marker({
          position: {lat: 56.145881, lng: 47.185274},
          map: map
        });
        var contentStringOne = '<div id="content">'+
        '<div id="siteNotice">'+
        '</div>'+
        '<h4 id="firstHeading" class="firstHeading">улица Гузовского, 17 (отделение Сбербанка)</h4>'+
        '<div id="bodyContent">'+
        '<p>Телефоны: <strong>(8352) 36-03-30, 36-33-30</strong></p>'+
        'transkarta@bk.ru</a> </p>'+
        '</div>'+
        '</div>';

        var infowindowOne = new google.maps.InfoWindow({
          position: {lat: 56.140717, lng: 47.199408},
          content: contentStringOne
        });
        infowindowOne.open(map,markerOne);
        markerOne.addListener('click', function() {
          infowindowOne.open(map, markerOne);
        }); 
        //Second Marker
        var markerTwo = new google.maps.Marker({
          position: {lat: 56.143257, lng: 47.250454},
          map: map
        });
        var contentStringTwo = '<div id="content">'+
        '<div id="siteNotice">'+
        '</div>'+
        '<h4 id="firstHeading" class="firstHeading">улица Карла Маркса, 22 (отделение Сбербанка)</h4>'+
        '<div id="bodyContent">'+
        '<p>Телефоны: <strong>(8352) 36-03-30, 36-33-30</strong></p>'+
        'transkarta@bk.ru</a> </p>'+
        '</div>'+
        '</div>';

        var infowindowTwo = new google.maps.InfoWindow({
          position: {lat: 56.140717, lng: 47.199408},
          content: contentStringTwo
        });
        infowindowTwo.open(map,markerTwo);
        markerTwo.addListener('click', function() {
          infowindowTwo.open(map, markerTwo);
        }); 
        //Third Marker
        var markerThird = new google.maps.Marker({
          position: {lat: 56.096485, lng: 47.295166},
          map: map
        });
        var contentStringThird = '<div id="content">'+
        '<div id="siteNotice">'+
        '</div>'+
        '<h4 id="firstHeading" class="firstHeading">проспект Тракторостроителей, 6б</h4>'+
        '<h5 id="firstHeading" class="firstHeading"><strong>(только для юридических лиц)</strong></h5>'+
        '<div id="bodyContent">'+
        '<p>Телефоны: <strong>(8352) 36-03-30, 36-33-30</strong></p>'+
        'transkarta@bk.ru</a> </p>'+
        '</div>'+
        '</div>';

        var infowindowThird = new google.maps.InfoWindow({
          position: {lat: 56.140717, lng: 47.199408},
          content: contentStringThird
        });
        infowindowThird.open(map,markerThird);
        markerThird.addListener('click', function() {
          infowindowThird.open(map, markerThird);
        }); 
      }
      
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDsfO8qFpSStho6O8-HQwpZEkaOv1ynK5A&callback=initMap"
    async defer></script>

  </div>

  @endsection
