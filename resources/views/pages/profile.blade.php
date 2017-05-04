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
                                <h6>Электронный кошелек</h6>
                            </div>
                        </div>
                    </div>
                </div>

                
                        <div class="row">
                            <div class="col-md-7 col-md-offset-1">
                                <h4 class="title">Информация по карте</h4>
                                <div class="card card-nav-tabs card-plain">
                                <div class="header header-danger">
                                    <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                                    <div class="nav-tabs-navigation">
                                        <div class="nav-tabs-wrapper">
                                            <ul class="nav nav-tabs" data-tabs="tabs">
                                                <li class="active"><a href="#deposit" data-toggle="tab">Пополнение (Сбербанк)</a></li>
                                                <li><a href="#updates" data-toggle="tab">Updates<div class="ripple-container"></div></a></li>
                                                <li><a href="#history" data-toggle="tab">History</a></li>
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
                                            @else
                                            <h3>Нет данных</h3>
                                            @endif
                                            </tbody>
                                            
                                        </table>
                                    </div>
                                        </div>
                                        <div class="tab-pane" id="updates">
                                            <p> I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus. I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at. I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at. </p>
                                        </div>
                                        <div class="tab-pane" id="history">
                                            <p> I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at. I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus. I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at.</p>
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





