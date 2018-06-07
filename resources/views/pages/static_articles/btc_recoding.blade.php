@extends('layouts.master')

@section('description')
Пополнение БТК через устройства самообслуживания Сбербанка
@endsection
@section('keywords')

@endsection
@section('title')
Пополнение БТК через устройства самообслуживания Сбербанка
@endsection
@section('content')
<div class="page-header simple-page-bg" data-parallax="active" style="background-image: url(&quot;/images/bgs/etkplus-bg2.jpg&quot;); transform: translate3d(0px, 0px, 0px); ">
    <div class="container">
        <div class="row">
        <div class="col-md-10 col-md-offset-1">
                <h1 class="title">Пополнение БТК через устройства самообслуживания Сбербанка</h1>
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
                      <li class="active">Пополнение БТК через устройства самообслуживания Сбербанка</li>
                  </ol>
              </div>
          </div>
          <div class="row">
            <div class="col-md-8 col-md-offset-2">
                        <h3 class="title">Особенности пополнения бансковской транспортной карты через устройство самообслуживания Сбербанка</h3>
                        <div class="row">
                          <div class="col-md-8">
                              <p>Как Вы знаете, устройства самообслуживания (УС) Сбербанка позволяют пополнять транспортные карты как бесконтактным, так и контактным способом.</p>
                              <p>Любым из этих способов можно пополнить <b>банковскую транспортную карту</b>, но отличия в них есть.</p>
                          </div>
                          <div class="col-md-4">
                            <img class="img-responsive" alt="mifare" src="/pictures/static_articles/btc_recoding/sberbank.png">
                          </div>
                        </div> 
                        <br>
                          <p>При пополнении классическим контактным способом (которым пользуется большинство держателей карт) не происходит <b>перекодировка карты</b>, т.е. пополнить осуществить отложенное пополнение для такой карты нельзя.</p>
                          <p>Если же однажды пополнить БТК бесконтактным способом, то она станет доступна для отложенного пополнения, но пополнить её контактным способом будет уже невозможно.</p>
                        <blockquote>
                          <small>07/06/2018</small>
                        </blockquote>
                    </div>
          </div>    
      </div>
  </div>
</div>

@endsection
