@extends('layouts.master')

@section('description')
Проездные ЕТК
@endsection
@section('keywords')

@endsection
@section('title')
Проездные
@endsection
@section('content')
<div class="page-header  simple-page-bg" data-parallax="active" style="background-image: url(&quot;/images/bgs/bg_travelcard.jpg&quot;); transform: translate3d(0px, 0px, 0px);  ">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1 class="title">Проездные</h1>
            </div>
        </div>
    </div>
</div>
<div class="main main-raised">
    <div class="section section-basic">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <h2 class="title">Проезд без ограничений!</h2>
                    <h5 class="description">Ассортимент карт типа "Месячный проездной билет" включает в себя проездные как для обычных граждан, так и для учащихся</h5>
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
                                    <h6 class="category text-info">Именные</h6>
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
