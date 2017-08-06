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
          <h4 class="title">Пополнение баланса карты</h4>
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
              <p class="description">Проверьте данные и введите сумму в рублях</p>
              <h2 class="card-title"><small>карта №</small>{{session()->get('current_card_number','не определено')}}</h1>
                <ul>
                  <li><small>информация по карте</small> {{$cardInfo->CardInformation->tariff->text}}</li>
                  <li><small>минимальная сумма</small> {{$cardInfo->CardInformation->tariff->minSumInt}} р.</li>
                  <li><small>максимальная сумма</small> {{$cardInfo->CardInformation->tariff->maxSumInt}} р.</li>

                  @if ($cardInfo->CardInformation->tariff->unaccountedResidueInfo)
                  <li>{{$cardInfo->CardInformation->tariff->unaccountedResidueInfo}}</li>
                  @endif
                  

                  @if ($cardInfo->CardInformation->info->otype == 5)
                  <li><i class="material-icons text-danger">close</i> Пополнение невозможно</li>
                  @elseif ($cardInfo->CardInformation->info->otype == 4)
                  <li><i class="material-icons text-succes">check</i> Все готово для пополнения</li>
                  @endif
                </ul>
                <div class="col-md-10 col-md-offset-1">
                <form action="{{route('profile.test.pay')}}" method="POST">
                      <div class="form-group">
                        <input id="payment_value" type="text" value="" placeholder="Введите сумму платежа" minlength="1" name="payment_value" class="form-control">
                      <span class="material-input"></span>
                      </div>
                      <input type="hidden" name="payment_session_id" value="{{$cardInfo->CardInformation->sessionId}}">
                      <input type="hidden" name="payment_tariff_id" value="{{$cardInfo->CardInformation->tariff->id}}">
                      <input type="hidden" name="max_sum" value="{{$cardInfo->CardInformation->tariff->maxSumInt}}">
                      <input type="hidden" name="min_sum" value="{{$cardInfo->CardInformation->tariff->minSumInt}}">
                      <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                      {{ csrf_field() }}
                      <input id="submit_payment" type="submit" class="btn btn-primary btn-round" value="Перейти к оплате">
                </form>
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





