@extends('layouts.login')
@section('title')
Восстановление пароля
@endsection
@section('content')
<div class="page-header header-filter login-page-header" data-parallax="active" style="background-image: url(&quot;/images/bgs/bg_index_tr.jpg&quot;); transform: translate3d(0px, 0px, 0px);">
    <div class="container">
        <div class="row">


            <div class="col-md-8 col-md-offset-2">

                <div class="card card-signup">
                    <h2 class="card-title text-center">Восстановить пароль</h2>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                            @if (Session::has('saving-fail'))
                             <div class="alert alert-danger">
                                {{ Session::pull('saving-fail') }}
                            </div>
                            @endif
                            @if (Session::has('reset-link-sent'))
                             <div class="alert alert-success">
                                {{ Session::pull('reset-link-sent') }}
                            </div>
                            @endif
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <form class="form-horizontal" role="form" method="POST" action="{{ route('password.send-new-password') }}">
                                    {{ csrf_field() }}
                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email" class="col-md-4 control-label">E-Mail </label>

                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                            @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">
                                                Отправить новый пароль
                                            </button>
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
</div>
@endsection
