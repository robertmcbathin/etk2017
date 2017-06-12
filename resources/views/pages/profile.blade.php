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
          <div class="col-md-6 col-md-offset-1">
            <h4 class="title">Мои карты</h4>
            <div class="row collections">
              @if (count($cards) !== 0)
              @foreach ($cards as $card)

              <div class="col-md-6">
                <div class="card card-plain card-blog">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="card-image">
                        <img class="img img-raised" src="/pictures/cards/thumbnails/160/{{$card->card_image_type}}.png">
                        <div class="colored-shadow" style="background-image: url(&quot;assets/img/examples/card-blog4.jpg&quot;); opacity: 1;"></div><div class="ripple-container"></div></div>
                      </div>
                      <div class="col-md-8">
                        <h6 class="category text-info">{{ $card->name}}</h6>
                        <h3 class="card-title">
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
             <h4 class="title">Последние новости</h4>
             <div class="row">
               @foreach ($articles as $article)
               <div class="col-md-4">
                 <div class="card card-plain card-blog">
                  <div class="card-image">
                    <a href="">
                      <img class="img img-raised" src="{{$article->image}}">
                    </a>
                    <div class="colored-shadow" style="background-image: url(&quot;assets/img/examples/card-blog4.jpg&quot;); opacity: 1;"></div><div class="ripple-container"></    div></div>

                    <div class="card-content">
                      <h4 class="card-title">
                        <a href="{{route('article',['id' => $article->id])}}">{{ $article->title }}</a>
                      </h4>
                      <p class="card-description">
                        {{$article->description}}<a     href="{{route('article',['id' => $article->id])}}"> Подробнее </a>
                      </p>
                      <div class="footer">
                        <div class="stats">
                          <i class="material-icons">schedule</i>{{ $article->created_at }}
                        </div>
                      </div>
                    </div>
                  </div>
                  
                </div>

              </div>
              @endforeach
            </div>
            </div>
            <div class="col-md-3 col-md-offset-1 stats">
              <h4 class="title">Информация по карте</h4>
              <ul class="list-unstyled">
                <li>Номер <b>{{ session()->get('current_card_number', 'н/д') }}</b></li>
                <li>Баланс <b>{{ session()->get('current_card_balance', 'н/д') }} <i class="fa fa-ruble"></i></b></li>
                <li>Последняя операция по карте <b>{{ session()->get('current_card_last_transaction', 'н/д') }}</b></li>
                <li>Тип <b>{{ session()->get('current_card_kind', 'н/д') }}</b></li>
                <li>Состояние <b>{{ session()->get('current_card_state', 'н/д') }}</b></li>
              </ul>
              <hr>
              <h4 class="title">Информация по поездкам</h4>
              <small class="muted">Информация доступна за последний месяц</p>
                <p class="description">Здесь будет информация по поездкам</small>
                  <hr>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endsection





