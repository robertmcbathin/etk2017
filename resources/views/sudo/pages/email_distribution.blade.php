@section('title')
Рассылка email
@endsection
@extends('sudo.layouts.master')
@section('content')
<div class="main-panel">
  @include('sudo.includes.top-nav')
  <div class="content">
    <div class="container-fluid">
      <div class="container-fluid">
        @if (Session::has('success'))
        <div class="row">
         <div class="alert alert-success">
          <button type="button" aria-hidden="true" class="close">
            <i class="material-icons">close</i>
          </button>
          <span>
            {{Session::pull('success')}}</span>
          </div>
        </div>
        @endif
        @if (Session::has('error'))
        <div class="row">
         <div class="alert alert-danger">
          <button type="button" aria-hidden="true" class="close">
            <i class="material-icons">close</i>
          </button>
          <span>
            {{Session::pull('error')}}</span>
          </div>
        </div>
        @endif
        <div class="col-md-12">
          <div class="col-lg-12 col-md-12">
            <div class="card">
              <div class="card-header card-header-text" data-background-color="rose">
                <h4 class="card-title">Список рассылок</h4>
              </div>
              <div class="col-md-3">
                <div class="card card-stats">
                  <div class="card-header" data-background-color="orange">
                  <i class="material-icons">email</i>
                  </div>
                  <div class="card-content">
                    <p class="category">Запуск онлайн-пополнения</p>
                    <h3 class="card-title">{{ $lk_email_count }} адресов</h3>
                  </div>
                  <div class="card-footer">
                    <div class="stats">
                      <a href="{{ route('sudo.pages.email-distribution.lk-start') }}">Тестовая отправка</a>
                    </div>
                    <div class="stats pull-right">
                      <a href="{{ route('sudo.pages.email-distribution.lk-start') }}">Отправить</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3"></div>
              <div class="col-md-3"></div>
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