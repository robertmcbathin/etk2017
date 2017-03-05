@extends('layouts.master')

@section('description')
Задать вопрос
@endsection
@section('keywords')

@endsection
@section('title')
Задать вопрос
@endsection
@section('content')
<div class="page-header header-filter simple-page-bg" data-parallax="active" style="background-image: url(&quot;/images/bgs/bg_temp.jpg&quot;); transform: translate3d(0px, 0px, 0px);">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1 class="title">Задать вопрос</h1>
                <h4>Здесь Вы можете задать вопрос</h4>
            </div>
        </div>
    </div>
</div>
<div class="main main-raised">
    <div class="section section-basic">
        <div class="container">
            <div class="col-md-8 col-md-offset-2">
            @if (Session::has('ok'))
                        <div class="alert alert-success">
                <div class="container">
                    <div class="alert-icon">
                        <i class="material-icons">check</i>
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="material-icons">clear</i></span>
                    </button>
                    <b>ГОТОВО!</b> Ваше сообщение отправлено! Ожидайте ответа по электронной почте
                </div>
            </div>
            @endif

             @if (count($errors) > 0)
            <div class="alert alert-danger">
                 <div class="container">
                     <div class="alert-icon">
                        <i class="material-icons">error_outline</i>
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="material-icons">clear</i></span>
                    </button>
                     <b>Ошибка!</b> Отправить сообщение не удалось. Повторите попытку позже
                </div>
            </div>
            @endif
                <div class="row">
                    <h2 class="title">Что Вас интересует?</h2>
                    <div class="col-md-12">
                        <p class="description">Пожалуйста, убедитесь, что на задаваемый Вами вопрос еще нет ответа в разделе <a href="{{route('faq')}}"> Вопросы и ответы</a><br><br>
                        </p>
                        <form role="form" id="contact-form" method="post" action="{{route('ask.add.post')}}">
                            <div class="form-group label-floating is-empty">
                                <label class="control-label">Ваше имя</label>
                                <input type="text" name="name" class="form-control" minlength="1" maxlength="100">
                                <span class="material-input"></span></div>
                                <div class="form-group label-floating is-empty">
                                    <label class="control-label">Email</label>
                                    <input type="email" name="email" class="form-control" minlength="1" maxlength="100">
                                    <span class="material-input"></span></div>

                                    <div class="form-group label-floating is-empty">
                                        <label class="control-label">Сообщение</label>
                                        <textarea name="content" class="form-control" id="content" rows="6" minlength="1" maxlength="4096"></textarea>
                                        <span class="material-input"></span></div>
                                        <div class="submit text-center">
                                            <input type="submit" class="btn btn-primary btn-raised btn-round" value="Отправить">
                                        </div>
                                        {{csrf_field()}}
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @endsection
