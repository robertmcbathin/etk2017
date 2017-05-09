@extends('layouts.login')
@section('description')

@endsection
@section('keywords')
регистрация карты етк
@endsection
@section('title')
Регистрация карты
@endsection
@section('content')
<div class="page-header header-filter login-page-header" data-parallax="active" style="background-image: url(&quot;/images/bgs/bg_index_tr.jpg&quot;); transform: translate3d(0px, 0px, 0px);">


    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                <div class="card card-signup mobile-padding">
                    <h2 class="card-title text-center">Регистрация карты</h2>
                    <div class="row">
                        @if (Session::has('account-deleted'))
                        <div class="alert alert-info">
                            <div class="container register-alert">
                                <div class="alert-icon">
                                    <i class="material-icons">check</i>
                                </div>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="material-icons">clear</i></span>
                                </button>
                                <strong>{{Session::pull('account-deleted')}}</strong>
                            </div>
                        </div>
                        @endif
                        @if (Session::has('account-not-deleted'))
                        <div class="alert alert-warning">
                            <div class="container register-alert">
                                <div class="alert-icon">
                                    <i class="material-icons">warning</i>
                                </div>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="material-icons">clear</i></span>
                                </button>
                                <strong>{{Session::pull('account-not-deleted')}}</strong>
                            </div>
                        </div>
                        @endif
                        @if (Session::has('card-number-verify-fail'))
                        <div class="alert alert-warning">
                            <div class="container register-alert">
                                <div class="alert-icon">
                                    <i class="material-icons">warning</i>
                                </div>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="material-icons">clear</i></span>
                                </button>
                                <strong>{{Session::pull('card-number-verify-fail')}}</strong>
                            </div>
                        </div>
                        @endif
                        @if (Session::has('email-verify-fail'))
                        <div class="alert alert-warning">
                            <div class="container register-alert">
                                <div class="alert-icon">
                                    <i class="material-icons">warning</i>
                                </div>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="material-icons">clear</i></span>
                                </button>
                                <strong>{{Session::pull('email-verify-fail')}}</strong>
                            </div>
                        </div>
                        @endif
                        @if (Session::has('acception-fail'))
                        <div class="alert alert-warning">
                            <div class="container register-alert">
                                <div class="alert-icon">
                                    <i class="material-icons">warning</i>
                                </div>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="material-icons">clear</i></span>
                                </button>
                                <strong>{{Session::pull('acception-fail')}}</strong>
                            </div>
                        </div>
                        @endif
                        @if (Session::has('register-fail'))
                        <div class="alert alert-warning">
                            <div class="container register-alert">
                                <div class="alert-icon">
                                    <i class="material-icons">warning</i>
                                </div>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="material-icons">clear</i></span>
                                </button>
                                <strong>{{Session::pull('register-fail')}}</strong>
                            </div>
                        </div>
                        @endif
                        @if (Session::has('register-ok'))
                        <div class="alert alert-success">
                            <div class="container register-alert">
                                <div class="alert-icon">
                                    <i class="material-icons">check</i>
                                </div>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="material-icons">clear</i></span>
                                </button>
                                <strong>{{Session::pull('register-ok')}}</strong>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-md-offset-1">
                            <div class="info info-horizontal">
                                <div class="icon icon-rose">
                                    <i class="material-icons">group</i>
                                </div>
                                <div class="description">
                                    <h4 class="info-title">Личный кабинет</h4>
                                    <p class="description">
                                        Личный кабинет держателя карты позволит Вам пользоваться услугами безналичной оплаты проезда еще удобнее
                                    </p>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-7">
                            <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                                {{ csrf_field() }}
                                <div class="card-content">
                                    <div class="form-group">
                                      <label for="choose_card" class="col-md-4 control-label">
                                        Выберите Вашу карту
                                      </label>
                                      <div class="col-md-6">
                                          <span class="material-input card-thumbnail" id="e-wallet-card-thumbnail"><img class="reg-thumbnail" src="/images/cards_thumbnails/023_80.png"></span>
                                          <span class="material-input card-thumbnail" id="e-wallet-sbercard-thumbnail"><img class="reg-thumbnail" src="/images/cards_thumbnails/sber023_80.png"></span>
                                          <span class="material-input card-thumbnail" id="e-wallet-oldcard-thumbnail"><img class="reg-thumbnail" src="/images/cards_thumbnails/old023_80.png"></span>
                                          <span class="material-input card-thumbnail" id="chtu-thumbnail"><img class="reg-thumbnail" src="/images/cards_thumbnails/chtu021_80.png"></span>
                                          <span class="material-input card-thumbnail" id="nmuptt-thumbnail"><img class="reg-thumbnail" src="/images/cards_thumbnails/nmuptt026_80.png"></span>
                                          <span class="material-input card-thumbnail" id="travel-card-thumbnail"><img class="reg-thumbnail" src="/images/cards_thumbnails/travel-card025_80.png"></span>
                                          <span class="material-input card-thumbnail" id="school-card-thumbnail"><img class="reg-thumbnail" src="/images/cards_thumbnails/schoolcard033_80.png"></span>
                                          <span class="material-input card-thumbnail" id="student-card-thumbnail"><img class="reg-thumbnail" src="/images/cards_thumbnails/student-card034_80.png"></span>
                                      </div>
                                    </div>  
                                    <div class="form-group">
                                        <input type="hidden" value="0" name="card_type" id="card_type">
                                    </div>
                                    <div class="form-group{{ $errors->has('card_number') ? ' has-error' : '' }}">
                                        <label for="card_number" class="col-md-4 control-label">
                                        <span class = "material-input" id="reg-card-thumbnail">Номер карты</span>
                                        </label>
                                        <div class="col-md-6">
                                            <input id="card_number" type="text" class="form-control" name="card_number" value="{{ old('card_number') }}" required autofocus placeholder="000000000" minlength="9" maxlength="9">
                                            <p class="text-muted">9 цифр. Для карт нового образца: номер карты без серии. Для остальных: серия и номер, начиная с 0. Например: 023000001</p>
                                            <span class="help-block" id="card-error-span">
                                            </span>
                                            @if ($errors->has('card_number'))
                                            <span class="help-block" id="card-error-span">
                                                <strong>{{ $errors->first('card_number') }}</strong>
                                            </span>
                                            @endif
                                            
                                        </div>
                                    </div>


                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="password" class="col-md-4 control-label">E-mail</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control" name="email" required placeholder='example@mail.com' value="{{ old('email') }}">
                                            <p class="text-muted">На адрес электронной почты будет отправлено письмо с инструкцией по активации личного кабинета</p>
                                            <span class="help-block" id="email-error-span">
                                            </span>
                                            @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label for="password" class="col-md-4 control-label">Пароль</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control" name="password" required minlength="6" maxlength="40">
                                            <p class="text-muted">Не менее 6 символов</p>
                                            @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('password_repeat') ? ' has-error' : '' }}">
                                        <label for="password_repeat" class="col-md-4 control-label">Повторите пароль</label>

                                        <div class="col-md-6">
                                            <input id="password_repeat" type="password" class="form-control" name="password_repeat" required minlength="6" maxlength="40">
                                            <span class="help-block" id="password-repeat-error-span">
                                            </span>
                                            @if ($errors->has('password_repeat'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password_repeat') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <div class="checkbox">
                                                <label>
                                                  <input type="checkbox" name="acception" checked value="1">
                                                  Я ознакомлен(а) с <a href="#something">политикой конфиденциальности</a> и даю свое <a href="">согласие на обработку персональных данных</a>.
                                              </label>
                                          </div>
                                      </div>
                                  </div>


                                  <div class="form-group">
                                    <div class="col-md-8 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Зарегистрировать карту
                                        </button>
                                    </div>
                                </div>

                            </div>

                        </form>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
@include('includes.login-footer')
</div>
<script>
  var token = '{{ Session::token() }}';
  var urlCardNumberVerify = '{{ route('ajax.check_card_on_exist') }}';
  var urlEmailVerify = '{{ route('ajax.check_email_on_exist') }}';
</script>
@endsection





