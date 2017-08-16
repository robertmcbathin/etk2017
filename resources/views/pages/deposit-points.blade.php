@extends('layouts.map')

@section('description')
Пункты пополнения карт ЕТК
@endsection
@section('keywords')
етк чебоксары пункты пополнения, 
@endsection
@section('title')
Пункты пополнения
@endsection
@section('content')
<div class="page-header header-filter simple-page-bg" data-parallax="active" style="background-image: url(&quot;/images/bgs/bg_about.jpg&quot;); transform: translate3d(0px, 0px, 0px);">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1 class="title">Пункты пополнения</h1>
            </div>
        </div>
    </div>
</div>
<div class="contactus-2">
        
         <div id="map" class="map">
         </div>
         <div class="card card-contact card-raised">
            <form role="form" id="contact-form" method="post">
                <div class="header header-raised header-rose text-center">
                    <h4 class="card-title" id="deposit-point-title">Выберите пункт на карте</h4>
                </div>
                <div class="content">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info info-horizontal">
                                <div class="icon icon-rose">
                                    <i class="material-icons">pin_drop</i>
                                </div>
                                <div class="description">
                                    <h5 class="info-title">Адрес</h5>
                                    <p id="deposit-point-address"> </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info info-horizontal">
                                <div class="icon icon-rose">
                                    <i class="material-icons">access_time</i>
                                </div>
                                <div class="description">
                                    <h5 class="info-title">Режим работы</h5>
                                    <p id="deposit-point-workhours"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                      <a href="{{route('deposit-points-list')}}" style="float:right;">Смотреть весь список</a>
                    </div>
                </div>

            </form>
        </div>
  </div>
</div>
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
        mapBlock = document.getElementById('map');
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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDsfO8qFpSStho6O8-HQwpZEkaOv1ynK5A&callback=initMap"
        async defer></script>

    </div>

@endsection
