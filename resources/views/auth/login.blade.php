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
                            <div class="row">
                                @if (Session::has('confirmation-failed'))
                                <div class="alert alert-warning">
                                    <div class="container register-alert">
                                        <div class="alert-icon">
                                            <i class="material-icons">warning</i>
                                        </div>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true"><i class="material-icons">clear</i></span>
                                        </button>
                                        <strong>{{Session::pull('confirmation-failed')}}</strong>
                                    </div>
                                </div>
                                @endif
                                @if (Session::has('confirmation-success'))
                                <div class="alert alert-success">
                                    <div class="container register-alert">
                                        <div class="alert-icon">
                                            <i class="material-icons">success</i>
                                        </div>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true"><i class="material-icons">clear</i></span>
                                        </button>
                                        <strong>{{Session::pull('confirmation-success')}}</strong>
                                    </div>
                                </div>
                                @endif
                                @if (Session::has('activation-failed'))
                                <div class="alert alert-warning">
                                    <div class="container register-alert">
                                        <div class="alert-icon">
                                            <i class="material-icons">warning</i>
                                        </div>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true"><i class="material-icons">clear</i></span>
                                        </button>
                                        <strong>{{Session::pull('activation-failed')}}</strong>
                                    </div>
                                </div>
                                @endif
                                @if (Session::has('activation-success'))
                                <div class="alert alert-success">
                                    <div class="container register-alert">
                                        <div class="alert-icon">
                                            <i class="material-icons">success</i>
                                        </div>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true"><i class="material-icons">clear</i></span>
                                        </button>
                                        <strong>{{Session::pull('activation-success')}}</strong>
                                    </div>
                                </div>
                                @endif
                                @if (Session::has('account-is-not-activated'))
                                <div class="alert alert-warning">
                                    <div class="container register-alert">
                                        <div class="alert-icon">
                                            <i class="material-icons">warning</i>
                                        </div>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true"><i class="material-icons">clear</i></span>
                                        </button>
                                        <strong>{{Session::pull('account-is-not-activated')}}</strong>
                                    </div>
                                </div>
                                @endif
                                @if (Session::has('account-is-not-exist'))
                                <div class="alert alert-warning">
                                    <div class="container register-alert">
                                        <div class="alert-icon">
                                            <i class="material-icons">warning</i>
                                        </div>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true"><i class="material-icons">clear</i></span>
                                        </button>
                                        <strong>{{Session::pull('account-is-not-exist')}}</strong>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                                        {{ csrf_field() }}

                                        <div class="form-group{{ $errors->has('card_number') ? ' has-error' : '' }}">
                                            <label for="email" class="col-md-4 control-label">E-mail</label>

                                            <div class="col-md-6">
                                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="example@mail.com">

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
                                                    Я забыл(а) пароль
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





