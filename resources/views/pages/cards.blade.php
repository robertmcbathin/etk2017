@extends('layouts.master')

@section('description')
Карты ЕТК
@endsection
@section('keywords')

@endsection
@section('title')
Карты ЕТК
@endsection
@section('content')
<div class="page-header card-page-bg" data-parallax="active" style="background-image: url(&quot;/images/bgs/bg_card.jpg&quot;); transform: translate3d(0px, 0px, 0px); -webkit-filter: blur(15px); filter: blur(15px); -moz-filter: blur(15px); -o-filter: blur(15px); ">

</div>
<div class="main main-raised">
    <div class="section section-basic">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <h2 class="title">Электронные карты</h2>
                    <h5 class="description">Представляем Вам ассортимент выпускаемых нами карт. Вы можете выбрать среди таких типов карт как "Электронный кошелек", "Проездной" или "Банковская транспортная карта"</h5>
                    <div class="section-space"></div>
                </div>
            </div> 
            <div class="row">
                <div class="container">
                    @foreach ($cards as $card)
                    <div class="col-md-4">
                        <div class="card card-blog">
                            <div class="card-image">
                                <a href="{{route('card',['id' => $card->id])}}">
                                    <img class="img" src="{{$card->image}}">
                                </a>
                                <div class="ripple-container"></div></div>
                                <div class="content">
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
