@section('title')
Панель управления
@endsection
@extends('sudo.layouts.master')
@section('content')
        <div class="main-panel">
            @include('sudo.includes.top-nav')
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="orange">
                                    <i class="material-icons">feedback</i>
                                </div>
                                <div class="card-content">
                                    <p class="category">Вопросы</p>
                                    <h3 class="card-title">{{$questions_count}}</h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons">list</i><a href="">Перейти к вопросам</a> 
                                    </div>
                                </div>
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
                                <a href="dashboard.html#">
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