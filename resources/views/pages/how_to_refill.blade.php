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
<div class="page-header  simple-page-bg" data-parallax="active" style="background-image: url(&quot;/images/bgs/bg2018_6.jpg&quot;); transform: translate3d(0px, 0px, 0px);  ">
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
                                    <img class="img" src="/images/sbol.jpg">
                                </a>
                                <div class="ripple-container"></div></div>
                                <div class="content">
                                    <h4 class="card-title">
                                        <a href="/instructions/sbol">Пополнение через сервис Сбербанк Онлайн</a>
                                    </h4>
                                    <small>Пополнение через сервис Сбербанк Онлайн</small>
                                    <div class="footer">
                                        <div>
                                           <a class="btn btn-simple" href="/instructions/sbol">Подробнее</a>
                                       </div>
                                   </div>
                               </div>

                           </div>

                                                   <div class="card card-blog">
                            <div class="card-image">
                                <a href="">
                                    <img class="img" src="/images/uniteller.jpg">
                                </a>
                                <div class="ripple-container"></div></div>
                                <div class="content">
                                    <h4 class="card-title">
                                        <a href="{{ route('profile') }}">В личном кабинете</a>
                                    </h4>
                                    <small>Пополнение при помощи банковской карты на сайте в личном кабинете (с комиссией) </small>
                                    <div class="footer">
                                        <div>
                                           <button class="btn btn-simple" data-toggle="modal" data-target="#aboutModal">Подробнее</button>
                                       </div>
                                   </div>
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
            <div class="modal fade" id="aboutModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                <i class="material-icons">clear</i>
                            </button>
                            <h4 class="modal-title">Как пополнить карту онлайн</h4>
                        </div>
                        <div class="modal-body">
                            <ul><div class="row">
                                <div class="col-md-4">
                                    <ul class="nav nav-pills nav-pills-rose nav-stacked">
                                      <li class="active"><a href="#tab1" data-toggle="tab" aria-expanded="true">Регистрация</a></li>
                                      <li class=""><a href="#tab2" data-toggle="tab" aria-expanded="false">Добавление карты</a></li>
                                      <li><a href="#tab3" data-toggle="tab">Оплата</a></li>
                                  </ul>
                              </div>
                              <div class="col-md-8">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab1">
                                      Для пополнения онлайн Вам будет необходимо <a href="{{ route('register') }}">зарегистрироваться в личном кабинете</a>.
                                      
                                  </div>
                                  <div class="tab-pane" id="tab2">
                                      После регистрации и подтверждения адреса электронной почты перейдите в личный кабинет и добавьте Вашу карту в меню настроек.
                                  </div>
                                  <div class="tab-pane" id="tab3">
                                  <p>1. Перейдите в меню <b>ПОПОЛНЕНИЕ</b> -> <b>ПОПОЛНИТЬ СЧЕТ</b> -> <b>Пополнение с любой банковской карты</b></p>
                                  <p>2. Введите сумму платежа, нажмите <b>Перейти к оплате</b></p>
                                  <p>3. Нажмите <b>Подтвердить заказ</b></p>
                                  <p>4. Вы попадете на страницу оплаты, где необходимо будет ввести <b>номер банковской карты, срок действия карты, Ваше имя, CVV/CVC2 код</b> и нажмите ОПЛАТИТЬ</p>
                                  <p>После подтверждения оплаты сформируется отложенное пополнение, которое запишется на карту </p>
                                </div>
                            </div>
                        </div>
                    </div></ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
    @endsection