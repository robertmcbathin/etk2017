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
<div class="page-header  simple-page-bg" data-parallax="active" style="background-image: url(&quot;/images/bgs/bg2018_4.jpg&quot;); transform: translate3d(0px, 0px, 0px);  ">
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
                    <div class="card card-plain card-blog">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card-image">
                                    <img class="img img-raised" src="{{$card->image}}">
                                    <div class="colored-shadow" style="background-image: url(&quot;assets/img/examples/card-blog4.jpg&quot;); opacity: 1;"></div></div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="category text-info">На предъявителя</h6>
                                    <h3 class="card-title">
                                        <a href="{{route('card',['id' => $card->id])}}">{{ $card->name }}</a>
                                    </h3>
                                    <p class="card-description">
                                        {{$card->description}}
                                    </p>
                                    <div class="footer">
                                        <small>Стоимость</small> <strong>{{$card->price}}</strong><br>
                                        <small>Тариф</small> <strong>{{$card->tariff}}</strong><br>
                                        <small>Срок службы</small> <strong>{{$card->lifetime}}</strong>
                                    </div></div>
                                </div>
                            </div>
                            @endforeach
        </div>
            </div>     
        </div>
    </div>
</div>

@endsection
