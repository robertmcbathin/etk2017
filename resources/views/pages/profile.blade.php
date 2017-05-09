@extends('layouts.profile')
@section('description')
личный кабинет держателя карты ЕТК
@endsection
@section('keywords') 
@endsection
@section('title')
Личный кабинет
@endsection
@section('content')
<div class="page-header header-filter" data-parallax="active" style="background-image: url(&quot;/images/bgs/bg_index_tr.jpg&quot;); transform: translate3d(0px, 0px, 0px);">
</div>
<div class="main main-raised">
    <div class="profile-content">
        <div class="container">

            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                 <div class="profile">
                    <div class="avatar">
                        <img src="/pictures/cards/thumbnails/160/{{Auth::user()->card_image}}.png" alt="" class="img-responsive img-raised">
                    </div>
                    <div class="name">
                        <h3 class="title profile-card-title">{{ Auth::user()->card_number }}</h3>
                        <h6>{{ Auth::user()->name }}</h6>
                    </div>
                </div>
            </div>
        </div>
        @if (Session::has('name-changed-successfully'))
        <div class="row">
            <div class="container">
              <div class="alert alert-success">
                <div class="container">
                    <div class="alert-icon">
                        <i class="material-icons">check</i>
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="material-icons">clear</i></span>
                    </button>
                    <strong>{{Session::pull('name-changed-successfully')}}</strong>
                </div>
            </div>  
        </div>
    </div>
    @endif
    @if (Session::has('password-changed-successfully'))
        <div class="row">
            <div class="container">
              <div class="alert alert-success">
                <div class="container">
                    <div class="alert-icon">
                        <i class="material-icons">check</i>
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="material-icons">clear</i></span>
                    </button>
                    <strong>{{Session::pull('password-changed-successfully')}}</strong>
                </div>
            </div>  
        </div>
    </div>
    @endif
    @if (Session::has('name-changed-unsuccessfully'))
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
                <strong>{{Session::pull('name-changed-unsuccessfully')}}</strong>
            </div>
        </div>  
    </div>
</div>
@endif
@if (Session::has('password-changed-unsuccessfully'))
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
                <strong>{{Session::pull('password-changed-unsuccessfully')}}</strong>
            </div>
        </div>  
    </div>
</div>
@endif
@if (Session::has('wrong-repeat'))
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
                <strong>{{Session::pull('wrong-repeat')}}</strong>
            </div>
        </div>  
    </div>
</div>
@endif
@if (Session::has('wrong-password'))
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
                <strong>{{Session::pull('wrong-password')}}</strong>
            </div>
        </div>  
    </div>
</div>
@endif
<div class="row">
    <div class="col-md-7 col-md-offset-1">
        <h4 class="title">Информация по карте</h4>
        <div class="card card-nav-tabs card-plain">
            <div class="header header-info">
                <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                <div class="nav-tabs-navigation">
                    <div class="nav-tabs-wrapper">
                        <ul class="nav nav-tabs" data-tabs="tabs">
                            <li class="active"><a href="#deposit" data-toggle="tab">Пополнение (Сбербанк)</a></li>
                            <li><a href="#details" data-toggle="tab">Детализация поездок<div class="ripple-container"></div></a></li>
                            <li><a href="#settings" data-toggle="tab">Настройки</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-content">
                <div class="tab-content text-center">
                    <div class="tab-pane active" id="deposit">
                        <div class="table-responsive">
                            <h3 id="operations-results-none"></h3><table class="table table-striped">
                            <tbody>
                                @if (count($operations) > 0)
                                <thead>
                                    <tr>
                                        <th>Номер карты</th>
                                        <th>Транзакция</th>
                                        <th>Терминал</th>
                                        <th class="text-right">Сумма</th>
                                        <th class="text-right">Дата</th>
                                    </tr>
                                </thead>
                                @foreach ($operations as $operation)
                                <tr>
                                    <td>{{$operation->card_number}}</td>
                                    <td>{{$operation->transaction_number}}</td>
                                    <td>{{$operation->terminal_number}}</td>
                                    <td class="text-right">{{$operation->value}}</td>
                                    <td class="text-right">{{$operation->transaction_date}}</td>
                                </tr>
                                @endforeach
                                <small>Последнее обновление базы данных: <strong>{{ $last_import }}</strong></small>
                                @else
                                <h3>Здесь будет выводиться история транзакций пополнения карты через терминалы Сбербанка</h3>
                                <small>Последнее обновление базы данных: <strong>{{ $last_import }}</strong></small>
                                @endif
                            </tbody>

                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="details">
                    <p> I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus. I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at. I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at. </p>
                </div>
                <div class="tab-pane" id="settings">
                    <div class="row">
                        <div class="col-md-4">
                            <ul class="nav nav-pills nav-pills-info nav-stacked">
                              <li class="active"><a href="#tab1" data-toggle="tab">Личные данные</a></li>
                              <li><a href="#tab2" data-toggle="tab">Сменить пароль</a></li>
                              <li><a href="#tab3" data-toggle="tab">Удалить аккаунт</a></li>
                          </ul>
                      </div>
                      <div class="col-md-8">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab1">
                              <div class="col-lg-12 col-sm-12">
                                <div class="form-group is-empty">
                                    <form action="{{ route('profile.change_name.post') }}" method="POST">
                                        <input type="text" value="{{ Auth::user()->name }}" placeholder="Имя Фамилия" class="form-control" name="name">
                                        <span class="material-input"></span>
                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                        {{ csrf_field()}}
                                        <button type="submit" class="btn btn-primary">Сменить имя</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab2">
                           <div class="col-lg-12 col-sm-12">
                            
                              <form action="{{ route('profile.change_password.post') }}" method="POST">
                              <div class="form-group is-empty">
                                 <input type="password" placeholder="Старый пароль" class="form-control" name="old_password">
                                 </div>
                                 <span class="material-input"></span>
                                 <div class="form-group is-empty">
                                 <input type="password" placeholder="Новый пароль" class="form-control" name="new_password" maxlength="6">
                                 </div>
                                 <span class="material-input"></span>
                                 <div class="form-group is-empty">
                                 <input type="password" placeholder="Повторите пароль" class="form-control" name="password_repeat" minlength="6">
                                 </div>
                                 <span class="material-input"></span>
                                 <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                 {{ csrf_field()}}
                                 <button type="submit" class="btn btn-primary">Сменить пароль</button>
                             </form>
                     </div>
                 </div>
                 <div class="tab-pane" id="tab3">
                    Вы можете удалить аккаунт
                    <div class="col-lg-12 col-sm-12">
                        <form action="{{ route('profile.delete_account.post') }}" method="POST">
                          <div class="form-group is-empty">
                             <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                             {{ csrf_field()}}
                             <button type="submit" class="btn btn-primary">Удалить аккаунт</button>
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
</div>
<div class="col-md-2 col-md-offset-1 stats">
    <h4 class="title">Баланс</h4>
    <ul class="list-unstyled">
        <li><b>Пока недоступно</b> </li>
    </ul>
    <hr>
    <h4 class="title">История платежей</h4>
    <p class="description">Пока недоступно</p>
    <hr>
</div>
</div>

</div>
</div>
</div>
@endsection





