@extends('layouts.master')

@section('description')
Брелоки с транспортным приложением
@endsection
@section('keywords')

@endsection
@section('title')
Брелоки Airtag
@endsection
@section('content')
<div class="page-header header-filter simple-page-bg" data-parallax="active" style="background-image: url(&quot;/images/bgs/etkplus-bg2.jpg&quot;); transform: translate3d(0px, 0px, 0px); ">
    <div class="container">
        <div class="row">
        <div class="col-md-10 col-md-offset-1">
                <h1 class="title">Брелоки Airtag</h1>
            </div>
        </div>
    </div>
</div>
<div class="main main-raised">
    <div class="section section-basic">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <ol class="breadcrumb">
                      <li><a href="{{route('static_articles')}}">Дополнительная информация</a></li>
                      <li class="active">Брелоки Airtag</li>
                  </ol>
              </div>
          </div>
          <div class="row">
            <div class="col-md-8 col-md-offset-2">
                        <h3 class="title">Брелоки Airtag</h3>
                        <img class="img-responsive" alt="Airtag" src="/pictures/static_articles/airtags/airtag-shadow.png">
                        <br>
                        <p>Если формат карты Вам неудобен, Вы можете воспользоваться брелоками типа <b>Airtag</b> - его можно прикрепить к связке ключей!</p>
                        <p>Работают и пополняются такие брелоки так же, как и обычные карты.</p>
                        <blockquote>
                          <small>14/08/2017</small>
                        </blockquote>
                    </div>
          </div>    
      </div>
  </div>
</div>

@endsection
