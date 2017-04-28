@extends('layouts.login')
@section('description')

@endsection
@section('keywords')
личный кабинет етк
@endsection
@section('title')
Вход в личный кабинет
@endsection
@section('content')
<div class="page-header header-filter login-page-header" data-parallax="active" style="background-image: url(&quot;/images/bgs/bg_index_tr.jpg&quot;); transform: translate3d(0px, 0px, 0px);">


    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <div class="card card-signup">
                    <h2 class="card-title text-center">Вход в личный кабинет</h2>
                    <div class="row">
                    <div class="col-md-12">

                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                                        {{ csrf_field() }}

                                        <div class="form-group{{ $errors->has('card_number') ? ' has-error' : '' }}">
                                            <label for="email" class="col-md-4 control-label">Номер карты</label>

                                            <div class="col-md-6">
                                                <input id="card_number" type="text" class="form-control" name="card_number" value="{{ old('card_number') }}" required autofocus placeholder="000000000">

                                                @if ($errors->has('card_number'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('card_number') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                            <label for="password" class="col-md-4 control-label">Пароль</label>

                                            <div class="col-md-6">
                                                <input id="password" type="password" class="form-control" name="password" required>

                                                @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-4">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Запомнить меня
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-8 col-md-offset-4">
                                                <button type="submit" class="btn btn-primary">
                                                    Войти
                                                </button>

                                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                                    Забыли пароль?
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @include('includes.login-footer')
</div>
@endsection




