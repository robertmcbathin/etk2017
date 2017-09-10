@extends('layouts.master')

@section('description')
Электронный кошелек ЕТК
@endsection
@section('keywords')
электронный кошелек для проезда в общественном транспорте, етк карта, етк, 
@endsection
@section('title')
Электронный кошелек
@endsection
@section('content')
<div class="page-header  simple-page-bg" data-parallax="active" style="background-image: url(&quot;/images/bgs/bg_ewallet.jpg&quot;); transform: translate3d(0px, 0px, 0px);  ">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1 class="title">Электронный кошелек</h1>
            </div>
        </div>
    </div>
</div>
<div class="main main-raised">
    <div class="section section-basic">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <h2 class="title">Оплачивайте проезд со скидкой!</h2>
                    <h5 class="description">Карта "Электронный кошелек" предоставляет скидку на проезд в общественном транспорте города Чебоксары, а также на межмуниципальных маршрутах (город Новочебоксарск)</h5>
                    <div class="section-space"></div>
                </div>
            </div> 
            <div class="row">
                <div class="container">
                    @foreach ($cards as $card)
                    <div class="col-6 col-md-4">
                        <div class="card card-blog">
                            <div class="card-image">
                                <a href="{{route('card',['id' => $card->id])}}">
                                <img class="img" src="{{$card->image}}">
                                </a>
                                <div class="ripple-container"></div></div>
                                <div class="content">
                                    <h6 class="category text-info">На предъявителя</h6>
                                    <h4 class="card-title">
                                        <a href="{{route('card',['id' => $card->id])}}">{{ $card->name }}</a>
                                    </h4>
                                    <small>{{$card->description}}</small>
                                    <div class="footer">
                                            <div>
                                                <small>Стоимость</small> <strong>{{$card->price}}</strong>
                                            </div>
                                           <div>
                                                <small>Тариф</small> <strong>{{$card->tariff}}</strong>
                                            </div>
                                            <div>
                                                <small>Срок службы</small> <strong>{{$card->lifetime}}</strong>
                                            </div>
                                        </div>
                            </div>

                        </div>
                    </div>
                    @endforeach
        </div>
            </div>     
        </div>
    </div>
</div>

@endsection
