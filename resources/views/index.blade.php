@extends('layouts.master')

@section('description')
ООО "Единая транспортная карта" - оператор безналичной оплаты проезда в общественном транспорте города Чебоксары 
@endsection

@section('title')
Единая транспортная карта
@endsection
@section('content')
<div class="page-header " id="landing-gradient" data-parallax="active">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="card card-profile card-plain">
                    <div class="col-md-5 hidden-xs">
                        <div >
                            <a href="sections.html#pablo">
                                <img src="/images/e-wallet-mirror-2.png">
                            </a>
                            <div class="ripple-container"></div></div>
                        </div>
                        <div class="col-md-5 visible-xs" id="card-xs-img">
                            <div >
                                <a href="sections.html#pablo">
                                    <img src="/images/e-wallet-mirror-2.png">
                                </a>
                                <div class="ripple-container"></div></div>
                            </div>
                            <div class="col-md-7">
                                <div class="content">
                                    <h4 class="card-title" id="landing-title">Электронный кошелек</h4>

                                    <p class="card-description" id="landing-content">
                                     Оплачивайте проезд в общественном транспорте со скидкой!
                                 </p>

                                 <div class="footer text-right">
                                    <a href="sections.html#pablo" class="btn btn-primary landing-link">Подробнее...</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main main-raised">
        <div class="section section-basic">
            <div class="container">
                <div class="title">
                    <h2>Последние новости</h2>
                </div>

                <div class="space-50"></div>
                <div class="row">
                    @foreach ($articles as $article)
                    <div class="col-md-4">
                        <div class="card card-blog">
                            <div class="card-image">
                                <a href="">
                                <img class="img" src="{{$article->image}}">
                                </a>
                                <div class="ripple-container"></div></div>
                                <div class="content">
                                    <h4 class="card-title">
                                        <a href="index.html#pablo">{{ $article->title }}</a>
                                    </h4>
                                    <small>{{$article->description}}</small>
                                    <div class="footer">
                                     <div class="stats">
                                        <i class="material-icons">schedule</i>{{ $article->created_at }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="projects-4" id="projects-4">

        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <h2 class="title">Типы карт</h2>
                    <h5 class="description">Вы можете выбрать карту, подходящую именно Вам</h5>
                    <div class="section-space"></div>
                </div>
            </div>

            <div class="row">

                <div class="col-md-5 col-md-offset-1">
                    <div class="card card-background" style="background-image: url('/images/e-wallet.jpg')">
                        <a href="#pablo">

                        </a>
                        <div class="content">
                            <label class="label label-rose">На предъявителя</label>
                            <a href="#pablo">
                                <h3 class="card-title">Электронный кошелек</h3>
                            </a>
                            <p class="card-description">
                                Оплачивайте проезд в общественном транпорте со скидкой!
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="info info-horizontal">
                        <div class="icon icon-info">
                            
                        </div>
                        <div class="description">
                            <h4 class="info-title">Стоимость</h4>
                            <p class="description">
                               70 рублей
                            </p>
                        </div>
                    </div>

                    <div class="info info-horizontal">
                        <div class="icon icon-primary">
                        </div>
                        <div class="description">
                            <h4 class="info-title">Срок службы</h4>
                            <p class="description">
                                до 5 лет
                            </p>
                        </div>
                    </div>

                    <div class="info info-horizontal">
                        <div class="icon icon-danger">
                        </div>
                        <div class="description">
                            <h4 class="info-title">Тариф</h4>
                            <p class="description">
                                Остаток средств переходит на следующий месяц
                            </p>
                        </div>
                    </div>
                </div>

            </div>

            <hr>

            <div class="row">

                <div class="col-md-5 col-md-offset-1">
                    <div class="info info-horizontal">
                        <div class="icon icon-rose">
                        </div>
                        <div class="description">
                            <h4 class="info-title">Стоимость</h4>
                            <p class="description">
                                100 рублей
                            </p>
                        </div>
                    </div>

                    <div class="info info-horizontal">
                        <div class="icon icon-success">
                        </div>
                        <div class="description">
                            <h4 class="info-title">Срок службы</h4>
                            <p class="description">
                                до 5 лет
                            </p>
                        </div>
                    </div>

                    <div class="info info-horizontal">
                        <div class="icon icon-info">
                        </div>
                        <div class="description">
                            <h4 class="info-title">Тариф</h4>
                            <p class="description">
                                от 500 до 1050 рублей
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="card card-background" style="background-image: url('/images/tickets.jpg')">
                        <a href="#pablo">
                        </a>
                        <div class="content">
                            <label class="label label-rose">Именные</label>
                            <a href="#pablo">
                                <h2 class="card-title">Проездные</h2>
                            </a>
                            <p class="card-description">
                                Месячные проездные билеты на троллейбус и автобус для граждан, студентов и школьников
                            </p>
                        </div>
                    </div>
                </div>

            </div>
            <hr>
            <div class="row">

                <div class="col-md-5 col-md-offset-1">
                    <div class="card card-background" style="background-image: url('/images/sber.jpg')">
                        <a href="#pablo">

                        </a>
                        <div class="content">
                            <label class="label label-rose">Именная</label>
                            <a href="#pablo">
                                <h3 class="card-title">Банковская транспортная карта</h3>
                            </a>
                            <p class="card-description">
                                2 в 1. Банковская карта с транспортным приложением
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="info info-horizontal">
                        <div class="icon icon-info">
                            
                        </div>
                        <div class="description">
                            <h4 class="info-title">Стоимость</h4>
                            <p class="description">
                               Уточняйте в филиалах Сбербанка
                            </p>
                        </div>
                    </div>

                    <div class="info info-horizontal">
                        <div class="icon icon-primary">
                        </div>
                        <div class="description">
                            <h4 class="info-title">Срок службы</h4>
                            <p class="description">
                                указывается на карте
                            </p>
                        </div>
                    </div>

                    <div class="info info-horizontal">
                        <div class="icon icon-danger">
                        </div>
                        <div class="description">
                            <h4 class="info-title">Тариф</h4>
                            <p class="description">
                                Остаток средств переходит на следующий месяц
                            </p>
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
