@section('title')
Статистика
@endsection
@extends('sudo.layouts.master')
@section('content')
<div class="main-panel">
  @include('sudo.includes.top-nav')
  <div class="content">
    <div class="container-fluid">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple">
            <i class="material-icons">assignment</i>
          </div>
          <div class="card-content">
            <h4 class="card-title">Статистика</h4>
             <div class="row">
              <label class="col-sm-2 label-on-left"></label>
              <div class="col-sm-6">
                <div class="form-group label-floating is-empty">
                  <label class="control-label"></label>
                  <form action="{{ route('sudo.analize-card.post') }}" method="POST">
                    {{ csrf_field() }}
                  <input id="card_number" class="form-control operations-handler" type="text" name="card_number" required="true" aria-required="true" placeholder="0100 000 000"  minlength="10" maxlength="10">
                  <span class="material-input">Все 10 цифр</span></div>
                  <input type="submit" class="btn btn-primary" value="Проанализировать">
                  </form>
                </div>
                <label class="col-sm-2 label-on-right">
                  <code></code>
                </label>
              </div>
          </div>
          <!-- end content-->
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