@extends('layouts.master')

@section('description')
Статьи
@endsection
@section('keywords')

@endsection
@section('title')
Статьи
@endsection
@section('content')
<div class="page-header header-filter simple-page-bg" data-parallax="active" style="background-image: url(&quot;/images/bgs/bg_temp3.jpg&quot;); transform: translate3d(0px, 0px, 0px); ">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1 class="title">Статьи</h1>
            </div>
        </div>
    </div>
</div>
<div class="main main-raised">
    <div class="section section-basic">
        <div class="container">
         <div class="row">

            <div class="col-md-4">
                <div class="card card-blog">
                    <div class="card-image">
                        <a href="/static_articles/double_cards">
                            <img class="img" src="/pictures/static_articles/double_cards/double_cards.jpg">
                            <div class="card-title">
                                Список дублирующихся карт, подлежащих замене
                            </div>
                        </a>
                    </div>

                    <div class="content">
                        <p class="card-description">
                             По техническим причинам, дублирующиеся карты необходимо заменить
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-blog">
                    <div class="card-image">
                        <a href="/static_articles/is-it-safely">
                            <img class="img" src="/pictures/static_articles/is-it-safely/is-it-safely.jpg">
                            <div class="card-title">
                                Правда ли, что все так безопасно?
                            </div>
                        </a>
                    </div>

                    <div class="content">
                        <p class="card-description">
                            Можно ли снять с электронного кошелька деньги несколько раз подряд? 
                        </p>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</div>
</div>

@endsection
