@extends('layouts.master')

@section('description')
Отложенное пополнение ЕТК карты через Сбербанк Онлайн
@endsection
@section('keywords')
Отложенное пополнение ЕТК карты через Сбербанк Онлайн
@endsection
@section('title')
Отложенное пополнение карты через Сбербанк Онлайн
@endsection
@section('content')
<div class="page-header header-filter simple-page-bg" data-parallax="active" style="background-image: url(&quot;/images/bgs/bg2018_1.jpg&quot;); transform: translate3d(0px, 0px, 0px);">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h3 class="title">Инструкция по отложенному пополнению через Сбербанк Онлайн</h3>
            </div>
        </div>
    </div>
</div>
<div class="main main-raised">
    <div class="section section-basic">
        <div class="container">

            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <p>Для отложенного пополнения карты ЕТК или продления проездного через сервис Сбербанк Онлайн войдите в личный кабинет пользователя Сбербанк Онлайн.</p>
                </div>

                <div class="row">
                    <div class="col-md-4 col-md-offset-2">
                        <br>
                        <p>Перейдите в пункт <b>Платежи</b>. Выберите категорию <b>Транспорт</b>, а потом выбрать услугу <b>Пополнение транспортной карты</b>.</p>
                    </div>
                    <div class="col-md-4">
                        <img class="img-rounded img-responsive img-raised" alt="" src="/images/sbol_imgs/1.jpg">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-md-offset-2">
                        <img class="img-rounded img-responsive img-raised" alt="" src="/images/sbol_imgs/2.jpg">
                    </div>
                    <div class="col-md-4">
                        <br>
                        <p>Далее введите номер карты в формате 1XXNNNNNN, где XX - серия карты, NNNNNN - последние 6 цифр номера карты.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-md-offset-2">
                        <br>
                        <p>Выберите вариант пополнения или продления в списке <b>Купить</b>.</p>
                    </div>
                    <div class="col-md-4">
                        <img class="img-rounded img-responsive img-raised" alt="" src="/images/sbol_imgs/3.jpg">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-md-offset-2">
                        <img class="img-rounded img-responsive img-raised" alt="" src="/images/sbol_imgs/4.jpg">
                    </div>
                    <div class="col-md-4">
                        <br>
                        <p>Подтвердите платеж SMS-паролем.</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-md-offset-2">
                    <br>
                    <p>Сохраните чек о пополнении.</p>
                    </div>
                    <div class="col-md-4">
                        <img class="img-rounded img-responsive img-raised" alt="" src="/images/sbol_imgs/5.jpg">
                    </div>
                </div>
<hr>
<div class="row">
    <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h1 class="title">Пополнение через мобильное приложение</h1>
                        <h4>Вы можете совершить удаленное пополнение также при помощи мобильного приложения Сбербанк Онлайн. Подробнее в видеоинструкции</h4>
                    </div>
                    <div class="col-md-5 col-md-offset-1">
                        <div class="iframe-container">
                           <iframe width="560" height="315" src="https://www.youtube.com/embed/RCQ23js6uN4" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
</div>

                <div class="row">
                    <br><br>
                    <p class="left-margined">Если у Вас остались вопросы, напишите нам в форме <a href="{{ route('ask') }}">обратной связи</a>.</p>
                </div>
            </div>
        </div>
    </div>

    @endsection
