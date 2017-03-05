@extends('layouts.master')

@section('description')
Вопросы и ответы
@endsection
@section('keywords')

@endsection
@section('title')
Вопросы и ответы
@endsection
@section('content')
<div class="page-header header-filter simple-page-bg" data-parallax="active" style="background-image: url(&quot;/images/bgs/bg_ask.jpg&quot;); transform: translate3d(0px, 0px, 0px);">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1 class="title">Вопросы и ответы</h1>
                <h4>Часто задаваемые вопросы и ответы на них</h4>
            </div>
        </div>
    </div>
</div>
<div class="main main-raised">
    <div class="section section-basic">
        <div class="container">
                @foreach ($questions as $question)
                    <div class="row">
                        <h5 class="title">{{$question->content}}</h5>
                        <blockquote>{{$question->answer}}</blockquote>
                    </div>
                @endforeach
                <hr>
                <div class="row">
                    <h4 class="title">Не нашли ответа на свой вопрос? <a href="{{route('ask')}}" style="color:#9c27b0;">Напишите нам!</a> А мы постараемся на него ответить</h4>
                </div>
        </div>
    </div>
</div>

@endsection
