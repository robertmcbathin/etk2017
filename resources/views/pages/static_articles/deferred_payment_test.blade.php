@extends('layouts.master')

@section('description')
Окончание тестирования сервиса отложенного пополнения
@endsection
@section('keywords')

@endsection
@section('title')
Окончание тестирования сервиса отложенного пополнения
@endsection
@section('content')
<div class="page-header simple-page-bg" data-parallax="active" style="background-image: url(&quot;/images/bgs/bg2018_3.jpg&quot;); transform: translate3d(0px, 0px, 0px); ">
    <div class="container">
        <div class="row">
        <div class="col-md-10 col-md-offset-1">
                <h1 class="title">Окончание тестирования сервиса отложенного пополнения</h1>
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
                      <li class="active">Окончание тестирования сервиса отложенного пополнения</li>
                  </ol>
              </div>
          </div>
          <div class="row">
            <div class="col-md-8 col-md-offset-2">
                        
                        <h3 class="title">Результаты пилотного проекта</h3>
                        <p>По итогам анализа работы сервиса отложенного пополнения было выявлено, что проблемы при пополнении возникают у 10-15% пользователей. Подробнее можете прочитать в статье 
                          <a href="/static_articles/about_deferred_payment">О запуске отложенного пополнения</a>.</p>
                        <blockquote>
              <p>
                Выявленные случаи показали наличие некорректной работы программного обеспечения. На устранение причин потребуется 3-4 недели. В связи с этим, сервис будет временно приостановлен 5 марта с 00:00 . Ориентировочно, сервис отложенного пополнения электронных кошельков будет запущен в промышленную эксплуатацию в апреле 2018 года. Отложенное продление проездных работает корректно и приостанавливаваться не будет.
              </p>
              <small>
              Александр Иванов, Технический директор ООО "ЕТК".
              </small>
            </blockquote>
                        <h3 class="title">Что делать, если Ваша карта не пополнилась</h3>
                        <p>В течение недели мы восстановим большинство отложенных пополнений, не записанных на карту. В случае, если до 12 марта 2018 года пополнение так и не произошло, просьба обратиться в один из наших офисов.</p>
                        <blockquote>
                          <small>4/03/2018</small>
                        </blockquote>
                    </div>
          </div>    
      </div>
  </div>
</div>

@endsection
