@extends('layouts.master')

@section('description')
Новости ООО "ЕТК" 
@endsection
@section('keywords')

@endsection
@section('title')
Новости
@endsection
@section('content')
<div class="page-header header-filter simple-page-bg" data-parallax="active" style="background-image: url(&quot;/images/bgs/bg_news.jpg&quot;); transform: translate3d(0px, 0px, 0px); ">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1 class="title">Новости</h1>
            </div>
        </div>
    </div>
</div>
<div class="main main-raised">
    <div class="section section-basic">
        <div class="container">
                    @foreach ($articles as $article)
                    <div class="col-md-4">
                        <div class="card card-blog">
                            <div class="card-image">
                                <a href="">
                                <img class="img" src="{{$article->image}}">
                                </a>
                                <div class="ripple-container"></div></div>
                                <div class="content">
                                    <h4 class="card-title">
                                        <a href="index.html#pablo">{{ $article->title }}</a>
                                    </h4>
                                    <small>{{$article->description}}</small>
                                    <div class="footer">
                                    <small style="float:left;"><a href="{{route('article',['id' => $article->id])}}">ПОДРОБНЕЕ</a></small>
                                     <div class="stats">
                                        <i class="material-icons">schedule</i>{{ $article->created_at }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
        </div>
        <div class="row">
            <div class="card-content text-center">
                <?php echo $articles->render(); ?>
            </div>
        </div>
    </div>
</div>

@endsection
