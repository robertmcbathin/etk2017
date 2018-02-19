@extends('layouts.master')

@section('description')
Отложенное пополнение
@endsection
@section('keywords')

@endsection
@section('title')
Отложенное пополнение
@endsection
@section('content')
<div class="page-header simple-page-bg" data-parallax="active" style="background-image: url(&quot;/images/bgs/itvog.jpg&quot;); transform: translate3d(0px, 0px, 0px); ">
    <div class="container">
        <div class="row">
        <div class="col-md-10 col-md-offset-1">
                <h1 class="title">Отложенное пополнение</h1>
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
                      <li class="active">Отложенное пополнение</li>
                  </ol>
              </div>
          </div>
          <div class="row">
            <div class="col-md-8 col-md-offset-2">
                        <h3 class="title">Что такое отложенное пополнение?</h3>
                        <p>Отложенное пополнение это возможность пополнить баланс электронной транспортной карты или продлить проездной через Интернет, не посещая кассу.</p>
                        
                        <h3 class="title">В чем преимущества такого способа пополнения?</h3>
                        <p>Во-первых, Вам не нужно стоять в очереди около устройства самоосблуживания.</p>
                        <p>Во-вторых, риск технического сбоя в данном случае минимален.</p>
                        <p>В-третьих, таким способом Вы можете пополнить карту, которую не имеете на руках, например, карту своих детей или родителей.</p>
                        <h3 class="title">Каковы особенности отложенного пополнения?</h3>
                        <p>Пополнение карты происходит не моментально, а в течение суток (в некоторых случаях до 48 часов).</p>
                        <p>Банковские транспортные карты (БТК) недоступны для пополнения таким образом.</p>
                        <p>На данный момент доступно пополнение с любой банковской карты с комиссией 3%.</p>
                        <p>Пополнение происходит следующим образом:</p>
                        <ul>
                          <li>Выбираете карту в личном кабинете</li>
                          <li>Переходите в меню <a href="{{ route('profile.test_payment_page.get') }}">Пополнение->Пополнить</a></li>
                          <li>Выбираете способ пополнения</li>
                          <li>Вводите сумму пополнения</li>
                          <li>Подтверждаете введенную сумму и переходите на страницу оплаты</li>
                          <li>Вводите реквизиты банковской карты</li>
                          <li>Подтверждаете платеж</li>
                        </ul>
                        <p>Далее создается транзакция отложенного пополнения, которая загружается на все терминалы для оплаты проезда.</p>
                        <p>Таким образом, пополнение произойдет при следующей поездке в общественном транспорте.</p>
                        
                        <blockquote>
                          <small>17/01/2018</small>
                        </blockquote>
                    </div>
          </div>    
      </div>
  </div>
</div>

@endsection
