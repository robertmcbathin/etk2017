<?php 
$username = Auth::user()->name;
?>
<div class="sidebar" data-active-color="rose" data-background-color="black" data-image="/admin/img/sidebar-1.jpg">
            <!--
        Tip 1: You can change the color of active element of the sidebar using: data-active-color="purple | blue | green | orange | red | rose"
        Tip 2: you can also add an image using data-image tag
        Tip 3: you can change the color of the sidebar with data-background-color="white | black"
    -->
            <div class="logo">
                <a href="/" target="_blank" class="simple-text">
                    <img src="/admin/img/logo.png" height="50px" alt="">
                </a>
            </div>
            <div class="logo logo-mini">
                <a href="#" class="simple-text">
                    <img src="/admin/img/logo.png" height="25px" alt="">
                </a>
            </div>
            <div class="sidebar-wrapper">
                <div class="user">
                    <div class="photo">
                        <img src="/admin/img/users/{{Auth::user()->username}}.jpg" />
                    </div>
                    <div class="info">
                        <a data-toggle="collapse" href="dashboard.html#collapseExample" class="collapsed">
                            {{Auth::user()->name}}
                            <b class="caret"></b>
                        </a>
                        <div class="collapse" id="collapseExample">
                            <ul class="nav">
                                <li>
                                    <a href="{{route('sudo.logout.post')}}">Выйти</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <ul class="nav">
                    <li class="active">
                        <a href="{{ route('sudo.pages.dashboard') }}">
                            <i class="material-icons">dashboard</i>
                            <p>Панель управления</p>
                        </a>
                    </li>
                    <li>
                        <a data-toggle="collapse" href="dashboard.html#pagesExamples">
                            <i class="material-icons">image</i>
                            <p>Страницы
                                <b class="caret"></b>
                            </p>
                        </a>
                        @can('show-import', App\User::class)
                        <div class="collapse" id="pagesExamples">
                            <ul class="nav">
                                <li>
                                    <a href="{{route('sudo.pages.articles')}}">Новости</a>
                                </li>
                                <li>
                                    <a href="{{ route('sudo.pages.questions') }}">Вопросы</a>
                                </li>
                             <!--   <li>
                                    <a href="#">Пункты продаж</a>
                                </li>
                                <li>
                                    <a href="#">Пункты пополнения</a>
                                </li>
                                <li>
                                    <a href="#">Карты</a>
                                </li>
                                <li>
                                    <a href="#">Пользователи</a>
                                </li>-->
                            </ul>
                        </div>
                        @endcan

                    </li>
                    <li>
                        <a data-toggle="collapse" href="dashboard.html#service">
                            <i class="material-icons">contacts</i>
                            <p>Сервис
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="service">
                            <ul class="nav">
                                <li>
                                    <a href="{{ route('sudo.pages.operations') }}">Операции по картам</a>
                                </li>
                                @can('show-import', App\User::class)
                                <li>
                                    <a href="{{ route('sudo.pages.import') }}">Импорт</a>
                                </li>
                                @endcan
                                @can('show-reports', App\User::class)
                                <li>
                                    <a href="{{ route('sudo.pages.detailing-requests') }}">Детализация поездок</a>
                                </li>
                                @endcan
                            </ul>
                        </div>
                       
                    </li>
                    <li>
                        <a href="#">
                            <i class="material-icons">timeline</i>
                            <p>Статистика</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>