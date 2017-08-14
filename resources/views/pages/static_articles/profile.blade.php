@extends('layouts.master')

@section('description')
Запуск личного кабинета ЕТК
@endsection
@section('keywords')

@endsection
@section('title')
Запуск личного кабинета ЕТК
@endsection
@section('content')
<div class="page-header simple-page-bg" data-parallax="active" style="background-image: url(&quot;/images/bgs/bg_temp3.jpg&quot;); transform: translate3d(0px, 0px, 0px); ">
    <div class="container">
        <div class="row">
        <div class="col-md-10 col-md-offset-1">
                <h1 class="title">Личный кабинет</h1>
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
                      <li class="active">Запуск личного кабинета ЕТК</li>
                  </ol>
              </div>
          </div>
          <div class="row">
            <div class="col-md-8 col-md-offset-2">
                        <h3 class="title">Присоединяйтесь к бета-тестированию личного кабинета ЕТК</h3>
                        <p>Уважаемые держатели карт ЕТК! Предлагаем Вам принять участие в бета-тестировании личного кабинета. Почему beta? </p>
                        <p>Это не типовое решение, поэтому ошибки всегда возможны. Просим принять это к сведению и сообщить нам, если заметите неполадки.</p>
                        <br>
                        <img class="img-rounded img-responsive img-raised" alt="" src="/pictures/static_articles/profile/profile.jpg">
                        <br>
                        <p>Сейчас Вы можете добавить карту, узнать баланс, дату последней транзакции, состояние карты.</p>
                        <p>После подтверждения карты (необходимо ввести 8 цифр чипа карты) Вы сможете увидеть отчет по поездкам за месяц, заказать детализацию по поездкам, а также просмотреть историю пополнения в терминалах Сбербанка и поставить карту в очередь на блокировку.</p>
                        <p>Онлайн-пополнение пока недоступно.</p>
                        <p>Приятного использования!</p>
                        <blockquote>
                          <small>31/07/2017</small>
                        </blockquote>
                    </div>
          </div>    
      </div>
  </div>
</div>

@endsection
