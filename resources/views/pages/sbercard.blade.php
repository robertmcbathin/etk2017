@extends('layouts.master')

@section('description')
Банковская транспортная карта ЕТК и Сбербанка 
@endsection
@section('keywords')

@endsection
@section('title')
Банковская транспортная карта
@endsection
@section('content')
<div class="page-header  simple-page-bg" data-parallax="active" style="background-image: url(&quot;/images/bgs/bg_sbercard.jpg&quot;); transform: translate3d(0px, 0px, 0px);  ">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1 class="title">Банковская транспортная карта</h1>
            </div>
        </div>
    </div>
</div>
<div class="main main-raised">
    <div class="section section-basic">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <h2 class="title">2 в 1</h2>
                    <h5 class="description"><strong>Банковская транспортная карта</strong> - совместный продукт ПАО "Сбербанк России" и ООО "Единая транспортная карта". Карта позволяет держателю переводить деньги с основного счета на счет транпортного приложения прямо в банкомате. Карта может быть использована в зарплатных проектах, а также приобретена отдельно в филиалах Сбербанка</h5>
                    <div class="section-space"></div>
                </div>
            </div> 
            <div class="row">
                <div class="container">
                    @foreach ($cards as $card)
                    <div class="col-md-4 col-md-offset-4">
                        <div class="card card-blog">
                            <div class="card-image">
                                <a href="{{route('card',['id' => $card->id])}}">
                                    <img class="img" src="{{$card->image}}">
                                </a>
                                <div class="ripple-container"></div></div>
                                <div class="content">
                                <h6 class="category text-info">Именная</h6>
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
