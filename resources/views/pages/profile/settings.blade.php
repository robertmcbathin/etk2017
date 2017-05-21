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
          <h3 class="title">Настройки</h3>
        </div>
      </div>
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
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <hr>
          <h4>Имя и фамилия</h4>
          <div class="row">
            <div class="col-md-6 col-md-offset-3">
              <div class="form-group is-empty">
                <form action="{{ route('profile.change_name.post') }}" method="POST">
                  <input type="text" value="{{ Auth::user()->name }}" placeholder="Имя Фамилия" class="form-control" name="name">
                  <span class="material-input"></span>
                  <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                  {{ csrf_field()}}
                  <button type="submit" class="btn btn-primary">Сменить имя</button>
                </form>
              </div>
            </div>
          </div>
          <hr>
          <h4>Изображение профиля</h4>
          <div class="row">
            <div class="alert alert-info">
              <div class="container">
                <div class="alert-icon">
                  <i class="material-icons">info_outline</i>
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true"><i class="material-icons">clear</i></span>
                </button>

                <b>Внимание:</b> Размер изображения должен составлять не более 100КБ
              </div>
            </div>
          </div>
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
                      <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                    </form>
                    <br>
                    <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Удалить</a>
                  </div>
                </div>
              </div></div>
              <hr>
              <h4>Мои карты</h4>
              <div class="row">
                @foreach ($cards as $card)
                <div class="col-md-4">
                  <div class="card card-profile">
                    <div class="card-image">
                      <a href="">
                        <img class="img" src="/pictures/cards/thumbnails/160/{{$card->card_image_type}}.png">
                      </a>
                      <div class="colored-shadow" style="background-image: url(&quot;assets/img/examples/card-profile1.jpg&quot;); opacity: 1;"></div><div class="ripple-container"></div></div>

                      <div class="card-content">
                        <h4 class="card-title">{{ $card->number }}</h4>
                        <h6 class="category text-gray">{{ $card->name}}</h6>
                      </div>
                      <div class="footer">
                        <form action="{{ route('profile.delete_card.post') }}" method="POST">
                          <input type="hidden" name="primary_card" value="{{ Auth::user()->primary_card }}">
                          <input type="hidden" name="current_card" value="{{ $card->number }}">
                          <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                          {{ csrf_field()}}
                          <button type="submit" class="btn btn-primary"><i class="material-icons">delete_sweep</i> Удалить карту</button>
                        </form>
                      </div>
                    </div>  
                  </div>
                  @endforeach
                </div>
                <div class="row">
                 <div class="col-md-6 col-md-offset-3">
                  <button class="btn btn-primary" data-toggle="modal" data-target="#add-card-modal"><i class="material-icons">add</i> Добавить карту</button>
                </div>
              </div>
              <hr>
              <h4>Пароль</h4>
              <div class="row">
                <div class="col-md-6 col-md-offset-3">
                  <form action="{{ route('profile.change_password.post') }}" method="POST">
                    <div class="form-group is-empty">
                     <input type="password" placeholder="Старый пароль" class="form-control" name="old_password">
                   </div>
                   <span class="material-input"></span>
                   <div class="form-group is-empty">
                     <input type="password" placeholder="Новый пароль" class="form-control" name="new_password" maxlength="6">
                   </div>
                   <span class="material-input"></span>
                   <div class="form-group is-empty">
                     <input type="password" placeholder="Повторите пароль" class="form-control" name="password_repeat" minlength="6">
                   </div>
                   <span class="material-input"></span>
                   <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                   {{ csrf_field()}}
                   <button type="submit" class="btn btn-primary">Сменить пароль</button>
                 </form>
               </div></div>
               <hr>
               <h4>Удаление аккаунта</h4>
               <div class="row">
                <div class="col-md-6 col-md-offset-3">
                  <form action="{{ route('profile.delete_account.post') }}" method="POST">
                    <div class="form-group is-empty">
                     <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                     {{ csrf_field()}}
                     <button type="submit" class="btn btn-primary">Удалить аккаунт</button>
                   </div>
                 </form>
               </div></div>
             </div>
           </div>
         </div>

       </div>
     </div>
   </div>
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
               <p class="text-muted">9 цифр. Для карт нового образца: номер карты без серии. Для остальных: серия и номер, начиная с 0. Например: 023000001</p>
               {{ csrf_field()}}
               <button type="submit" class="btn btn-primary">Добавить карту</button>
             </div>
           </form>
       </div>
       <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>
@endsection





