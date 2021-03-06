@extends('layouts.master')

@section('description')

@endsection
@section('keywords')

@endsection
@section('title')
Условия
@endsection
@section('content')
<div class="page-header header-filter simple-page-bg" data-parallax="active" style="background-image: url(&quot;/images/bgs/bg_temp2.jpg&quot;); transform: translate3d(0px, 0px, 0px);">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1 class="title">Условия предоставления услуги онлайн-пополнения</h1>
            </div>
        </div>
    </div>
</div>
<div class="main main-raised">
    <div class="section section-basic">
        <div class="container">

            <div class="row">
                <h4>Условия использования сервиса</h4>
                <p>Сервис пополнения бесконтактной электронной транспортной карты (пополнения баланса электронного кошелька или продление проездного) предоставляется пользователям, зарегистрировавшимся в <a href="{{ route('register') }}">личном кабинете держателя карты</a>. Право использования сервиса для получения информации о карте имеет только держатель карты. Неправомерное использование сервиса преследуется в соответствии с законодательством Российской Федерации.</p>
                <h4>Условия оплаты и получения услуги</h4>
                <p>Оплата заказа производится через платежный сервис компании <b>Uniteller</b> при оформлении заказа. Оплата принимается только в российских рублях.</p>
                <p>Конечным результатом предоставления услуги является перезапись электронным транспортным терминалом транспортного ресурса* на электронной транспортной карте пользователя в соответствии с созданной после оплаты транзакцией отложенного пополнения**. Максимальный срок предоставления услуги - 48 часов с момента проведения оплаты.</p> 
                <h4>Возврат денежных средств</h4>
                <p>Возврат денежных средств возможен только в случае технической невозможности перезаписи транспортного ресурса на электронной транспортной карте пользователя. </p>
            </div>
        </div>
    </div>
</div>

@endsection
