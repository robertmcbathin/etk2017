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



                <div class="card card-signup">
                    <h2 class="card-title text-center">Регистрация карты</h2>
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
                                    <div class="form-group{{ $errors->has('card_number') ? ' has-error' : '' }}">
                                        <label for="email" class="col-md-4 control-label">Номер карты</label>

                                        <div class="col-md-6">
                                            <input id="card_number" type="text" class="form-control" name="card_number" value="{{ old('card_number') }}" required autofocus placeholder="000000000" minlength="9" maxlength="9">

                                            @if ($errors->has('card_number'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('card_number') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="password" class="col-md-4 control-label">E-mail</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control" name="email" required placeholder='example@mail.com'>
                                            <p class="text-muted">На адрес электронной почты будет отправлено письмо с инструкцией по активации карты</p>
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
                                                      <input type="checkbox" name="acception" checked="checked">
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
@endsection





