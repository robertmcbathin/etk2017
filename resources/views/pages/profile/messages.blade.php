@extends('layouts.profile')
@section('description')
@endsection
@section('keywords') 
@endsection
@section('title')
Мои сообщения
@endsection
@section('content')
<div class="page-header header-filter" data-parallax="active" style="background-image: url(&quot;/images/bgs/bg_index_tr.jpg&quot;); transform: translate3d(0px, 0px, 0px);">
</div>
<div class="main main-raised">
  <div class="profile-content">
    <div class="container">
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
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <h4 class="title">Мои сообщения</h4>
          @if(count($messages) > 0)
        <h3 class="title text-center">Комментарии: {{ count($messages) }}</h3>
        @foreach($messages as $message)
        @if($message->reply_to == null)
        <div class="media">
          <a class="pull-left" href="#">
              <div class="avatar">
                <img class="media-object" alt="64x64" src="http://etk21.ru{{ $message->profile_image }}">
            </div>
        </a>
        <div class="media-body">
            @isset($message->post) <h6>{{ $message->post }}</h6> @endisset
            <h4 class="media-heading">{{ $message->name }} {{ $message->lastname }} <small>· {{ $message->created_at }} </small></h4>


            <p>{{ $message->text }}</p>

                @foreach($messages as $reply) 
                @if($reply->reply_to == $message->id) 
                <div class="media">
                  <a class="pull-left" href="#">
                    <div class="avatar">
                        <img class="media-object" alt="64x64" src="http://etk21.ru{{ $reply->profile_image }}">
                    </div>
                </a>
                <div class="media-body">
                    @isset($reply->post) <h6>{{ $reply->post }}</h6> @endisset
                    <h4 class="media-heading">{{ $reply->name }} {{ $reply->lastname }}<small>· {{ $reply->created_at }}</small></h4>
                    <p>{{ $reply->text }}</p>

                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
    @endif
    @endforeach
          @else
            <p>У Вас пока нет сообщений. Вы можете оставить комментарий под интересующей Вас новостью.</p>
          @endif
        </div>
      </div>
        </div>
      </div>
    </div>
    @endsection





