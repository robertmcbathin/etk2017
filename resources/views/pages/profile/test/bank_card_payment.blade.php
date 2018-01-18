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
            <b>Комиссия составит 3% от суммы</b>.
          </p>
          <br>
        </div>

      </div>
      <div class="row">
       <div class="col-md-8 col-md-offset-2">
        <div class="card card-plain card-blog">
          <div class="row">
            <div class="col-md-5">
              <div class="card-image">
                <img class="img img-raised" src="/images/uniteller.jpg">
                <div class="ripple-container"></div><div class="colored-shadow" style="background-image: url(&quot;assets/img/examples/card-blog4.jpg&quot;); opacity: 1;"></div></div>
              </div>
              <div class="col-md-7">
                <h6 class="category text-info">Пополнение банковской картой</h6>
                <h3 class="card-title">
                  <a href=""><small>транспортная карта №</small>{{session()->get('current_card_number','не определено')}}</a>
                </h3>
                <p class="card-description">
                  <small>информация по тарифу</small><br><b> {{$cardInfo->CardInformation->tariff->text}}</b><br>
                  <small>информация по карте</small><br><b> {{$cardInfo->CardInformation->info->text}}</b><br>
                  <small>минимальная сумма</small><br><b> {{$cardInfo->CardInformation->tariff->minSumInt}} р.</b><br>
                  <small>максимальная сумма</small><br><b> {{$cardInfo->CardInformation->tariff->maxSumInt}} р.</b><br>

                  @isset($cardInfo->CardInformation->tariff->unaccountedResidueInfo)
                  <p>{{$cardInfo->CardInformation->tariff->unaccountedResidueInfo}}</p>
                  @endisset

                  <hr>
                  @if ($cardInfo->CardInformation->info->otype == 5)
                  <form action="{{route('profile.test.pay')}}" method="POST">
                    <div class="form-group">
                      <input id="payment_value" type="text" value="" placeholder="Введите сумму платежа" minlength="1" name="payment_value" class="form-control">
                      <span class="material-input"></span>
                    </div>
                    <input type="hidden" name="payment_session_id" value="{{$cardInfo->CardInformation->sessionId}}">
                    <input type="hidden" name="payment_tariff_id" value="{{$cardInfo->CardInformation->tariff->id}}">
                    <input type="hidden" name="max_sum" value="{{$cardInfo->CardInformation->tariff->maxSumInt}}">
                    <input type="hidden" name="min_sum" value="{{$cardInfo->CardInformation->tariff->minSumInt}}">
                    <input type="hidden" name="card_number" value="{{session()->get('current_card_number')}}">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    {{ csrf_field() }}
                    <input id="submit_payment" type="submit" class="btn btn-info btn-fullwidth" value="Перейти к заказу">
                  </form>
                  @elseif ($cardInfo->CardInformation->info->otype == 4)
                  <p><i class="material-icons text-success">check</i> Все готово для пополнения</p>
                  <form action="{{route('profile.test.pay')}}" method="POST">
                    <div class="form-group">
                      <input id="payment_value" type="text" value="" placeholder="Введите сумму платежа" minlength="1" name="payment_value" class="form-control">
                      <span class="material-input"></span>
                    </div>
                    <input type="hidden" name="payment_session_id" value="{{$cardInfo->CardInformation->sessionId}}">
                    <input type="hidden" name="payment_tariff_id" value="{{$cardInfo->CardInformation->tariff->id}}">
                    <input type="hidden" name="max_sum" value="{{$cardInfo->CardInformation->tariff->maxSumInt}}">
                    <input type="hidden" name="min_sum" value="{{$cardInfo->CardInformation->tariff->minSumInt}}">
                    <input type="hidden" name="card_number" value="{{session()->get('current_card_number')}}">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    {{ csrf_field() }}
                    <input id="submit_payment" type="submit" class="btn btn-success btn-fullwidth" value="Перейти к заказу">
                  </form>
                  @endif
                </p>
                <div class="row">
                  <p id="bcp-to-card"></p>
                </div>
                <div class="row">
                  <p id="bcp-comission"></p>  
                </div>
                <div class="row">
                  <p id="bcp-total"></p>
                </div>
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





