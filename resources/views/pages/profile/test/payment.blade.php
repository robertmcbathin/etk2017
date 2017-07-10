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
        <div class="col-md-8 col-md-offset-2">
          <h4 class="title">Пополнение баланса карты</h4>
        </div>
      </div>
        @if (Session::has('current_card_number'))
       <p class="description">Онлайн-пополнение пока недоступно</p>
      @else
        <p class="text-danger description">Не выбрана карта для пополнения</p>
      @endif
      <p class="description">
        <b>Внимание:</b> Пополнение производится не моментальное, а по типу "отложенное пополнение". Т.е., на следующий день
      </p>
      <div class="row"></div>

    </div>
  </div>
</div>
@endsection





