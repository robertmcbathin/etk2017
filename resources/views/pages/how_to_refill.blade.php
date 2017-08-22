@extends('layouts.master')

@section('description')
Как пополнить карту ЕТК, как пополнить электронный кошелек
@endsection
@section('keywords')
как пополнить карту етк чебоксары,
@endsection
@section('title')
Как пополнить карту ЕТК
@endsection
@section('content')
<div class="page-header  simple-page-bg" data-parallax="active" style="background-image: url(&quot;/images/bgs/bg_ewallet.jpg&quot;); transform: translate3d(0px, 0px, 0px);  ">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1 class="title">Как пополнить карту ЕТК</h1>
            </div>
        </div>
    </div>
</div>
<div class="main main-raised">
    <div class="section section-basic">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <h2 class="title">Как пополнить транспортную карту</h2>
                    <h5 class="description">Вы можете оформить <a href="{{route('cards.sbercard')}}" class="common-link">банковские карты с транспортным приложением</a>, а также приобрести <a href="{{route('cards.ewallet')}}" class="common-link">транспортные карты ЕТК</a> в филиалах ПАО «Сбербанк». Пополнение возможно через устройства самообслуживания, обозначенные оранжевым стикером. В случае необходимости консультанты Сбербанка помогут пополнить транспортное приложение. Ближайшую для себя точку пополнения Вы можете найти в разделе <a href="{{ route('deposit-points') }}" class="common-link">ГДЕ ПОПОЛНИТЬ КАРТУ</a>.</h5>
                    <div class="section-space"></div>
                </div>
            </div> 
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <h2 class="title">Способы пополнения</h2>
                </div>
            </div> 
            <div class="row">
                <div class="container">
                    <div class="col-md-4">
                        <div class="card card-blog">
                            <div class="card-image">
                                <a href="">
                                    <img class="img" src="/images/uniteller.jpg">
                                </a>
                                <div class="ripple-container"></div></div>
                                <div class="content">
                                    <h4 class="card-title">
                                        <a href=>Онлайн-пополнение</a>
                                    </h4>
                                    <small>Пополнение при помощи банковской карты на сайте в личном кабинете станет доступно в ближайшее время</small>
                                </div>

                            </div>
                        </div>
                    <div class="col-md-4">
                        <div class="card card-blog">
                            <div class="card-image">
                                <a href="">
                                    <img class="img" src="/images/sber.jpg">
                                </a>
                                <div class="ripple-container"></div></div>
                                <div class="content">
                                    <h4 class="card-title">
                                        <a href=>Терминал Сбербанка</a>
                                    </h4>
                                    <small>Пополнение возможно через устройства самообслуживания, обозначенные оранжевым стикером</small>
                                    <div class="footer">
                                        <div>
                                            <a href="{{route('how-to-refill-sberbank')}}">Подробнее</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-blog">
                                <div class="card-image">
                                    <a href="">
                                        <img class="img" src="/images/etk-office.jpg">
                                    </a>
                                    <div class="ripple-container"></div></div>
                                    <div class="content">
                                        <h4 class="card-title">
                                            <a href=>В офисах ЕТК</a>
                                        </h4>
                                        <small>Осуществляется при помощи оператора</small>
                                        <div class="footer">
                                            <div>
                                                <a href="{{route('contacts')}}">Адрес и режим работы офисов</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card-blog">
                                    <div class="card-image">
                                        <a href="">
                                            <img class="img" src="/images/post-office.jpg">
                                        </a>
                                        <div class="ripple-container"></div></div>
                                        <div class="content">
                                            <h4 class="card-title">
                                                <a href=>В отделениях Почты России</a>
                                            </h4>
                                            <small>Осуществляется при помощи оператора. Список отделений ограничен</small>
                                            <div class="footer">
                                                <div>
                                                    <a href="{{route('deposit-points')}}">Смотреть на карте</a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>   
                    </div>
                </div>
            </div>

            @endsection
