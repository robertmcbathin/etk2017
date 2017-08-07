@extends('layouts.profile')
@section('description')
личный кабинет держателя карты ЕТК
@endsection
@section('keywords') 
@endsection
@section('title')
Тестовое пополнение баланса
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
        <b>Внимание:</b> Пополнение производится не моментально, а по типу "отложенное пополнение". Т.е., может достигать <b>до 2-х рабочих дней</b>.
      </p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="col-md-6">
            <div class="card">
                    <div class="card-content content-info">
                      <h5 class="category-social">
                        Банковская карта
                      </h5>
                      <h4 class="card-title">
                        <a href="#pablo">"Focus on Your Employees"</a>
                      </h4>
                      <p class="card-description">
                        Вы можете пополнить транспортную карту при помощи <b>любой банковской карты</b> с комиссией <b>3%</b>.
                      </p>
                      <div class="footer text-center">
                                        <a href="{{ route('profile.test.bank_card_payment') }}" class="btn btn-white btn-round">Пополнить</a>
                                    </div>
                    </div>
                  </div>
          </div>
          <div class="col-md-6">
            <div class="card">
                    <div class="card-content content-success">
                      <h5 class="category-social">
                         Сбербанк Онлайн
                      </h5>
                      <h4 class="card-title">
                        <a href="#pablo">"Focus on Your Employees"</a>
                      </h4>
                      <p class="card-description">
                        Если Вы подключены к системе Сбербанк Онлайн, Вы можете пополнить карту на странице услуги по ссылке. Комиссия за пополнение составит <b>1%</b>. 
                      </p>
                      <div class="footer text-center">
                                        <a href="#pablo" class="btn btn-white btn-round">Пополнить</a>
                                    </div>
                    </div>
                  </div>
          </div>
        </div>
      </div>
        @if (Session::has('current_card_number'))
       <p class="description">Онлайн-пополнение пока недоступно</p>
      @else
        <p class="text-danger description">Не выбрана карта для пополнения</p>
      @endif
      <div class="row"></div>

    </div>
  </div>
</div>
@endsection





