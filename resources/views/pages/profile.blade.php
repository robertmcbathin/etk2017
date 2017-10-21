@extends('layouts.profile')
@section('description')
личный кабинет держателя карты ЕТК
@endsection
@section('keywords') 
@endsection
@section('title')
Личный кабинет
@endsection
@section('content')
<div class="page-header header-filter" data-parallax="active" style="background-image: url(&quot;/images/bgs/triangle-background.jpg&quot;); transform: translate3d(0px, 0px, 0px);">
</div>
<div class="main main-raised">
  <div class="profile-content">
    <div class="container">
      <div class="tab-pane">
        @if (Session::has('error'))
        <div class="row">
          <div class="container">
            <div class="alert alert-danger">
              <div class="container">
                <div class="alert-icon">
                  <i class="material-icons">error_outline</i>
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true"><i class="material-icons">clear</i></span>
                </button>
                <strong>{{Session::pull('error')}}</strong>
              </div>
            </div>  
          </div>
        </div>
        @endif

        @if (Session::has('success'))
        <div class="row">
          <div class="container">
            <div class="alert alert-success">
              <div class="container">
                <div class="alert-icon">
                  <i class="material-icons">check</i>
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true"><i class="material-icons">clear</i></span>
                </button>
                <strong>{{Session::pull('success')}}</strong>
              </div>
            </div>  
          </div>
        </div>
        @endif
        @if (Session::has('verified-fail'))
        <div class="row">
          <div class="container">
            <div class="alert alert-danger">
              <div class="container">
                <div class="alert-icon">
                  <i class="material-icons">error_outline</i>
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true"><i class="material-icons">clear</i></span>
                </button>
                <strong>{{Session::pull('verified-fail')}}</strong>
              </div>
            </div>  
          </div>
        </div>
        @endif
        @if (Session::has('verified-card-search-fail'))
        <div class="row">
          <div class="container">
            <div class="alert alert-danger">
              <div class="container">
                <div class="alert-icon">
                  <i class="material-icons">error_outline</i>
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true"><i class="material-icons">clear</i></span>
                </button>
                <strong>{{Session::pull('verified-card-search-fail')}}</strong>
              </div>
            </div>  
          </div>
        </div>
        @endif
        @if (Session::has('verified-ok'))
        <div class="row">
          <div class="container">
            <div class="alert alert-success">
              <div class="container">
                <div class="alert-icon">
                  <i class="material-icons">check</i>
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true"><i class="material-icons">clear</i></span>
                </button>
                <strong>{{Session::pull('verified-ok')}}</strong>
              </div>
            </div>  
          </div>
        </div>
        @endif
        <div class="row">
          <div class="col-md-6 col-md-offset-1 col-sm-6">
            <h4 class="title">Мои карты</h4>
            <div class="row collections">
              @if (count($cards) !== 0)
              @foreach ($cards as $card)
              <div class=" col-xs-6 col-md-6">
                <div class="card card-plain card-blog">
                  <div class="row">
                    <div class="col-xs-12 col-md-6">
                      <div class="card-image">
                        <img class="img img-raised" src="/pictures/cards/thumbnails/160/{{$card->card_image_type}}.png">
                        <div class="colored-shadow" style="background-image: url(&quot;assets/img/examples/card-blog4.jpg&quot;); opacity: 1;"></div><div class="ripple-container"></div></div>
                      </div>
                      <div class="col-xs-12 col-md-6">
                        @if (Session::get('current_card_number') == $card->number)
                          <span class="label label-rose">Выбранная карта</span>
                        @endif
                        <h6 class="category text-info">{{ $card->name}}</h6>
                        @if ($card->verified == 0)
                        <h5 class="card-title">
                          <a href="{{ route('profile.set_current_card.set', ['current_card' => $card->number, 'user_id' => Auth::user()->id]) }}" data-toggle="tooltip" data-placement="right" data-container="body" data-original-title="Выбрать карту в качестве активной">{{ $card->number }}</a> <i class="material-icons" data-toggle="tooltip" data-placement="right" data-container="body" data-original-title="Данная карта не подтверждена. Чтобы иметь возможность заблокировать карту или просмотреть информацию по поездкам, Вам необходимо подтвердить карту">lock</i>
                        </h5>
                        <button class="btn btn-simple btn-github" data-toggle="modal" data-target="#verify-card-number-{{$card->number}}">
                         <i class="material-icons">lock</i> Подтвердить
                         <div class="ripple-container"></div>
                       </button>
                       @else
                       <h5 class="card-title">
                        <a href="{{ route('profile.set_current_card.set', ['current_card' => $card->number, 'user_id' => Auth::user()->id]) }}" data-toggle="tooltip" data-placement="right" data-container="body" data-original-title="Выбрать карту в качестве активной">{{ $card->number }}</a> <i class="material-icons" data-toggle="tooltip" data-placement="right" data-container="body" data-original-title="Карта успешно подтверждена. Вы можете просмотреть статистику по карте и заказать детализацию">lock_open</i>
                      </h5>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
              @else 
              <p class="description">Нет добавленных карт. Добавить карты Вы можете в разделе <a href="{{ route('profile.settings') }}">настройки</a>.</p>
              @endif
            </div>

          </div>
          <div class="col-md-3 col-md-offset-1 stats col-sm-3">
            <h4 class="title">Информация по карте</h4>
            <ul class="list-unstyled">
              <li>Номер <b>{{ session()->get('current_card_number', 'неизвестно') }}</b></li>
              <li>Баланс <b>{{ session()->get('current_card_balance', 'неизвестно') }} <i class="fa fa-ruble"></i></b></li>
              <li>Последняя операция по карте <b>{{ session()->get('current_card_last_transaction', 'н/д') }}</b></li>
              <li>Тип <b>{{ session()->get('current_card_kind', 'неизвестно') }}</b></li>
              <li>Состояние <b>{{ session()->get('current_card_state', 'неизвестно') }}</b></li>
              @if ((session()->get('current_card_verified') == 1) && ((session()->get('current_card_block_state') == 0) && (session()->get('current_card_state')) == 'В обращении') )
              <button class="btn btn-simple" data-toggle="modal" data-target="#block-card-{{ session()->get('current_card_number') }}">
               <i class="fa fa-lock"></i> Заблокировать
             </button>
             @elseif ((session()->get('current_card_verified') == 1) && (session()->get('current_card_block_state') == 1))
             <button class="btn btn-simple" data-toggle="modal" data-target="#cancel-block-card-{{ session()->get('current_card_number') }}">
               <i class="fa fa-lock"></i> Отменить блокировку
             </button>
             @endif
           </ul>
           <hr>

         </div>
       </div>
     </div>
     <h4 class="title">Последние новости</h4>
     <div class="row">
       @foreach ($articles as $article)

       <div class="card card-plain card-blog padding-plus">
        <div class="row">
          <div class="col-md-4">
            <div class="card-image">
              <img class="img img-raised" src="{{$article->image}}">
              <div class="colored-shadow" style="background-image: url(&quot;assets/img/examples/card-blog4.jpg&quot;); opacity: 1;"></div><div class="ripple-container"></div></div>
            </div>
            <div class="col-md-8">
              <h6 class="card-title">
                <a href="{{route('article',['id' => $article->id])}}">{{ $article->title }}</a>
              </h6>
              <p class="card-description">
                {{ $article->description }}<a href="{{route('article',['id' => $article->id])}}"> Подробнее </a>
              </p>
              <p class="author">
                <i class="material-icons">schedule</i>{{ $article->created_at }}

              </p></div>
            </div>
          </div>

          @endforeach
        </div>
      </div>

    </div>
  </div>

  @foreach ($cards as $card)
  <div class="modal fade" id="verify-card-number-{{$card->number}}" tabindex="-1" role="dialog" aria-labelledby="verify-number" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="material-icons">clear</i>
          </button>
          <h4 class="modal-title">Подтверждение карты № {{ $card->number }}</h4>
          <h6>Для подтверждения владения картой Вам необходимо ввести <strong>первые 8 символов</strong> чипа карты</h6>
          <small class="description"><b>Узнать номер чипа Вы можете при пополнении на устройстве самообслуживания Сбербанка.</b> Номер чип карты Вы можете найти на чеке, который выдает устройство самоослуживания при пополнении карты или на экране данного устройства при прикладывании карты к считывателю.</small>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6 col-md-offset-3">
              <div class="form-group is-empty">
                <form action="{{ route('profile.verify_card') }}" method="POST">
                  <input type="text" placeholder="AAAAAAAA" class="form-control" name="chip" minlength="8" maxlength="8">
                  <span class="material-input"></span>
                  <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                  <input type="hidden" name="number" value="{{$card->number}}">
                  {{ csrf_field() }}
                  <p class="description">Ввод латиницей заглавными буквами</p>
                  <button type="submit" class="btn btn-profile">Подтвердить</button>
                </form>
                <span class="material-input"></span></div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Отмена<div class="ripple-container"><div class="ripple ripple-on ripple-out" style="left: 17.0781px; top: 20px; background-color: rgb(244, 67, 54); transform: scale(8.50977);"></div></div></button>
        </div>
      </div>
    </div>
  </div>
  @endforeach
  <!-- BLOCK CARD -->
  @if (session()->get('current_card_verified') == 1)
  <div class="modal fade" id="block-card-{{ session()->get('current_card_number') }}" tabindex="-1" role="dialog" aria-labelledby="block-card" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="material-icons">clear</i>
          </button>
          <h4 class="modal-title">Блокировка карты № {{ session()->get('current_card_number') }}</h4>
          <p class="description danger">Обращаем Ваше внимание, что карта будет заблокирована при следующей поездке, но не раньше чем на следующий день после внесения ее в блокировочный список. Вы можете отменить заявление на блокировку карты до 18:00 текущего дня.</p>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6 col-md-offset-3">
             <form action="{{ route('profile.block_card.post') }}" method="POST">
              <input type="hidden" name="current_card" value="{{ session()->get('current_card_number') }}">
              <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
              <input type="hidden" name="to_state" value="02">
              {{ csrf_field()}}
              <button type="submit" class="btn btn-primary">
               <i class="fa fa-lock"></i> Заблокировать карту №{{ session()->get('current_card_number') }}
               <div class="ripple-container"></div>
             </button>
           </form>
         </div>
       </div>
     </form>
   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Отмена<div class="ripple-container"><div class="ripple ripple-on ripple-out" style="left: 17.0781px; top: 20px; background-color: rgb(244, 67, 54); transform: scale(8.50977);"></div></div></button>
  </div>
</div>
</div>
</div>
@endif
<!-- CANCEL BLOCK CARD -->
@if (session()->get('current_card_verified') == 1)
<div class="modal fade" id="cancel-block-card-{{ session()->get('current_card_number') }}" tabindex="-1" role="dialog" aria-labelledby="cancel-block-card" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="material-icons">clear</i>
        </button>
        <h4 class="modal-title">Отмена блокировки карты № {{ session()->get('current_card_number') }}</h4>
        <p class="description danger">Обращаем Ваше внимание, что карта будет заблокирована при следующей поездке, но не раньше чем на следующий день после внесения ее в блокировочный список. Вы можете отменить заявление на блокировку карты до 18:00 текущего дня.</p>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6 col-md-offset-3">
           <form action="{{ route('profile.cancel_block_card.post') }}" method="POST">
            <input type="hidden" name="current_card" value="{{ session()->get('current_card_number') }}">
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            {{ csrf_field()}}
            <button type="submit" class="btn btn-primary">
             <i class="fa fa-lock"></i> Отменить блокировку №{{ session()->get('current_card_number') }}
             <div class="ripple-container"></div>
           </button>
         </form>
       </div>
     </div>
   </form>
 </div>
 <div class="modal-footer">
  <button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Отмена<div class="ripple-container"><div class="ripple ripple-on ripple-out" style="left: 17.0781px; top: 20px; background-color: rgb(244, 67, 54); transform: scale(8.50977);"></div></div></button>
</div>
</div>
</div>
</div>
@endif


<div class="modal fade" id="modal-map" tabindex="-1" role="dialog" aria-labelledby="modal-map" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="material-icons">clear</i>
        </button>
        <h4 class="modal-title">Ближайшие пункты пополнения</h4>
        <div id="nearest-points">

        </div>
        <small class="description"></small>
      </div>
      <div class="modal-body">
        <div id="np-map"></div>
      </div>
    </form>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Отмена<div class="ripple-container"><div class="ripple ripple-on ripple-out" style="left: 17.0781px; top: 20px; background-color: rgb(244, 67, 54); transform: scale(8.50977);"></div></div></button>
  </div>
</div>
</div>
</div>
<script>
/*
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
          zoom: 14
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
        showNearestPoints(pos,map);
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
 /*           pointType = depositPoint[0];
            title = depositPoint[1];
            address = depositPoint[4];
            /*
             * Define the marker icon 
             */
 /*            var image = {
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
  /*          var marker = new google.maps.Marker({
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
/*
        function showNearestPoints(pos,map){
          var bounds = new google.maps.LatLngBounds;
          var geocoder = new google.maps.Geocoder;
          var service = new google.maps.DistanceMatrixService;
          var originCoords = [];
          for (var i = 0; i < depositPoints.length; i++) {
              originCoords[i] = {lat: 56.141376, lng: 47.201622}; 
            }
          var destCoords = [];
          for (var i = 0; i < depositPoints.length; i++) {
              destCoords[i] = {lat: depositPoints[i][2], lng: depositPoints[i][3]}; 
            }

          service.getDistanceMatrix({
            origins: originCoords,
            destinations: destCoords,
            travelMode: 'DRIVING',
            unitSystem: google.maps.UnitSystem.METRIC,
            avoidHighways: false,
            avoidTolls: false
          }, function(response, status) {
            if (status !== 'OK') {
              alert('Ошибка: ' + status);
            } else {
              var originList = response.originAddresses;
              var destinationList = response.destinationAddresses;
              var outputDiv = document.getElementById('nearest-points');
              outputDiv.innerHTML = '';
             /* deleteMarkers(markersArray); */
/*
              var showGeocodedAddressOnMap = function(asDestination) {
              return function(results, status) {
                if (status === 'OK') {
                  map.fitBounds(bounds.extend(results[0].geometry.location));
                } else {
                  alert('Geocode was not successful due to: ' + status);
                }
              };
            };
              for (var i = 0; i < 10; i++) {
                var results = response.rows[i].elements;
                console.log(results);
                for (var j = 0; j < results.length; j++) {
                  geocoder.geocode({'address': destinationList[j]},
                    showGeocodedAddressOnMap(true));
                  outputDiv.innerHTML += 
                  depositPoints[j][4] + ' ' + results[j].distance.text + ' за ' +
                  results[j].duration.text + '<br>';
                }
              }
            }
          });
        } */

        /* marker.setMap(map);*/
      </script>
     <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDsfO8qFpSStho6O8-HQwpZEkaOv1ynK5A&callback=initMap"
      async defer></script> --> 

    </div>
    @endsection





