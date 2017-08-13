@extends('layouts.master')

@section('description')
@endsection
@section('keywords')
@endsection
@section('title')
Не найдено
@endsection
@section('content')
<div class="page-header header-filter"  data-parallax="active" style="background-image: url(&quot;/images/bgs/bg_index_tr.jpg&quot;); transform: translate3d(0px, 0px, 0px);">
     <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="card card-profile card-plain">
                    <div class="col-md-5 hidden-xs">
                        </div>
                        <div class="col-md-5 visible-xs" id="card-xs-img">
                            </div>
                            <div class="col-md-7">
                                <div class="content">
                                    <h3 class="card-title" id="landing-title">404</h3>

                                    <h5 class="card-description" id="landing-content">
                                 Хмм... Ничего не найдено...
                                 </h5>

                                 <div class="footer text-right">
                                    <a href="/" class="btn btn-primary landing-link">Вернуться на главную страницу</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>

    @endsection
