@extends('layouts.master')

@section('description')
{{ $article->description }}
@endsection
@section('keywords')
{{ $article->title }}
@endsection
@section('title')
{{ $article->title }}
@endsection
@section('content')
<div class="page-header article-page-bg" data-parallax="active" style="background-image: url(&quot;{{$article->image}}&quot;); transform: translate3d(0px, 0px, 0px); -webkit-filter: blur(15px); filter: blur(15px); -moz-filter: blur(15px); -o-filter: blur(15px);">

</div>
<div class="main main-raised">
    <div class="section section-basic">
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
        <ol class="breadcrumb">
          <li><a href="{{route('news')}}">Новости</a></li>
          <li class="active">{{ $article->title }}</li>
      </ol>
  </div>
</div>
<div class="row">
 <div class="col-md-8 col-md-offset-2">
    <h3 class="title">{{$article->title}}</h3>
    <p>{{$article->content}}</p>

    <blockquote>
        <p>
            {{$article->created_at}} <br> Просмотров: {{$article->views}}
        </p>
    </blockquote>
    @if ($links)
    @foreach ($links as $link)
    <a href="{{$link->link}}"><span class="label label-info">{{$link->name}}</span></a>
    @endforeach
    @endif
</div>
</div>
<!--
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="media-aera">



            @unless(Auth::check())
            @if(count($comments) == 0)
            <h3 class="text-center">Комментариев пока нет <br></h3>
            @else
            <h3 class="title text-center">Комментарии: {{ count($comments) }}</h3>
            @foreach($comments as $comment)
            @if($comment->reply_to == null)
            <div class="media">
              <a class="pull-left" href="#">
                  <div class="avatar">
                    <img class="media-object" alt="64x64" src="http://etk21.ru{{ $comment->profile_image }}">
                </div>
            </a>
            <div class="media-body">
                @isset($comment->post) <h6>{{ $comment->post }}</h6> @endisset
                <h4 class="media-heading">{{ $comment->name }} {{ $comment->lastname }} <small>· {{ $comment->created_at }} </small></h4>


                <p>{{ $comment->text }}</p>

                    @foreach($comments as $reply) 
                    @if($reply->reply_to == $comment->id) 
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
        @endif
        @endunless




        @auth

        @if(count($comments) == 0)
        <h3 class="text-center">Комментариев пока нет <br></h3>
        @else
        <h3 class="title text-center">Комментарии: {{ count($comments) }}</h3>
        @foreach($comments as $comment)
        @if($comment->reply_to == null)
        <div class="media">
          <a class="pull-left" href="#">
              <div class="avatar">
                <img class="media-object"  alt="" src="http://etk21.ru{{ $comment->profile_image }}">
            </div>
        </a>
        <div class="media-body">
            @isset($comment->post) <h6>{{ $comment->post }}</h6> @endisset
            <h4 class="media-heading">{{ $comment->name }} {{ $comment->lastname }} <small>· {{ $comment->created_at }} </small></h4>


            <p>{{ $comment->text }}</p>

            <div class="media-footer">
                <a href="" data-toggle="modal" data-target="#reply-article-{{$comment->id}}" class="btn btn-primary btn-simple pull-right" rel="tooltip" title="" data-original-title="Оставьте ответ к этому комментарию">
                    <i class="material-icons">reply</i> Ответить
                    <div class="ripple-container"></div></a>
                </div>
                @foreach($comments as $reply) 
                @if($reply->reply_to == $comment->id) 
                <div class="media">
                  <a class="pull-left" href="#">
                    <div class="avatar">
                        <img class="media-object" alt="" src="http://etk21.ru{{ $reply->profile_image }}">
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
    @endif
    <hr>
    <div class="media media-post">
        <a class="pull-left author" href="">
          <div class="avatar">
            <img class="media-object" alt="" src="http://etk21.ru{{ Auth::user()->profile_image }}">
        </div>
    </a>
    <div class="media-body">
        <form action="{{ route('site.write-comment.post') }}" method="POST">
            <div class="form-group is-empty">
                <textarea class="form-control" name="comment" placeholder="Ваш комментарий..." rows="6" minlength="1" maxlength="500"></textarea>
                <span class="material-input"></span>
            </div>
            <div class="media-footer">
                <input type="hidden" name="author_id" value="{{Auth::user()->id}}">
                <input type="hidden" name="article_id" value="{{ $article->id }}">
                {{ csrf_field() }}
                <p class="description">Ваш ответ будет опубликован после проверки модератором</p>
                <button type="submit" class="btn btn-primary btn-wd pull-right">Отправить</button>
            </div>
        </form>
    </div>
</div>
@endauth


</div>
</div>
</div>


</div>
</div>
</div>

@auth
@if(count($comments) > 0)
@foreach($comments as $comment)
<div class="modal fade" id="reply-article-{{$comment->id}}" tabindex="-1" role="dialog" aria-labelledby="verify-number" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="material-icons">clear</i>
      </button>
      <h4 class="modal-title">Ответить пользователю {{ $comment->name }} {{ $comment->lastname }}</h4>

  </div>
  <div class="modal-body">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="form-group is-empty">
          <form action="{{ route('site.reply_article.post') }}" method="POST">
            <textarea class="form-control" minlength="1" maxlength="500" name="reply"  cols="30" rows="5" placeholder="Введите свой ответ здесь"></textarea>
            <span class="material-input"></span>
            <input type="hidden" name="author_id" value="{{Auth::user()->id}}">
            <input type="hidden" name="reply_to" value="{{ $comment->id }}">
            <input type="hidden" name="article_id" value="{{ $comment->article_id }}">
            {{ csrf_field() }}
            <p class="description">Ваш ответ будет опубликован после проверки модератором</p>
            <button type="submit" class="btn btn-profile btn-fullwidth">Ответить</button>
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
@endif
@endauth

-->
@endsection
