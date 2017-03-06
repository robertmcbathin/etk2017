@section('title')
Добавить новость
@endsection
@extends('sudo.layouts.master')
@section('content')
<div class="main-panel">
    @include('sudo.includes.top-nav')
    <div class="content">
        <div class="container-fluid">
            <div class="col-md-12">
                     @if (Session::has('add-article-ok'))
                     <div class="row">
                         <div class="alert alert-success">
                                        <button type="button" aria-hidden="true" class="close">
                                            <i class="material-icons">close</i>
                                        </button>
                                        <span>
                                            <b> Готово - </b> Новость сохранена</span>
                                    </div>
                     </div>
         @endif
         @if (Session::has('add-article-error'))
         <div class="row">
                         <div class="alert alert-danger">
                                        <button type="button" aria-hidden="true" class="close">
                                            <i class="material-icons">close</i>
                                        </button>
                                        <span>
                                            <b> Ошибка - </b> Сохранить новость не удалось</span>
                                    </div>
         </div>
         @endif
                <div class="card">
                                <div class="card-header card-header-icon" data-background-color="rose">
                                    <i class="material-icons">book</i>
                                </div>
                                <div class="card-content">
                                    <h4 class="card-title">Добавление новости</h4>
                                    <form method="POST" action="{{route('sudo.articles.add.post')}}" enctype="multipart/form-data">
                                        <div class="form-group label-floating is-empty">
                                            <label class="control-label">Заголовок</label>
                                            <input type="text" class="form-control" minlength="1" maxlength="100" name="title">
                                        <span class="material-input"></span>
                                        </div>
                                        <div class="form-group label-floating is-empty">
                                            <label class="control-label">Краткое описание</label>
                                            <input type="text" class="form-control" minlength="1" maxlength="255" name="description">
                                        <span class="material-input"></span>
                                        </div>
                                        <div class="form-group label-floating is-empty">
                                            <label class="control-label">Полное описание</label>
                                            <input type="text" class="form-control" minlength="1" maxlength="4096" name="content">
                                        <span class="material-input"></span>
                                        </div>
                                        <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail">
                                                    <img src="http://placehold.it/470x365" alt="">
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                                <div>
                                                    <span class="btn btn-rose btn-round btn-file">
                                                        <span class="fileinput-new">Выбрать изображение</span>
                                                        <span class="fileinput-exists">Изменить</span>
                                                        <input type="file" name="image" id="image">
                                                    </span>
                                                    <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Удалить</a>
                                                </div>
                                            </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="published" value="1" checked> Опубликовать
                                            </label>
                                        </div>
                                        <button type="submit" class="btn btn-fill btn-rose">Сохранить</button>
                                        {{csrf_field()}}
                                    </form>
                                </div>
                            </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container-fluid">
            <nav class="pull-left">
                <ul>
                    <li>
                        <a href="{{route('sudo.pages.dashboard')}}">
                            Панель управления
                        </a>
                    </li>
                </ul>
            </nav>
            <p class="copyright pull-right">
                &copy;
                <script>
                    document.write(new Date().getFullYear())
                </script>
                ООО "Единая транспортная карта"
            </p>
        </div>
    </footer>
</div>
@endsection