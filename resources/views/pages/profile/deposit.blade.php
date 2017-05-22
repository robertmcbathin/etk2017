@extends('layouts.profile')
@section('description')
личный кабинет держателя карты ЕТК
@endsection
@section('keywords') 
@endsection
@section('title')
Пополнение баланса
@endsection
@section('content')
<div class="page-header header-filter" data-parallax="active" style="background-image: url(&quot;/images/bgs/bg_index_tr.jpg&quot;); transform: translate3d(0px, 0px, 0px);">
</div>
<div class="main main-raised">
  <div class="profile-content">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <h4 class="title">Пополнение баланса карты</h4>
        </div>
      </div>
      <div class="row">
        <div class="alert alert-info">
          <div class="container">
            <div class="alert-icon">
              <i class="material-icons">info_outline</i>
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true"><i class="material-icons">clear</i></span>
            </button>

            <b>Внимание:</b> Пополнение производится не моментальное, а по типу "отложенное пополнение". Т.е., на следующий день
          </div>
        </div>
      </div>
      <div class="row"></div>

    </div>
  </div>
</div>
@endsection





