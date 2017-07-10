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
      <div class="tab-pane">
        <div class="row">
          <div class="col-md-6 col-md-offset-1 col-sm-6">
            <h4 class="title">Мои карты</h4>
            <div class="row collections">
              @if (count($cards) !== 0)
              @foreach ($cards as $card)
              <div class=" col-xs-6 col-md-6">
                <div class="card card-plain card-blog">
                  <div class="row">
                    <div class="col-xs-12 col-md-6">
                      <div class="card-image">
                        <img class="img img-raised" src="/pictures/cards/thumbnails/160/{{$card->card_image_type}}.png">
                        <div class="colored-shadow" style="background-image: url(&quot;assets/img/examples/card-blog4.jpg&quot;); opacity: 1;"></div><div class="ripple-container"></div></div>
                      </div>
                      <div class="col-xs-12 col-md-6">
                        <h6 class="category text-info">{{ $card->name}}</h6>
                        <h5 class="card-title">
                          <a href="">{{ $card->number }}</a> <i class="material-icons" data-toggle="tooltip" data-placement="right" data-container="body" data-original-title="Данная карта не подтверждена. Чтобы иметь возможность заблокировать карту или просмотреть информацию по поездкам, Вам необходимо подтвердить карту">lock</i>
                        </h3>
                        @if ($card->verified == 0)
                        <button class="btn btn-simple btn-github">
                         <i class="material-icons">lock</i> Подтвердить
                         <div class="ripple-container"></div>
                       </button>
                       @endif
                     </div>
                   </div>
                 </div>
               </div>
               @endforeach
               @else 
               <p class="description">Нет добавленных карт. Добавить карты Вы можете в разделе <a href="{{ route('profile.settings') }}">настройки</a>.</p>
               @endif
             </div>
        
              </div>
              <div class="col-md-3 col-md-offset-1 stats col-sm-3">
                <h4 class="title">Информация по карте</h4>
                <ul class="list-unstyled">
                  <li>Номер <b>{{ session()->get('current_card_number', 'неизвестно') }}</b></li>
                  <li>Баланс <b>{{ session()->get('current_card_balance', 'неизвестно') }} <i class="fa fa-ruble"></i></b></li>
                  <li>Последняя операция по карте <b>{{ session()->get('current_card_last_transaction', 'н/д') }}</b></li>
                  <li>Тип <b>{{ session()->get('current_card_kind', 'неизвестно') }}</b></li>
                  <li>Состояние <b>{{ session()->get('current_card_state', 'неизвестно') }}</b></li>
                </ul>
                <hr>
                <h4 class="title">Информация по поездкам</h4>
                <small class="muted">Информация доступна за последнюю неделю</small>
                <table class="table" id="profile-trips-table">
                  <tbody>
                  </tbody><thead>

                </thead>
                <tbody>
                @if ($trips)
                  @foreach ($trips as $trip)
                  <tr>
                    <td>{{ $trip->DATE_OF }}</td>
                    <td> <img src="/images/icons/{{$trip->transport_type}}.png" alt=""> {{ $trip->name }}</td>
                    <td>{{ $trip->AMOUNT }} <i class="fa fa-ruble"></i></td>
                  </tr>
                  @endforeach
                @else
                <small class="description">Информации о поездках нет</small>
                @endif

              </tbody>

            </table>
            <hr>
          </div>
        </div>
      </div>
       <h4 class="title">Последние новости</h4>
             <div class="row">
               @foreach ($articles as $article)

               <div class="card card-plain card-blog padding-plus">
                <div class="row">
                  <div class="col-md-4">
                    <div class="card-image">
                      <img class="img img-raised" src="{{$article->image}}">
                      <div class="colored-shadow" style="background-image: url(&quot;assets/img/examples/card-blog4.jpg&quot;); opacity: 1;"></div><div class="ripple-container"></div></div>
                    </div>
                    <div class="col-md-8">
                      <h6 class="card-title">
                        <a href="{{route('article',['id' => $article->id])}}">{{ $article->title }}</a>
                      </h6>
                      <p class="card-description">
                        {{ $article->description }}<a href="{{route('article',['id' => $article->id])}}"> Подробнее </a>
                      </p>
                      <p class="author">
                        <i class="material-icons">schedule</i>{{ $article->created_at }}

                      </p></div>
                    </div>
                  </div>

                  @endforeach
                </div>
    </div>

  </div>
</div>
@endsection





