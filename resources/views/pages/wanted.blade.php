@extends('layouts.master')

@section('description')
@endsection
@section('keywords')
вакансия android-разработчика
@endsection
@section('title')
Открыта вакансия
@endsection
@section('content')
<div class="page-header header-filter simple-page-bg" data-parallax="active" style="background-image: url(&quot;/images/bgs/bg_temp2.jpg&quot;); transform: translate3d(0px, 0px, 0px);">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1 class="title">Вакансия!</h1>
            </div>
        </div>
    </div>
</div>
<div class="main main-raised">
    <div class="section section-basic">
        <div class="container">
               
        <div class="row">
            <h5 class="text-center">ООО "Единая транспортная карта" ищет Android-разработчика на сдельной основе для создания двух мобильных приложений, основанных на считывании бесконтактных смарт-карт с помощью встроенного NFC-чипа.</h5>
            <h5>Требования</h5>
            <ul>
                <li>Владение платформой Android Studio</li>
                <li>Наличие опубликованных проектов в Google Play Market</li>
                <li>Заинтересованность в развитии проекта (будет отлично, если Вы - активный пользователь транспортной карты)</li>
                <li>Местонахождение в г. Чебоксары</li>
            </ul>
            <h5>С нас</h5>
            <ul>
                <li>Гибкий график (можете работать где и когда хотите, но всю работу согласовывать с нами)</li>
                <li>Достойная оплата</li>
                <li>Возможность продления трудовых отношений</li>
            </ul>
            <p>Все подробности при встрече! Чтобы оставить заявку, напишите нам в форме <a href="{{ route('ask') }}">обратной связи</a>.</p>
        </div>
        </div>
    </div>
</div>

@endsection
