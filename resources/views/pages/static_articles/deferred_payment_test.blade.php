@extends('layouts.master')

@section('description')
Окончание тестирования сервиса отложенного пополнения
@endsection
@section('keywords')

@endsection
@section('title')
Окончание тестирования сервиса отложенного пополнения
@endsection
@section('content')
<div class="page-header simple-page-bg" data-parallax="active" style="background-image: url(&quot;/images/bgs/bg2018_3.jpg&quot;); transform: translate3d(0px, 0px, 0px); ">
  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <h1 class="title">Окончание тестирования сервиса отложенного пополнения</h1>
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
            <li class="active">Возобновление отложенного пополнения</li>
          </ol>
        </div>
      </div>
      <div class="row">
        <div class="col-md-8 col-md-offset-2">

          <h3 class="title">Каковы были причины сбоев</h3>
            <blockquote>
              <p>
                При тестовом запуске пополнение работало некорректно по <b>двум</b> основным причинам:
                1.) Некорректное обновление программного обеспечения на терминалах оплаты;
                2.) Недостаточное количество перекодированных карт, доступных для отложенного пополнения.
                На данный момент, влияние обеих причин сведено к минимуму, успешно пополняется отложенным способом порядка 98.5% карт. 
              </p>
            </blockquote>
            <h3 class="title">Необходимо знать</h3>
            <p>Не забывайте, что для того чтобы отложенное пополнение "пришло" на Вашу карту, необходимо порядка 48 часов - это обусловлено периодичностью обновления терминалов оплаты. В личном кабинете суммы пополнения <b>не</b> видно до тех пор пока Вы не осуществите по карте поездку.</p>
            <p>Просим обо всех возможных случаях непополнения сообщать нам по телефону 36-33-30 или на почту transkarta@bk.ru.</p>
            <blockquote>
              <small>10/05/2018</small>
            </blockquote>
          </div>
        </div>    
      </div>
    </div>
  </div>

  @endsection
