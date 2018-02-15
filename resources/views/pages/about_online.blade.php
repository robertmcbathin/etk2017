@extends('layouts.master')

@section('description')
@endsection
@section('keywords')
Онлайн-пополнение карты ЕТК, карта ЕТК онлайн
@endsection
@section('title')
Немного об онлайн-пополнении
@endsection
@section('content')
<div class="page-header header-filter simple-page-bg" data-parallax="active" style="background-image: url(&quot;/images/bgs/bg_temp2.jpg&quot;); transform: translate3d(0px, 0px, 0px);">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h3 class="title">Всё, что нужно знать об онлайн-пополнении</h3>
            </div>
        </div>
    </div>
</div>
<div class="main main-raised">
    <div class="section section-basic">
        <div class="container">
               
        <div class="row">
            <h5 class="text-center">Как пополнить карту онлайн (отложенный платеж)</h5>
            <p class="left-margined">На сегодняшний день доступно 2 способа пополнить карту онлайн. Через <a href="http://etk21.ru/profile">личный кабинет</a> и через сервис <a href="https://online.sberbank.ru" target="_blank">Сбербанк Онлайн</a>.</p>
            <p class="left-margined">Пополняя через личный кабинет, Вы можете осуществить операцию с помощью <b>любой банковской карты</b>. Но в таком случае комиссия составит 3%.</p>
            <p class="left-margined">Если же Вы выбираете сервис Сбербанк Онлайн, то <b>комиссия не взимается</b>. Прочтите <a href="/instructions/sbol">инструкцию по пополнению</a>.</p>
            <p class="left-margined"><b>Внимание! Функция автоплатежа недоступна!</b></p>
            <h5 class="text-center">Как происходит пополнение баланса на карте?</h5>
            <p class="left-margined">Пополнение происходит при контакте с терминалом оплаты в транспорте либо в пункте пополнения (на почте, в наших офисах).</p>
            <h5 class="text-center">Как долго ждать пополнения?</h5>
            <p class="left-margined">Информация о пополнении поступает на терминалы оплаты в период от 24 до 48 часов.</p>
            <h5 class="text-center">Что делать, если в течение 48 часов карта не пополнилась?</h5>
            <p class="left-margined">Можно подождать еще некоторое время или обратиться на кассу (в наших офисах или отделениях Почты России).</p>            
            <br><br>
            <p class="left-margined">Если у Вас остались вопросы, напишите нам в форме <a href="{{ route('ask') }}">обратной связи</a>.</p>
        </div>
        </div>
    </div>
</div>

@endsection
