@extends('layouts.master')

@section('description')
О запуске отложенного пополнения
@endsection
@section('keywords')

@endsection
@section('title')
О запуске отложенного пополнения
@endsection
@section('content')
<div class="page-header simple-page-bg" data-parallax="active" style="background-image: url(&quot;/images/bgs/itvog.jpg&quot;); transform: translate3d(0px, 0px, 0px); ">
    <div class="container">
        <div class="row">
        <div class="col-md-10 col-md-offset-1">
                <h1 class="title">О запуске отложенного пополнения</h1>
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
                      <li class="active">О запуске отложенного пополнения</li>
                  </ol>
              </div>
          </div>
          <div class="row">
            <div class="col-md-8 col-md-offset-2">
                        <p>14 февраля 2018 года был запущен сервис отложенного пополнения через Сбербанк Онлайн</p>
                        
                        <h3 class="title">Итоги запуска</h3>
                        <p>В течение 48 часов после запуска было пополнено или продлено 85% карт. При пополнении оставшихся сложились трудности. А именно:</p>
                        <ul>
                          <li>52% карт не было пополнено ввиду задержек в обновлении транспортных терминалов;</li>
                          <li>34% карт не осуществили ни одной поездки после отложенного пополнения;</li>
                          <li>10% карт не было пополнено из-за устаревшего формата карты, не позволяющего применить отложенное пополнение;</li>
                          <li>4% это банковские транспортные карты (БТК), недоступные для пополнения.</li>
                        </ul>
                        <h3 class="title">Пути решения</h3>
                        <ul>
                          <li>Сейчас мы активно работаем над более частым и систематическим обновлением транспортных терминалов. Планируется устранить данную проблему к 24 февраля 2018 года;</li>
                          <li>Если Вы пополнили карту, но не совершали поездок, сервис Сбербанк Онлайн и личный кабинет будут отражать старый остаток. Вам необходимо осуществить поездку;</li>
                          <li>Сервис Сбербанк Онлайн не позволяет проверить формат карты, поэтому если Вы давно пополняли карту (до 2018 года), то пополнения не произойдет;</li>
                          <li>Банковские транспортные карты по умолчанию устаревшего формата. Их пополнение невозможно.</li>
                        </ul>
                        <h3 class="title">Что делать, если Ваша карта не пополнилась</h3>
                        <p>Если Вы много ездили после отложенного пополнения, но баланс карты не изменился, не расстраивайтесь - Ваш платеж никуда не пропал. Задержки обусловлены техническими проблемами, которые мы вскоре решим. Но если Вам срочно необходимо провести зачисление - обратитесь к нашим операторам в отделениях Сбербанка.</p>
                        <p>Надеемся на понимание</p>
                        <blockquote>
                          <small>19/02/2018</small>
                        </blockquote>
                    </div>
          </div>    
      </div>
  </div>
</div>

@endsection
