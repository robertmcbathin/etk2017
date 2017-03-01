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
                    <div class="col-md-4">
                        <div class="card card-blog">
                                    <div class="card-image">
                                        <a href="index.html#pablo">
                                            <img class="img" src="assets/img/examples/blog8.jpg">
                                        </a>
                                    <div class="ripple-container"></div></div>
                                    <div class="content">
                                        <h6 class="category text-danger">
                                            <i class="material-icons">trending_up</i> Trending
                                        </h6>
                                        <h4 class="card-title">
                                            <a href="index.html#pablo">To Grow Your Business Start Focusing on Your Employees</a>
                                        </h4>
                                        <div class="footer">
                                            <div class="author">
                                                <a href="index.html#pablo">
                                                   <img src="assets/img/faces/marc.jpg" alt="..." class="avatar img-raised">
                                                   <span>Mike John</span>
                                                </a>
                                            </div>
                                           <div class="stats">
                                                <i class="material-icons">schedule</i> 5 min read
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4"></div>
                </div>


                <div class="row">
                    <div class="features-1">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h2 class="title">Что такое <strong>Электронный кошелек</strong>?</h2>
                    <h5 class="description"><strong>Электронный кошелек</strong> - карта для безналичной оплаты проезда</h5>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="info">
                        <div class="icon icon-info">
                            <i class="material-icons">chat</i>
                        </div>
                        <h4 class="info-title">Free Chat</h4>
                        <p>Divide details about your product or agency work into parts. Write a few lines about each one. A paragraph describing a feature will be enough.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="info">
                        <div class="icon icon-success">
                            <i class="material-icons">verified_user</i>
                        </div>
                        <h4 class="info-title">Verified Users</h4>
                        <p>Divide details about your product or agency work into parts. Write a few lines about each one. A paragraph describing a feature will be enough.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="info">
                        <div class="icon icon-danger">
                            <i class="material-icons">fingerprint</i>
                        </div>
                        <h4 class="info-title">Fingerprint</h4>
                        <p>Divide details about your product or agency work into parts. Write a few lines about each one. A paragraph describing a feature will be enough.</p>
                    </div>
                </div>
            </div>

        </div>
                </div>
            </div>
        </div>
</div>

@endsection
