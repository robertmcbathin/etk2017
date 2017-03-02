@extends('layouts.master')

@section('description')
ООО "Единая транспортная карта" - оператор безналичной оплаты проезда в общественном транспорте города Чебоксары 
@endsection

@section('title')
О компании
@endsection
@section('content')
<div class="page-header header-filter simple-page-bg" data-parallax="active" style="background-image: url(&quot;/images/bgs/bg_about.jpg&quot;); transform: translate3d(0px, 0px, 0px);">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1 class="title">О компании</h1>
                <h4>Региональный оператор безналичной оплаты проезда в общественном транспорте</h4>
            </div>
        </div>
    </div>
</div>
<div class="main main-raised">
    <div class="section section-basic">
        <div class="container">


            <div class="row">
                <div class="features-1">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <h2 class="title">Что такое <strong>Единая транспортная карта</strong>?</h2>
                            <h5 class="description">ООО "Единая транспортная карта" популяризирует безналичную оплату проезда в Чувашской Республике с 2008 года. За это время было выпущено множество льготных проездных месячных билетов для пенсионеров, студентов и школьников.</h5>
                            <h3 class="title">Почему стоит перейти на безналичную оплату проезда?</h3>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="info">
                                <p>Больше не нужно каждый раз искать нужную сумму в куче мелочи в кармане</p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="info">
                                <div class="icon icon-success">
                                    <i class="material-icons">account_balance_wallet</i>
                                </div>
                                <h4 class="info-title">Это выгодно</h4>
                                <p>Экономьте до 4-х рублей с каждой поездки</p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="info">
                                <div class="icon icon-danger">
                                    <i class="material-icons">airport_shuttle</i>
                                </div>
                                <h4 class="info-title">Это безопасно</h4>
                                <p>Безналичная оплата проезда позволяет водителю меньше отвлекаться от процесса вождения</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="features-4">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <h2 class="title">Безопасность</h2>
                    <h5 class="description">В наших картах мы используем зарекомендовавший себя стандарт MIFARE</h5>
                </div>
            </div>

            <div class="row">

                <div class="col-md-3 col-md-offset-1">
                    <div class="info info-horizontal">
                        <div class="icon icon-info">
                            <i class="material-icons">drag_handle</i>
                        </div>
                        <div class="description">
                            <h4 class="info-title">Отсутствие контакта</h4>
                            <p>Карты стандарта MIFARE являются бесконтактными </p>
                        </div>
                    </div>

                    <div class="info info-horizontal">
                        <div class="icon icon-danger">
                            <i class="material-icons">lock</i>
                        </div>
                        <div class="description">
                            <h4 class="info-title">Защита данных</h4>
                            <p>Защита карт подразумевает использование сложных алгоритмов шифрования</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="phone-container">
                    <img src="/images/mifare.jpg" alt="">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="info info-horizontal">
                        <div class="icon icon-primary">
                            <i class="material-icons">memory</i>
                        </div>
                        <div class="description">
                            <h4 class="info-title">Внутренняя память</h4>
                            <p>Карты имеют внутреннюю память, позволяющую хранить данные о транзакциях</p>
                        </div>
                    </div>

                    <div class="info info-horizontal">
                        <div class="icon icon-success">
                            <i class="material-icons">nfc</i>
                        </div>
                        <div class="description">
                            <h4 class="info-title">NFC</h4>
                            <p>Стандарт MIFARE позволяет использовать технологию Near Field Communication</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
</div>

@endsection
