@extends('layouts.master')

@section('description')
{{ $article->description }}
@endsection
{{ $article->title }}
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
                                {{$article->created_at}}
                            </p>
                        </blockquote>
                    </div>
            </div>

        </div>
    </div>
</div>

@endsection
