@extends('layouts.profile')
@section('description')
онлайн-пополнение карты ЕТК
@endsection
@section('keywords') 
@endsection
@section('title')
Отложенное пополнение баланса
@endsection
@section('content')
<div class="page-header header-filter" data-parallax="active" style="background-image: url(&quot;/images/bgs/bg_index_tr.jpg&quot;); transform: translate3d(0px, 0px, 0px);">
</div>
<div class="main main-raised">
  <div class="profile-content">
    <div class="container">
      <div class="row">
        @if (Session::has('warning'))
        <div class="row">
          <div class="container">
            <div class="alert alert-warning">
              <div class="container">
                <div class="alert-icon">
                  <i class="material-icons">error_outline</i>
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true"><i class="material-icons">clear</i></span>
                </button>
                <strong>{{Session::pull('warning')}}</strong>
              </div>
            </div>  
          </div>
        </div>
        @endif
        @if (Session::has('info'))
        <div class="row">
          <div class="container">
            <div class="alert alert-info">
              <div class="container">
                <div class="alert-icon">
                  <i class="material-icons">error_outline</i>
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true"><i class="material-icons">clear</i></span>
                </button>
                <strong>{{Session::pull('info')}}</strong>
              </div>
            </div>  
          </div>
        </div>
        @endif
        @if (Session::has('error'))
        <div class="row">
          <div class="container">
            <div class="alert alert-danger">
              <div class="container">
                <div class="alert-icon">
                  <i class="material-icons">error_outline</i>
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true"><i class="material-icons">clear</i></span>
                </button>
                <strong>{{Session::pull('error')}}</strong>
              </div>
            </div>  
          </div>
        </div>
        @endif
        <div class="col-md-8 col-md-offset-2">
          <h4 class="title">Пополнение баланса карты</h4>
          <p class="description">
            <b>Внимание:</b> Пополнение производится не моментально, а по типу "отложенное пополнение". Т.е., может достигать <b>до 2-х рабочих дней</b>. <br>
            Читать подробнее об  <a href="/static_articles/deferred_payment" target="_blank">отложенном пополнении</a>.
          </p>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="container">


          <div class="col-md-8 col-md-offset-2">


              <div class="card card-plain card-blog">
                <div class="row">
                  <div class="col-xs-4 col-md-4">
                    <div class="card-image card-non-margin-image">
                      <img class="img img-raised" src="/images/uniteller.jpg">
                      <div class="colored-shadow" style="background-image: url(&quot;assets/img/examples/card-blog4.jpg&quot;); opacity: 1;"></div><div class="ripple-container"></div></div>
                    </div>
                    <div class="col-xs-8 col-md-8">
                      <h6 class="category text-info">Банковская карта</h6>
                      <h4 class="card-title">
                        <p>Пополнение с <b>любой</b> банковской карты (комиссия 3%)</p>
                        <a href="{{ route('profile.bank_card_payment') }}" class="btn btn-primary btn-link away-link">Перейти к пополнению <div class="ripple-container"></div></a>
                      </h4>

                    </div>
                  </div>
                </div>



              </div>
         <!-- <div class="col-md-4">
            <div class="card card-plain card-blog">
              <div class="card-image">
                <a href="{{ route('profile.test.bank_card_payment') }}">
                  <img class="img img-raised" src="/images/sbol.jpg">
                </a>
                <div class="colored-shadow" style="background-image: url(&quot;../assets/img/bg5.jpg&quot;); opacity: 1;"></div><div class="ripple-container"></div></div>

                <div class="card-content">
                  <h6 class="category text-success">Сбербанк Онлайн</h6>
                  <h4 class="card-title">
                    <a href="{{ route('profile.test.bank_card_payment') }}">Если Вы подключены к системе Сбербанк Онлайн, Вы можете пополнить карту на странице услуги по ссылке. Комиссия в таком случае не взимается</a>
                  </h4>
                  <p class="card-description">
                    
                  </p>
                </div>
              </div>
            </div> --> 
          </div>
        </div>
        <div class="row"></div>

      </div>
    </div>
  </div>
  @endsection





