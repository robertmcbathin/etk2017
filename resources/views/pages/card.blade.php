@extends('layouts.master')

@section('description')
{{$card->description}} 
@endsection
@section('keywords')
{{ $card->name }}
@endsection
@section('title')
{{ $card->name }}
@endsection
@section('content')
<div class="page-header card-page-bg" data-parallax="active" style="background-image: url(&quot;/images/bgs/bg_card.jpg&quot;); transform: translate3d(0px, 0px, 0px); -webkit-filter: blur(15px); filter: blur(15px); -moz-filter: blur(15px); -o-filter: blur(15px); ">

</div>
<div class="main main-raised">
    <div class="section section-basic">
        <div class="container">
                <div class="row">
        <div class="col-md-8 ">
                    <ol class="breadcrumb">
          <li><a href="{{route('cards')}}">Карты</a></li>
          <li class="active">{{ $card->name }}</li>
        </ol>
        </div>
        </div>
            <div class="row">
                            <div class="col-md-4">
                                <div class="card-image">
                                        <img class="img img-raised" src="{{$card->image}}">
                                <div class="ripple-container"></div></div>
                            </div>
                            <div class="col-md-8">
                                <h3 class="card-title">
                                    {{$card->name}}
                                </h3>
                                <p class="card-description">
                                    {{$card->description}}
                                </p>
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
        </div>
    </div>


@endsection
