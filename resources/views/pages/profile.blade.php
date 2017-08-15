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
<div class="page-header header-filter" data-parallax="active" style="background-image: url(&quot;/images/bgs/triangle-background.jpg&quot;); transform: translate3d(0px, 0px, 0px);">
</div>
<div class="main main-raised">
  <div class="profile-content">
    <div class="container">
      <div class="tab-pane">
        @if (Session::has('error'))
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
                <strong>{{Session::pull('error')}}</strong>
              </div>
            </div>  
          </div>
        </div>
        @endif

        @if (Session::has('success'))
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
                <strong>{{Session::pull('success')}}</strong>
              </div>
            </div>  
          </div>
        </div>
        @endif
        @if (Session::has('verified-fail'))
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
                <strong>{{Session::pull('verified-fail')}}</strong>
              </div>
            </div>  
          </div>
        </div>
        @endif
        @if (Session::has('verified-card-search-fail'))
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
                <strong>{{Session::pull('verified-card-search-fail')}}</strong>
              </div>
            </div>  
          </div>
        </div>
        @endif
        @if (Session::has('verified-ok'))
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
                <strong>{{Session::pull('verified-ok')}}</strong>
              </div>
            </div>  
          </div>
        </div>
        @endif
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
                        @if ($card->verified == 0)
                        <h5 class="card-title">
                          <a href="">{{ $card->number }}</a> <i class="material-icons" data-toggle="tooltip" data-placement="right" data-container="body" data-original-title="Данная карта не подтверждена. Чтобы иметь возможность заблокировать карту или просмотреть информацию по поездкам, Вам необходимо подтвердить карту">lock</i>
                        </h5>
                        <button class="btn btn-simple btn-github" data-toggle="modal" data-target="#verify-card-number-{{$card->number}}">
                         <i class="material-icons">lock</i> Подтвердить
                         <div class="ripple-container"></div>
                       </button>
                       @else
                       <h5 class="card-title">
                        <a href="">{{ $card->number }}</a> <i class="material-icons" data-toggle="tooltip" data-placement="right" data-container="body" data-original-title="Карта успешно подтверждена. Вы можете просмотреть статистику по карте и заказать детализацию">lock_open</i>
                      </h5>
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
              @if ((session()->get('current_card_verified') == 1) && ((session()->get('current_card_block_state') == 0) && (session()->get('current_card_state')) == 'В обращении') )
              <button class="btn btn-simple" data-toggle="modal" data-target="#block-card-{{ session()->get('current_card_number') }}">
               <i class="fa fa-lock"></i> Заблокировать
             </button>
             @elseif ((session()->get('current_card_verified') == 1) && (session()->get('current_card_block_state') == 1))
             <button class="btn btn-simple" data-toggle="modal" data-target="#cancel-block-card-{{ session()->get('current_card_number') }}">
               <i class="fa fa-lock"></i> Отменить блокировку
             </button>
             @endif
           </ul>
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

@foreach ($cards as $card)
<div class="modal fade" id="verify-card-number-{{$card->number}}" tabindex="-1" role="dialog" aria-labelledby="verify-number" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="material-icons">clear</i>
        </button>
        <h4 class="modal-title">Подтверждение карты № {{ $card->number }}</h4>
        <small class="description">Для подтверждения владения картой Вам необходимо ввести <strong>первые 8 символов</strong> чипа карты (чип карты Вы можете найти на чеке, который выдает устройство самоослуживания при пополнении карты или на экране данного устройства при прикладывании карты к считывателю).</small>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6 col-md-offset-3">
            <div class="form-group is-empty">
              <form action="{{ route('profile.verify_card') }}" method="POST">
                <input type="text" placeholder="AAAAAAAA" class="form-control" name="chip" minlength="8" maxlength="8">
                <span class="material-input"></span>
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                <input type="hidden" name="number" value="{{$card->number}}">
                {{ csrf_field() }}
                <p class="description">Ввод латиницей заглавными буквами</p>
                <button type="submit" class="btn btn-profile">Подтвердить</button>
              </form>
              <span class="material-input"></span></div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Отмена<div class="ripple-container"><div class="ripple ripple-on ripple-out" style="left: 17.0781px; top: 20px; background-color: rgb(244, 67, 54); transform: scale(8.50977);"></div></div></button>
      </div>
    </div>
  </div>
</div>
@endforeach
<!-- BLOCK CARD -->
@if (session()->get('current_card_verified') == 1)
<div class="modal fade" id="block-card-{{ session()->get('current_card_number') }}" tabindex="-1" role="dialog" aria-labelledby="block-card" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="material-icons">clear</i>
        </button>
        <h4 class="modal-title">Блокировка карты № {{ session()->get('current_card_number') }}</h4>
        <small class="description">Обращаем Ваше внимание, что карта будет заблокирована при следующей поездке, но не раньше чем на следующий день после внесения ее в блокировочный список. Вы можете отменить заявление на блокировку карты до 18:00 текущего дня.</small>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6 col-md-offset-3">
           <form action="{{ route('profile.block_card.post') }}" method="POST">
            <input type="hidden" name="current_card" value="{{ session()->get('current_card_number') }}">
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <input type="hidden" name="to_state" value="02">
            {{ csrf_field()}}
            <button type="submit" class="btn btn-primary">
             <i class="fa fa-lock"></i> Заблокировать карту №{{ session()->get('current_card_number') }}
             <div class="ripple-container"></div>
           </button>
         </form>
       </div>
     </div>
   </form>
 </div>
 <div class="modal-footer">
  <button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Отмена<div class="ripple-container"><div class="ripple ripple-on ripple-out" style="left: 17.0781px; top: 20px; background-color: rgb(244, 67, 54); transform: scale(8.50977);"></div></div></button>
</div>
</div>
</div>
</div>
@endif
<!-- CANCEL BLOCK CARD -->
@if (session()->get('current_card_verified') == 1)
<div class="modal fade" id="cancel-block-card-{{ session()->get('current_card_number') }}" tabindex="-1" role="dialog" aria-labelledby="cancel-block-card" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="material-icons">clear</i>
        </button>
        <h4 class="modal-title">Отмена блокировки карты № {{ session()->get('current_card_number') }}</h4>
        <small class="description">Обращаем Ваше внимание, что карта будет заблокирована при следующей поездке, но не раньше чем на следующий день после внесения ее в блокировочный список. Вы можете отменить заявление на блокировку карты до 18:00 текущего дня.</small>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6 col-md-offset-3">
           <form action="{{ route('profile.cancel_block_card.post') }}" method="POST">
            <input type="hidden" name="current_card" value="{{ session()->get('current_card_number') }}">
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            {{ csrf_field()}}
            <button type="submit" class="btn btn-primary">
             <i class="fa fa-lock"></i> Отменить блокировку №{{ session()->get('current_card_number') }}
             <div class="ripple-container"></div>
           </button>
         </form>
       </div>
     </div>
   </form>
 </div>
 <div class="modal-footer">
  <button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Отмена<div class="ripple-container"><div class="ripple ripple-on ripple-out" style="left: 17.0781px; top: 20px; background-color: rgb(244, 67, 54); transform: scale(8.50977);"></div></div></button>
</div>
</div>
</div>
</div>
@endif

<!-- UNBLOCK CARD -->
@if (session()->get('current_card_verified') == 1)
<div class="modal fade" id="unblock-card-{{ session()->get('current_card_number') }}" tabindex="-1" role="dialog" aria-labelledby="unblock-card" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="material-icons">clear</i>
        </button>
        <h4 class="modal-title">Разблокировка карты № {{ session()->get('current_card_number') }}</h4>
        <small class="description">Создать запрос на разблокировку карты необходимо до 18:00 текущего дня. Карта разблокируется на следущий день</small>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6 col-md-offset-3">
           <form action="{{ route('profile.unblock_card.post') }}" method="POST">
            <input type="hidden" name="current_card" value="{{ session()->get('current_card_number') }}">
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <input type="hidden" name="to_state" value="04">
            {{ csrf_field()}}
            <button type="submit" class="btn btn-primary">
             <i class="fa fa-lock"></i> Разблокировать карту №{{ session()->get('current_card_number') }}
             <div class="ripple-container"></div>
           </button>
         </form>
       </div>
     </div>
   </form>
 </div>
 <div class="modal-footer">
  <button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Отмена<div class="ripple-container"><div class="ripple ripple-on ripple-out" style="left: 17.0781px; top: 20px; background-color: rgb(244, 67, 54); transform: scale(8.50977);"></div></div></button>
</div>
</div>
</div>
</div>
@endif

<!-- CANCEL BLOCK CARD -->
@if (session()->get('current_card_verified') == 1)
<div class="modal fade" id="cancel-unblock-card-{{ session()->get('current_card_number') }}" tabindex="-1" role="dialog" aria-labelledby="cancel-unblock-card" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="material-icons">clear</i>
        </button>
        <h4 class="modal-title">Отмена разблокировки карты № {{ session()->get('current_card_number') }}</h4>
        <small class="description">Обращаем Ваше внимание, что карта будет разблокирована при следующей поездке, но не раньше чем на следующий день после внесения ее в блокировочный список. Вы можете отменить заявление на разблокировку карты до 18:00 текущего дня.</small>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6 col-md-offset-3">
           <form action="{{ route('profile.cancel_unblock_card.post') }}" method="POST">
            <input type="hidden" name="current_card" value="{{ session()->get('current_card_number') }}">
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            {{ csrf_field()}}
            <button type="submit" class="btn btn-primary">
             <i class="fa fa-lock"></i> Отменить разблокировку №{{ session()->get('current_card_number') }}
             <div class="ripple-container"></div>
           </button>
         </form>
       </div>
     </div>
   </form>
 </div>
 <div class="modal-footer">
  <button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Отмена<div class="ripple-container"><div class="ripple ripple-on ripple-out" style="left: 17.0781px; top: 20px; background-color: rgb(244, 67, 54); transform: scale(8.50977);"></div></div></button>
</div>
</div>
</div>
</div>
@endif

@endsection





