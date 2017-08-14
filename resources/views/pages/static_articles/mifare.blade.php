@extends('layouts.master')

@section('description')
Стандарт Mifare Classic
@endsection
@section('keywords')

@endsection
@section('title')
Стандарт Mifare Classic
@endsection
@section('content')
<div class="page-header simple-page-bg" data-parallax="active" style="background-image: url(&quot;/images/bgs/etkplus-bg2.jpg&quot;); transform: translate3d(0px, 0px, 0px); ">
    <div class="container">
        <div class="row">
        <div class="col-md-10 col-md-offset-1">
                <h1 class="title">Стандарт Mifare Classic</h1>
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
                      <li class="active">Стандарт Mifare Classic</li>
                  </ol>
              </div>
          </div>
          <div class="row">
            <div class="col-md-8 col-md-offset-2">
                        <h3 class="title">Почему электронные транспортные карты это не просто пластик</h3>
                        <div class="row">
                          <div class="col-md-8">
                                                    <p>Абсолютное большинство карт, используемых для организации безналичной оплаты проезда, составляет семейство бесконтактных смарт-карт <b>Mifare</b>.</p>
                                                                          <p>ООО "Единая транспортная карта" использует карты стандарта Classic.</p>
                          </div>
                          <div class="col-md-4">
                            <img class="img-responsive" alt="mifare" src="/pictures/static_articles/mifare/mifare.png">
                          </div>
                        </div> 
                        <br>
                        <i>В чем основные преимущества бесконтактных смарт-карт?</i>
                          <p><b>Они относительно недорогие и простые</b>. По сравнению с банковскими картами, стоимость выпуска карты в разы ниже, а замена карты осуществляется моментально.</p>
                          <p><b>Чтение данных с карты при помощи телефона с чипом NFC</b>. Смартфоны, имеющие чип, "умеющий эмулировать карты Mifare", могут пополнять такие касанием. С осуществлением поездок, все же, могут возникать проблемы ввиду необходимости реализации чипа по типу Secure Element, но такая проблема решаема при помощи NFC-сим-карт.</p>
                        <blockquote>
                          <small>14/08/2017</small>
                        </blockquote>
                    </div>
          </div>    
      </div>
  </div>
</div>

@endsection
