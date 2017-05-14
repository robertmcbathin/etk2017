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
@if (Session::has('min-date-error'))
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
      <strong>{{Session::pull('min-date-error')}}</strong>
  </div>
</div>  
</div>
</div>
@endif
@if (Session::has('max-date-error'))
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
      <strong>{{Session::pull('max-date-error')}}</strong>
  </div>
</div>  
</div>
</div>
@endif
@if (Session::has('request-sent-fail'))
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
      <strong>{{Session::pull('request-sent-fail')}}</strong>
  </div>
</div>  
</div>
</div>
@endif
@if (Session::has('request-sent-ok'))
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
      <strong>{{Session::pull('request-sent-ok')}}</strong>
  </div>
</div>  
</div>
</div>
@endif
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
  <div class="col-md-12">
    <div class="card card-nav-tabs card-plain">
      <div class="header header-info">
        <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
        <div class="nav-tabs-navigation">
          <div class="nav-tabs-wrapper">
            <ul class="nav nav-tabs" data-tabs="tabs">
              <li class="active"><a href="#deposit" data-toggle="tab">Пополнение</a></li>
              <li><a href="#details" data-toggle="tab">Детализация поездок<div class="ripple-container"></div></a></li>
              <li><a href="#settings" data-toggle="tab">Настройки</a></li>
              <li><a href="#balance" data-toggle="tab" disabled>Баланс</a></li>
          </ul>

      </div>
  </div>
</div>
<div class="card-content">
    <div class="tab-content text-center">
      <div class="tab-pane active" id="deposit">
        <div class="row">
          <div class="col-md-4">
            <ul class="nav nav-pills nav-pills-info nav-stacked">
              <li class="active"><a href="#tab6" data-toggle="tab">Пополнить счет</a></li>
              <li><a href="#tab7" data-toggle="tab">История пополнений</a></li>
          </ul>
      </div>
      <div class="col-md-8">
        <div class="tab-content">
          <div class="tab-pane active" id="tab6">
            Пока недоступно
        </div>
        <div class="tab-pane" id="tab7">
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
</div>
</div>
</div>
</div>
<div class="tab-pane" id="details">
  <div class="row">
    <div class="col-md-4">
      <ul class="nav nav-pills nav-pills-info nav-stacked">
        <li class="active"><a href="#tab4" data-toggle="tab">Создать запрос</a></li>
        <li><a href="#tab5" data-toggle="tab">История запросов</a></li>
    </ul>
</div>
<div class="col-md-8">
  <div class="tab-content">
    <div class="tab-pane active" id="tab4">
      <form action="{{ route('profile.request_details.post') }}" method="POST">
        <div class="col-md-12">
          <div class="title">
            <h3>Укажите период</h3>
            <small>Минимальная дата начала - не более 15 дней раньше текущей даты. Максимальная - не менее 1 дня до текущей даты.</small>
        </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label class="label-control">Начало периода</label>
        <input type="text" class="form-control datepicker" name="date_start" value="">
        <span class="material-input"></span></div>
    </div>
    <div class="col-md-6">
     <div class="form-group">
        <label class="label-control">Конец периода</label>
        <input type="text" class="form-control datepicker" name="date_end" value="">
        <span class="material-input"></span></div>
    </div>
    <div class="col-md-12">
        <div class="title">
          <h3>Укажите причину</h3>
      </div>
      <div class="form-group label-floating is-empty">
          <label class="control-label"> Введите текст здесь</label>
          <textarea class="form-control" rows="5" name="reason"></textarea>
          <span class="material-input"></span></div>
      </div>
      <input type="hidden" value="{{ Auth::user()->card_number }}" name="card_number">
      <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
      {{ csrf_field() }}
      <button type="submit" class="btn btn-info">Запросить детализацию</button>
  </form>
</div>
<div class="tab-pane" id="tab5">
  <div class="table-responsive">
    <table class="table table-striped">
      <tbody>
        @if (count($requests) > 0)
        <thead>
          <tr>
            <th>#</th>
            <th>Начало периода</th>
            <th>Окончание периода</th>
            <th>Причина</th>
            <th class="text-right">Статус</th>
        </tr>
    </thead>
    @foreach ($requests as $request)
    <tr>
      <td>{{$request->id}}</td>
      <td>{{$request->date_start}}</td>
      <td>{{$request->date_end}}</td>
      <td>{{$request->reason}}</td>
      @if ($request->status == 1)
      <td class="text-right"><span class="label label-warning">Новый</span></td>
      @endif
      @if ($request->status == 2)
      <td class="text-right"><span class="label label-info">Принят к обработке</span></td>
      @endif
      @if ($request->status == 3)
      <td class="text-right"><span class="label label-success">Готов</span></td>
      @endif
  </tr>
  @endforeach
  @else
  <h3>Запросов детализации не поступало</h3>
  @endif
</tbody>

</table>
</div>
</div>
</div>
</div>
</div>
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
            <button type="submit" class="btn btn-info">Сменить имя</button>
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
       <button type="submit" class="btn btn-info">Сменить пароль</button>
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
         <button type="submit" class="btn btn-info">Удалить аккаунт</button>
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
</div>

</div>
</div>
</div>
@endsection





