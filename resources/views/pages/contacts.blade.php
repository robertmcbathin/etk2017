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
        <div class="col-md-4 col-md-offset-2">
          <div class="info info-horizontal">
            <div class="icon icon-primary">
              <i class="material-icons">pin_drop</i>
            </div>
            <h4 class="info-title">Пункты обслуживания физических лиц</h4>
            <p>
              Мини-офис СЗР <strong>г. Чебоксары, ул. Гузовского, 17</strong>
            </p>
            <p>
              Мини-офис Центр <strong>г. Чебоксары, ул. Карла Маркса, 22</strong>
            </p>
            <p>
              Мини-офис НЮР <strong>г. Чебоксары, пр-кт Тракторостроителей, 35а</strong>
            </p>
            <p>
              Мини-офис Нчк <strong>г. Новочебоксарск, ул. Винокурова, 51</strong>
            </p>
            <h4 class="info-title">Пункты обслуживания юридических лиц</h4>
            <p>
              Центральный офис <strong>г. Чебоксары, пр-кт Тракторостроителей, 6б</strong>
            </p>
            <p><i class="material-icons">call</i> (8352) 36-03-30, 36-33-30</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="info info-horizontal">
            <div class="icon icon-primary">
            <i class="material-icons">query_builder</i>
            </div>
            <div class="description">
              <h4 class="info-title">Режим работы</h4>
              <p>Мини-офисы: Пн-Пт <strong>c 9:00 до 18:00</strong>, обед с 13 до 14</p>
              <p>Офис по обслуживанию юридических лиц: Пн-Пт <strong>c 8:00 до 17:00</strong>, обед с 12 до 13</p>
            </div>
            <div class="description">
              <h4 class="info-title">Реквизиты</h4>
              <p>ИНН/КПП: <strong>2130080498/213001001</strong></p>
              <p>ОГРН: <strong>1102130012764</strong></p>
              <p>Юридический и фактический адрес: <strong>428028, г. Чебоксары, пр-кт Тракторостроителей, 6б</strong></p>
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
        //4th Marker
        var marker4th = new google.maps.Marker({
          position: {lat: 56.109684, lng: 47.480350},
          map: map
        });
        var contentString4th = '<div id="content">'+
        '<div id="siteNotice">'+
        '</div>'+
        '<h4 id="firstHeading" class="firstHeading">город Новочебоксарск, улица Винокурова, 51</h4>'+
        '<div id="bodyContent">'+
        '<p>Телефоны: <strong>(8352) 36-03-30, 36-33-30</strong></p>'+
        'transkarta@bk.ru</a> </p>'+
        '</div>'+
        '</div>';

        var infowindow4th = new google.maps.InfoWindow({
          position: {lat: 56.140717, lng: 47.199408},
          content: contentString4th
        });
        infowindow4th.open(map,marker4th);
        marker4th.addListener('click', function() {
          infowindow4th.open(map, marker4th);
        }); 
        //5th Marker
        var marker5th = new google.maps.Marker({
          position: {lat: 56.101350, lng: 47.301017},
          map: map
        });
        var contentString5th = '<div id="content">'+
        '<div id="siteNotice">'+
        '</div>'+
        '<h4 id="firstHeading" class="firstHeading">проспект Тракторостроителей, 35а</h4>'+
        '<div id="bodyContent">'+
        '<p>Телефоны: <strong>(8352) 36-03-30, 36-33-30</strong></p>'+
        'info@etk21.ru</a> </p>'+
        '</div>'+
        '</div>';

        var infowindow5th = new google.maps.InfoWindow({
          position: {lat: 56.140717, lng: 47.199408},
          content: contentString5th
        });
        infowindow5th.open(map,marker5th);
        marker5th.addListener('click', function() {
          infowindow5th.open(map, marker5th);
        }); 
      }
      
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDsfO8qFpSStho6O8-HQwpZEkaOv1ynK5A&callback=initMap"
    async defer></script>

  </div>

  @endsection