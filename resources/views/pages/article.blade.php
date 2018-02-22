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

            <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="media-aera">

                                @isset($comments)
                                    <h3 class="title text-center">Комментарии: {{ count($comments) }}</h3>
                                @endisset


                                @unless(Auth::check())
                                @if(count($comments) == 0)
                                <h3 class="text-center">Комментариев пока нет <br><small>- Войдите в свой профиль, чтобы оставить комментарий первым -</small></h3>
                                @else

                                @foreach($comments as $comment)
                                <div class="media">
                                          <a class="pull-left" href="#pablo">
                                              <div class="avatar">
                                                    <img class="media-object" alt="64x64" src="http://etk21.ru{{ $comment->profile_image }}">
                                              </div>
                                          </a>
                                          <div class="media-body">
                                                <h4 class="media-heading">{{ $comment->name }} {{ $comment->lastname }} <small>· {{ $comment->created_at }} </small></h4>
                                                @isset($comment->post) <h5>{{ $comment->post }}</h5> @endisset

                                                <p>{{ $comment->text }}</p>

                                                <div class="media-footer">
                                                    <a href="#pablo" class="btn btn-primary btn-simple pull-right" rel="tooltip" title="" data-original-title="Оставьте ответ к этому комментарию">
                                                        <i class="material-icons">reply</i> Ответить
                                                    <div class="ripple-container"></div></a>
                                                </div>
                                                @if($comment)
                                                @endif
                                          </div>
                                    </div>
                                @endforeach

                                @endif
                                @endunless
                                @auth

                                @endauth
                                </div>
                            </div>
                        </div>


        </div>
    </div>
</div>

@endsection
