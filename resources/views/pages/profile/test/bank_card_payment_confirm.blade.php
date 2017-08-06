@extends('layouts.profile')
@section('description')
личный кабинет держателя карты ЕТК
@endsection
@section('keywords') 
@endsection
@section('title')
Проверка реквизитов
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

        <div class="col-md-8 col-md-offset-2">
          <h4 class="title">Проверка реквизитов пополнения</h4>
          <p class="description">
            <b>Внимание:</b> Пополнение производится не моментально, а по типу "отложенное пополнение". Т.е., может достигать <b>до 2-х рабочих дней</b>.
          </p>
        </div>

      </div>
      <div class="row">

        <div class="col-md-6 col-md-offset-3">
          <div class="card card-pricing">
            <div class="card-content">
              <h6 class="category text-info">Пополнение банковской картой</h6>
              <p class="description">Проверьте данные платежа</p>
              <h2 class="card-title"><small>карта №</small>{{session()->get('current_card_number','не определено')}}</h1>
                <ul>
                  <li><small>E-mail: </small>{{ $email }}</li>
                  <li><small>На карту будет зачислено: </small> {{$payment_to_card}} р.</li>
                  <li><small>К оплате (с комиссией 3%): </small> {{$payment_to_acquirer}} р.</li>
                </ul>
                <div class="col-md-10 col-md-offset-1">
                      <input id="submit_payment" type="submit" class="btn btn-primary btn-round" value="Перейти к оплате">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row"></div>

        </div>
      </div>
    </div>
    @endsection





