@extends('layouts.master')

@section('description')
ООО "Единая транспортная карта" - оператор безналичной оплаты проезда в общественном транспорте города Чебоксары 
@endsection
@section('keywords')
етк чебоксары официальный сайт, етк чебоксары, единая транспортная карта чебоксары
@endsection
@section('title')
Единая транспортная карта
@endsection
@section('content')
<div class="page-header header-filter"  data-parallax="active" style="background-image: url(&quot;/images/bgs/bg_index_tr.jpg&quot;); transform: translate3d(0px, 0px, 0px);">


  <!--    <div class="container">
        <div class="row">
            <div class="col-md-3 col-md-offset-2 hidden-xs">
                <div class="iframe-container">
                    <img src="/images/online.png" alt="">
                </div>
            </div>
            <div class="col-md-7">
                <h1 class="title">На финишной прямой</h1>
                <h4>Мы все чаще получаем вопросы о том, можно ли пополнить карту онлайн. Поэтому мы подготовили небольшую статью о том, что для этого необходимо и как это будет работать.</h4>
                <br>
                <a href="/about_online" class="btn btn-success btn-lg">
                    Подробнее
                </a>
            </div>
        </div>
    </div> -->

           <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="title">Отложенное пополнение через Сбербанк Онлайн</h4>
                        <h5>С 14 февраля 2018 года Вы можете пополнить свой электронный кошелек или продлить проездной через популярный сервис Сбербанк Онлайн без комиссии. Напоминаем, что пока не все карты доступны для такого способа пополнения. </h5>
                        <a href="/about_online" class="btn btn-success">
                            Подробнее
                        </a>
                        <a href="/instructions/sbol" class="btn btn-success">
                            Инструкция
                        </a>
                    </div>
                    <div class="col-md-5 col-md-offset-1">
                        <img src="/images/sbol.png" alt="">
                       <!-- <div class="iframe-container">
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/kRkwzlgrKlk" frameborder="0" allow="autoplay; encrypted-media" height="300" allowfullscreen></iframe>
                        </div> -->
                    </div> 
                </div>
            </div>

</div>
<div class="main main-raised">
    <div class="section section-basic">
        <div class="container">
         <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center">
                <h2 class="title">Последние новости</h2>
                <h5 class="description"><a href="{{ route('news') }}">смотреть все новости</a></h5>
                <div class="section-space"></div>
            </div>
        </div>

        <div class="space-50"></div>
        <div class="row">
            @foreach ($articles as $article)
            <div class="col-md-4">
                <div class="card card-blog">
                    <div class="card-image">
                        <a href="">
                            <img class="img" src="{{$article->image}}">
                        </a>
                        <div class="ripple-container"></div></div>
                        <div class="content">
                            <h4 class="card-title">
                                <a href="{{route('article',['id' => $article->id])}}">{{ $article->title }}</a>
                            </h4>
                            <small>{{$article->description}}</small>
                            <div class="footer">
                                <small style="float:left;"><a href="{{route('article',['id' => $article->id])}}">ПОДРОБНЕЕ</a></small>
                                <div class="stats">
                                    <i class="material-icons">schedule</i>{{ $article->created_at }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="projects-4" id="projects-4">

                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2 text-center">
                            <h2 class="title">Типы карт</h2>
                            <h5 class="description">Вы можете выбрать карту, подходящую именно Вам</h5>
                            <div class="section-space"></div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-5 col-md-offset-1">
                            <div class="card card-background" style="background-image: url('/images/e-wallet.jpg')">
                                <a href="{{route('cards.ewallet')}}">

                                </a>
                                <div class="content">
                                    <label class="label label-rose">На предъявителя</label>
                                    <a href="{{route('cards.ewallet')}}">
                                        <h3 class="card-title">Электронный кошелек</h3>
                                    </a>
                                    <p class="card-description">
                                        Оплачивайте проезд в общественном транпорте со скидкой!
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="info info-horizontal">
                                <div class="icon icon-info">

                                </div>
                                <div class="description">
                                    <h4 class="info-title">Стоимость</h4>
                                    <p class="description">
                                     100 рублей
                                 </p>
                             </div>
                         </div>

                         <div class="info info-horizontal">
                            <div class="icon icon-primary">
                            </div>
                            <div class="description">
                                <h4 class="info-title">Срок службы</h4>
                                <p class="description">
                                    до 5 лет
                                </p>
                            </div>
                        </div>

                        <div class="info info-horizontal">
                            <div class="icon icon-danger">
                            </div>
                            <div class="description">
                                <h4 class="info-title">Тариф</h4>
                                <p class="description">
                                    Остаток средств переходит на следующий месяц
                                </p>
                            </div>
                        </div>
                    </div>

                </div>

                <hr>

                <div class="row">

                    <div class="col-md-5 col-md-offset-1">
                        <div class="info info-horizontal">
                            <div class="icon icon-rose">
                            </div>
                            <div class="description">
                                <h4 class="info-title">Стоимость</h4>
                                <p class="description">
                                    100 рублей
                                </p>
                            </div>
                        </div>

                        <div class="info info-horizontal">
                            <div class="icon icon-success">
                            </div>
                            <div class="description">
                                <h4 class="info-title">Срок службы</h4>
                                <p class="description">
                                    до 5 лет
                                </p>
                            </div>
                        </div>

                        <div class="info info-horizontal">
                            <div class="icon icon-info">
                            </div>
                            <div class="description">
                                <h4 class="info-title">Тариф</h4>
                                <p class="description">
                                    от 500 до 1050 рублей
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="card card-background" style="background-image: url('/images/tickets.jpg')">
                            <a href="{{route('cards.travel_cards')}}">
                            </a>
                            <div class="content">
                                <label class="label label-rose">Именные</label>
                                <a href="{{route('cards.travel_cards')}}">
                                    <h2 class="card-title">Проездные</h2>
                                </a>
                                <p class="card-description">
                                    Месячные проездные билеты на троллейбус и автобус для граждан, студентов и школьников
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
                <hr>
                <div class="row">

                    <div class="col-md-5 col-md-offset-1">
                        <div class="card card-background" style="background-image: url('/images/sber.jpg')">
                            <a href="{{route('cards.sbercard')}}"">

                            </a>
                            <div class="content">
                                <label class="label label-rose">Именная</label>
                                <a href="{{route('cards.sbercard')}}">
                                    <h3 class="card-title">Банковская транспортная карта</h3>
                                </a>
                                <p class="card-description">
                                    2 в 1. Банковская карта с транспортным приложением
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="info info-horizontal">
                            <div class="icon icon-info">

                            </div>
                            <div class="description">
                                <h4 class="info-title">Стоимость</h4>
                                <p class="description">
                                 Уточняйте в филиалах Сбербанка
                             </p>
                         </div>
                     </div>

                     <div class="info info-horizontal">
                        <div class="icon icon-primary">
                        </div>
                        <div class="description">
                            <h4 class="info-title">Срок службы</h4>
                            <p class="description">
                                указывается на карте
                            </p>
                        </div>
                    </div>

                    <div class="info info-horizontal">
                        <div class="icon icon-danger">
                        </div>
                        <div class="description">
                            <h4 class="info-title">Тариф</h4>
                            <p class="description">
                                Остаток средств переходит на следующий месяц
                            </p>
                        </div>
                    </div>
                </div>

            </div>
            <!-- partners -->
            <div class="row">
                <div class="features-1">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <h3 class="title">Партнеры</h3>
                        </div>
                    </div>
                    <div class="row partners-block">
                        <div class="col-md-4">
                            <div class="info">
                                <img src="/pictures/partners/sberbank2010.png" alt="Сбербанк России" class="mx-auto partner-logo">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="info">
                             <img src="/pictures/partners/umarsh.png" alt="Удобный маршрут" class="mx-auto partner-logo">
                         </div>
                     </div>

                     <div class="col-md-4">
                        <div class="info">
                         <img src="/pictures/partners/steelbank.png" alt="Стальбанк" class="mx-auto partner-logo">
                     </div>
                 </div>
             </div>
             <div class="row partners-block">
                <div class="col-md-4">
                    <div class="info">
                        <img src="/pictures/partners/get.png" alt="Горэлектротранс" class="mx-auto partner-logo">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="info">
                     <img src="/pictures/partners/pochta.png" alt="Почта России" class="mx-auto partner-logo">
                 </div>
             </div>

             <div class="col-md-4">
                <div class="info">
                  <img src="/pictures/partners/chat.png" alt="Чувашавтотранс" class="mx-auto partner-logo">
              </div>
          </div>
      </div>
      <div class="row partners-block">
        <div class="col-md-4 col-md-offset-2">
            <div class="info">
                <img src="/pictures/partners/isbc.png" alt="ISBC" class="mx-auto partner-logo">
            </div>
        </div>
        <div class="col-md-4">
            <div class="info">
                <img src="/pictures/partners/chkpb.jpg" alt="Чувашкредитпромбанк" class="mx-auto partner-logo">
            </div>
        </div>
    </div>
</div>
</div>
<!-- end partners -->
                   <!-- map block 
                   <div class="container-fluid up-a-little hidden-xs" id="map">
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
      '<h2 id="firstHeading" class="firstHeading">Московский проспект, д.41/1, помещение 1</h2>'+
      '<i>Остановка <strong>улица Кривова</strong></i>' +
      '<div id="bodyContent">'+
      '<p>Телефоны: <strong>(8352) 36-03-30, 36-33-30</strong></p>'+
      '<p>Электронная почта: Uluru, <a href="mailto:transkarta@bk.ru">'+
      'transkarta@bk.ru</a> </p>'+
      '<p>Режим работы:<strong> с 6 по 19</strong> число каждого месяца:<br> Пн-Пт <strong>c 8:00 до 17:00</strong>, обед с 12 до 13</p>'+
       '<p><strong> с 20 по 5</strong> число:<br> Пн-Пт <strong>c 8:00 до 17:30</strong>, без обеда. Сб: <strong>с 9:00 до 15:00</strong></p>'+
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
end map block -->


</div>
</div>
</div>
</div>
</div>

@endsection
