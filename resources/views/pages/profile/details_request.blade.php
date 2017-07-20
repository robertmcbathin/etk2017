@extends('layouts.profile')
@section('description')
@endsection
@section('keywords') 
@endsection
@section('title')
Создать запрос на детализацию
@endsection
@section('content')
<div class="page-header header-filter" data-parallax="active" style="background-image: url(&quot;/images/bgs/bg_index_tr.jpg&quot;); transform: translate3d(0px, 0px, 0px);">
</div>
<div class="main main-raised">
  <div class="profile-content">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <h4 class="title">Создать запрос на детализацию</h4>
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
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <p class="description">
            <b>Внимание:</b> Минимальная дата начала - не более 15 дней раньше текущей даты. Максимальная - не менее 1 дня до текущей даты.
          </p>
          <form action="{{ route('profile.request_details.post') }}" method="POST">
            <div class="col-md-12">
              <div class="title">
                <h4>Укажите период</h4>
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
                  <h4>Укажите причину</h4>
                </div>
                <div class="form-group label-floating is-empty">
                  <label class="control-label"> Введите текст здесь</label>
                  <textarea class="form-control" rows="5" name="reason"></textarea>
                  <span class="material-input"></span></div>
                </div>
                <input type="hidden" value="{{ Session::get('current_card_number') }}" name="card_number">
                <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                {{ csrf_field() }}
                <button type="submit" class="btn btn-profile">Запросить детализацию</button>
              </form>
            </div>
          </div>

        </div>
      </div>
    </div>
    @endsection





