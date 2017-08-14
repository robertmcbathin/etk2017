@extends('layouts.master')

@section('description')
Система лояльности для держателей транспортных карт
@endsection
@section('keywords')

@endsection
@section('title')
Карта с приложением ЕТКплюс
@endsection
@section('content')
<div class="page-header simple-page-bg" data-parallax="active" style="background-image: url(&quot;/images/bgs/etkplus-bg2.jpg&quot;); transform: translate3d(0px, 0px, 0px); ">
    <div class="container">
        <div class="row">
        <div class="col-md-10 col-md-offset-1">
                <h1 class="title">Карта ЕТКплюс</h1>
            </div>
        </div>
    </div>
</div>
<div class="main main-raised">
    <div class="section section-basic">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <ol class="breadcrumb">
                      <li><a href="{{route('static_articles')}}">Дополнительная информация</a></li>
                      <li class="active">Карта ЕТКплюс</li>
                  </ol>
              </div>
          </div>
          <div class="row">
            <div class="col-md-8 col-md-offset-2">
                        <h3 class="title">Новые типы транспортных карт с бонусным приложением</h3>
                        <p>Специально для держателей транспортных карт мы запускаем новую серию карт - с бонусным приложением ЕТКплюс!</p>
                        <br>
                        <img class="img-rounded img-responsive img-raised" alt="ЕТКплюс" src="/pictures/static_articles/etkplus-card/etkplus-1.png">
                        <br>
                        <p>Если у Вас есть такая карта, то Вы уже являетесь пользователем программы <b>ЕТКплюс</b>.</p>
                        <p>Совсем скоро мы запустим проект, позволяющий Вам не только получать скидки и бонусы и партнеров ЕТК, но и возвращать часть денег себе не транспортную карту!</p>
                        <blockquote>
                          <small>14/08/2017</small>
                        </blockquote>
                    </div>
          </div>    
      </div>
  </div>
</div>

@endsection
