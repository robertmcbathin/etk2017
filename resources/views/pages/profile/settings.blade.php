@extends('layouts.profile')
@section('description')
@endsection
@section('keywords') 
@endsection
@section('title')
Настройки
@endsection
@section('content')
<div class="page-header header-filter" data-parallax="active" style="background-image: url(&quot;/images/bgs/bg_index_tr.jpg&quot;); transform: translate3d(0px, 0px, 0px);">
</div>
<div class="main main-raised">
  <div class="profile-content">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <h4 class="title">Настройки</h4>
        </div>
      </div>


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
      @if (Session::has('change-avatar-ok'))
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
              <strong>{{Session::pull('change-avatar-ok')}}</strong>
            </div>
          </div>  
        </div>
      </div>
      @endif
      @if (Session::has('change-avatar-error'))
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
              <strong>{{Session::pull('change-avatar-error')}}</strong>
            </div>
          </div>  
        </div>
      </div>
      @endif
      @if (Session::has('delete_card_success'))
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
              <strong>{{Session::pull('delete_card_success')}}</strong>
            </div>
          </div>  
        </div>
      </div>
      @endif
      @if (Session::has('delete_card_fail'))
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
              <strong>{{Session::pull('delete_card_fail')}}</strong>
            </div>
          </div>  
        </div>
      </div>
      @endif
      @if (Session::has('add_card_success'))
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
              <strong>{{Session::pull('add_card_success')}}</strong>
            </div>
          </div>  
        </div>
      </div>
      @endif
      @if (Session::has('add_card_fail'))
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
              <strong>{{Session::pull('add_card_fail')}}</strong>
            </div>
          </div>  
        </div>
      </div>
      @endif
      @if (Session::has('card_is_not_numeric'))
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
              <strong>{{Session::pull('card_is_not_numeric')}}</strong>
            </div>
          </div>  
        </div>
      </div>
      @endif
      @if (Session::has('acception_email_send'))
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
              <strong>{{Session::pull('acception_email_send')}}</strong>
            </div>
          </div>  
        </div>
      </div>
      @endif
      @if (Session::has('acception_email_fail'))
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
              <strong>{{Session::pull('acception_email_fail')}}</strong>
            </div>
          </div>  
        </div>
      </div>
      @endif
      @if (Session::has('phone_number_saved'))
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
              <strong>{{Session::pull('phone_number_saved')}}</strong>
            </div>
          </div>  
        </div>
      </div>
      @endif
      @if (Session::has('phone_number_failed'))
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
              <strong>{{Session::pull('phone_number_failed')}}</strong>
            </div>
          </div>  
        </div>
      </div>
      @endif
      @if (Session::has('user_with_this_email_exists'))
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
              <strong>{{Session::pull('user_with_this_email_exists')}}</strong>
            </div>
          </div>  
        </div>
      </div>
      @endif
      @if (Session::has('user_with_this_phone_exists'))
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
              <strong>{{Session::pull('user_with_this_email_exists')}}</strong>
            </div>
          </div>  
        </div>
      </div>
      @endif
      @if (Session::has('change_card_image_fail'))
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
              <strong>{{Session::pull('change_card_image_fail')}}</strong>
            </div>
          </div>  
        </div>
      </div>
      @endif
      @if (Session::has('change_card_image_ok'))
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
              <strong>{{Session::pull('change_card_image_ok')}}</strong>
            </div>
          </div>  
        </div>
      </div>
      @endif
      <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <div class="card card-nav-tabs" id="settings-block">
            <div class="header header-danger">
              <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                  <ul class="nav nav-tabs" data-tabs="tabs">
                    <li class="active">
                      <a href="#personal" data-toggle="tab" aria-expanded="false">
                        <i class="material-icons">chat</i>
                        Личные данные
                        <div class="ripple-container"></div></a>
                      </li>
                      <li class="">
                        <a href="#image" data-toggle="tab" aria-expanded="false">
                          <i class="material-icons">face</i>
                          Изображение профиля
                          <div class="ripple-container"></div></a>
                        </li>
                        <li class="">
                          <a href="#my-cards" data-toggle="tab" aria-expanded="true">
                            <i class="material-icons">credit_card</i>
                            Мои карты
                            <div class="ripple-container"></div></a>

                          </li>
                          <li class="">
                            <a href="#password" data-toggle="tab" aria-expanded="false">
                              <i class="material-icons">lock</i>
                              Пароль
                              <div class="ripple-container"></div></a>

                            </li>
                            <li class="">
                              <a href="#delete-account" data-toggle="tab" aria-expanded="false">
                                <i class="material-icons">delete</i>
                                Удалить аккаунт
                                <div class="ripple-container"></div></a>

                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                      <div class="card-content padding-plus">
                        <div class="tab-content ">
                          <div class="tab-pane active" id="personal">

                            <div class="row">
                              <div class="col-md-6 col-md-offset-3">
                                <h6>Персональные данные</h6>
                                <form action="{{ route('profile.change_personal_data.post') }}" method="POST">
                                  <div class="form-group is-empty">

                                    <input type="text" value="{{ Auth::user()->name }}" placeholder="Имя Отчество" class="form-control" name="name" required>
                                    <span class="material-input"></span>
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    {{ csrf_field()}}
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-6 col-md-offset-3">
                                  <div class="form-group is-empty">
                                    <input type="text" value="{{ Auth::user()->lastname }}" placeholder="Фамилия" class="form-control" name="lastname" required="">
                                    <span class="material-input"></span>
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-6 col-md-offset-3">

                                  <div class="input-group">
                                    <span class="input-group-addon">
                                      <i class="material-icons">wc</i>
                                    </span>
                                    <div class="form-group is-empty">
                                      <select class="form-control" data-style="btn btn-profile" title="Ваш пол" data-size="7" tabindex="-98" name="sex" value="">
                                        <option class="bs-title-option" value="{{ Auth::user()->sex }}">{{ $sex }}</option>
                                        <option value="U">Не определен</option>
                                        <option value="M">Мужской</option>
                                        <option value="F">Женский</option>
                                      </select>
                                    </div>
                                  </div>

                            
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-6 col-md-offset-3">

                                  <div class="input-group">
                                    <span class="input-group-addon">
                                      <i class="material-icons">perm_contact_calendar</i>
                                    </span>
                                    <div class="form-group is-empty">
                                      <input type="text" class="form-control datepicker" name="birthdate" value="{{ Auth::user()->birthdate }}" required>
                                      <span class="material-input"></span>
                                      <span>Пол и дата рождения необходимы для точной идентификации Вас как пользователя в случаях обращения к нам в офис лично</span>
                                    </div>
                                  </div>

                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-6 col-md-offset-3">
                                  <button type="submit" class="btn btn-profile btn-fullwidth">Сохранить изменения</button>
                                </div>
                              </div>
                            </form>
                            <hr>
                            <div class="row">
                              <div class="col-md-6 col-md-offset-3">
                                <h6>Контактные данные</h6>
                                <div class="form-group is-empty">
                                  <form action="{{ route('profile.change_email.post') }}" method="POST">
                                    <input type="email" value="{{ Auth::user()->email }}" placeholder="example@mail.com" class="form-control" name="email">
                                    <span class="material-input"></span>
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <small>На новый адрес электронной почты придет письмо со ссылкой на подтверждение нового адреса</small>
                                    {{ csrf_field()}}
                                    <button type="submit" class="btn btn-profile btn-fullwidth">Сменить Email</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                            <hr>
                            <div class="row">
                              <div class="col-md-6 col-md-offset-3">
                                <div class="form-group is-empty">
                                  <form action="{{ route('profile.change_phone.post') }}" method="POST">
                                    <input type="text" value="{{ Auth::user()->phone}}" placeholder="+70000000000" class="form-control" name="phone">
                                    <span class="material-input"></span>
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <small>Номер телефона будет использоваться для срочной связи с Вами</small>
                                    {{ csrf_field()}}
                                    <button type="submit" class="btn btn-profile btn-fullwidth">Сменить номер телефона</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                            @if (Auth::user()->is_email_receiver == 1)
                            <div class="row">
                              <div class="col-md-6 col-md-offset-3">
                                <div class="form-group is-empty">
                                  <form action="{{ route('profile.cancel_distribution.post') }}" method="POST">
                                    <span class="material-input"></span>
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <small>Вы подписаны на новости</small>
                                    {{ csrf_field()}}
                                    <button type="submit" class="btn btn-profile btn-fullwidth">Отказаться от рассылки</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                            @else
                            <div class="row">
                              <div class="col-md-6 col-md-offset-3">
                                <div class="form-group is-empty">
                                  <form action="{{ route('profile.accept_distribution.post') }}" method="POST">
                                    <span class="material-input"></span>
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <small>Вы не подписаны на новости</small>
                                    {{ csrf_field()}}
                                    <button type="submit" class="btn btn-profile">Подписаться снова</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                            @endif
                          </div>
                          <div class="tab-pane" id="image">
                            <p class="description">
                              <b>Внимание:</b> Размер изображения должен составлять не более 100КБ
                            </p>
                            <div class="row">
                              <div class="col-md-6 col-md-offset-3">
                                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                  <div class="fileinput-new thumbnail img-rounded img-raised">
                                    <img src="{{ Auth::user()->profile_image }}" alt="">
                                  </div>
                                  <div class="fileinput-preview fileinput-exists thumbnail img-rounded img-raised"></div>

                                  <div>
                                    <form action="{{ route('profile.change_avatar.post') }}" enctype="multipart/form-data" method="POST">
                                      <span class="btn btn-info btn-file">
                                        <span class="fileinput-new">Загрузить фото</span>
                                        <span class="fileinput-exists">Изменить</span>
                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                        <input type="file" name="avatar"></span>
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-profile">Сохранить изменения</button>
                                      </form>
                                      <br>
                                      <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Удалить</a>
                                    </div>
                                    @if ($errors->has('avatar'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('avatar') }}</strong>
                                    </span>
                                    @endif
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="my-cards">
                              <div class="row">
                                @foreach ($cards as $card)
                                <div class="col-md-12 col-xs-12">
                                  <div class="card  card-blog">
                                    <div class="row">
                                      <div class="col-md-3 col-xs-12">
                                        <div class="card-image">
                                          <img class="img img-raised" src="/pictures/cards/thumbnails/160/{{$card->card_image_type}}.png">
                                          <div class="colored-shadow" style="background-image: url(&quot;assets/img/examples/card-blog4.jpg&quot;); opacity: 1;"></div><div class="ripple-container"></div></div>
                                        </div>
                                        <div class="col-md-9 col-xs-12 left-margined">
                                          <h6 class="category text-info">{{ $card->name}}</h6>
                                          <h5 class="card-title">
                                            <a href="">{{ $card->number }}</a>
                                          </h5>
                                          <button class="btn btn-simple btn-linkedin" data-toggle="modal" data-target="#change-card-image-{{$card->number}}">
                                           <i class="fa fa-picture-o"></i> Сменить изображение
                                           <div class="ripple-container"></div>
                                         </button>

                                         <form action="{{ route('profile.delete_card.post') }}" method="POST">
                                          <input type="hidden" name="current_card" value="{{ $card->number }}">
                                          <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                          {{ csrf_field()}}
                                          <button type="submit" class="btn btn-simple btn-youtube away-link">
                                           <i class="fa fa-trash-o"></i> Удалить
                                           <div class="ripple-container"></div>
                                         </button>
                                       </form>
                                     </div>
                                   </div>
                                 </div>
                               </div>

                               @endforeach
                             </div>
                             <div class="row">
                               <div class="col-md-6 col-md-offset-3">
                                <button class="btn btn-profile" data-toggle="modal" data-target="#add-card-modal"><i class="material-icons">add</i> Добавить карту</button>
                              </div>
                            </div>
                          </div>
                          <div class="tab-pane" id="password">
                            <div class="row">
                              <div class="col-md-6 col-md-offset-3">
                                <form action="{{ route('profile.change_password.post') }}" method="POST">
                                  <div class="form-group is-empty">
                                   <input type="password" placeholder="Старый пароль" class="form-control" name="old_password">
                                 </div>
                                 <span class="material-input"></span>
                                 <div class="form-group is-empty">
                                   <input type="password" placeholder="Новый пароль" class="form-control" name="new_password" minlength="6">
                                 </div>
                                 <span class="material-input"></span>
                                 <div class="form-group is-empty">
                                   <input type="password" placeholder="Повторите пароль" class="form-control" name="password_repeat" minlength="6">
                                 </div>
                                 <span class="material-input"></span>
                                 <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                 {{ csrf_field()}}
                                 <button type="submit" class="btn btn-profile">Сменить пароль</button>
                               </form>
                             </div></div>
                           </div>
                           <div class="tab-pane" id="delete-account">
                             <div class="row">
                              <div class="col-md-6 col-md-offset-3">
                               <button class="btn btn-profile" data-toggle="modal" data-target="#delete-account-modal">Удалить аккаунт</button>
                               <p class="text-muted">При удалении аккаунта все Ваши карты будут удалены!</p>
                             </div></div>
                           </div>
                         </div>
                       </div>
                     </div>
                   </div>
                 </div>
                 <!-- END OF MENU -->
               </div>
             </div>
           </div>
         </div>
         <!-- ADD CARD MODAL  -->
         <div class="modal fade" id="add-card-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                  <i class="material-icons">clear</i>
                </button>
                <h4 class="modal-title">Добавить карту</h4>
              </div>
              <div class="modal-body">
                <form action="{{ route('profile.add_card.post') }}" method="POST">
                  <div class="form-group is-empty">
                   <input type="hidden" value="0" name="card_type" id="card_type">
                   <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                   <input type="text" class="form-control" id="card_number" name="card_number" value="{{ old('card_number') }}" required autofocus placeholder="000000000" minlength="9" maxlength="9">
                   <span class="material-input" id="card_preview">Тип карты</span>
                   <p class="text-muted">9 цифр. Для карт нового образца: номер карты без серии. Для остальных: серия и номер, начиная с 0 (как на карте) или с 1 (как на чеках). Например: 023000001 или 123000001</p>
                   <p class="text-muted">Доступные на текущий момент серии: 21,23,25,26,29,33,34,36,37,40,41,43,44,69,97 - Банковская транспортная карта</p>
                   {{ csrf_field()}}
                   <button type="submit" class="btn btn-profile">Добавить карту</button>
                 </div>
               </form>
             </div>
             <div class="modal-footer">
              <button type="button" class="btn btn-profile btn-simple" data-dismiss="modal">Закрыть</button>
            </div>
          </div>
        </div>
      </div>
      <!--  -->
      <div class="modal fade" id="delete-account-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                <i class="material-icons">clear</i>
              </button>
              <h4 class="modal-title">Вы действительно хотите удалить аккаунт?</h4>
            </div>
            <div class="modal-body">
              <form action="{{ route('profile.delete_account.post') }}" method="POST">
                <div class="form-group is-empty">
                 <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                 {{ csrf_field()}}
                 <button type="submit" class="btn btn-profile" >Да, я хочу удалить аккаунт</button>
               </div>
             </form>
           </div>
           <div class="modal-footer">
            <button type="button" class="btn btn-profile btn-simple" data-dismiss="modal">Отмена</button>
          </div>
        </div>
      </div>
    </div>

    @foreach ($cards as $card)
    <div class="modal fade" id="change-card-image-{{$card->number}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
     <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
             <i class="material-icons">clear</i>
           </button>
           <h4 class="modal-title">Изменение изображения карты</h4>
         </div>
         <div class="modal-body">
           <form action="{{ route('profile.change_card_image') }}" method="POST">
             @foreach ($card_types as $card_type)
             <div class="row">
               <div class="col-md-10 col-md-offset-1">
                 @if ($card->category == $card_type->category)
                 <div class="radio">
                  <label>
                    <input type="radio" name="card_image_type" value="{{ $card_type->id }}"><span class="circle"></span><span class="check"></span>
                    <img src="{{$card_type->image}}" class="img img-raised img-rounded" alt="" height="60px">
                    {{$card_type->name}}
                  </label>
                </div>
                @else
                <label>
                  <input type="radio" name="card_image_type" disabled><span class="circle"></span><span class="check"></span>
                  <img src="{{$card_type->image}}" class="img img-raised img-rounded" alt="" height="60px">
                  {{$card_type->name}}
                </label>
                @endif
              </div>
            </div>
            @endforeach
            <input type="hidden" name="card_number" value="{{ $card->number }}">
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            {{ csrf_field()}}
            <button type="submit" class="btn btn-profile" >Сохранить</button>
          </form>
        </div>
        <div class="modal-footer">
         <button type="button" class="btn btn-profile btn-simple" data-dismiss="modal">Отмена</button>
       </div>
     </div>
   </div>
 </div>
 @endforeach

 @endsection





