@section('title')
Начисление кэшбэка
@endsection
@extends('sudo.layouts.master')
@section('content')
<div class="main-panel">
  @include('sudo.includes.top-nav')
  <div class="content">
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


  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-icon" data-background-color="green">
          <i class="material-icons">credit_card</i>
        </div>                
        <h4 class="card-title">Начисление кэшбэка -
          <small class="category">Введите номер карты</small>
        </h4>
        <div class="card-content">
          <div class="row">
            <label class="col-sm-2 label-on-left"></label>
            <div class="col-sm-2">
              <div class="form-group label-floating is-empty">
                <label class="control-label"></label>
                <input id="cb-card_serie" class="form-control cb-operations-handler" type="text" name="required" required="true" aria-required="true" placeholder="00"  minlength="2" maxlength="2" value="23">
                <span class="material-input">Серия 2 цифры (по умолчанию 23)</span>
              </div>
            </div>
            <div class="col-sm-8">
              <div class="form-group label-floating is-empty">
                <label class="control-label"></label>
                <input id="cb-card_number" class="form-control cb-operations-handler" type="text" name="required" required="true" aria-required="true" placeholder="000 000"  minlength="6" maxlength="6">
                <span class="material-input">Последние 6 цифр</span></div>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card">
              <div class="card-header card-header-icon" data-background-color="green">
                <i class="material-icons">credit_card</i>
              </div>
              <h4 class="card-title">Данные по карте</h4>
              <div class="card-content">
                <p>Доступно к начислению: <b id="cb-balance"></b></p>
                <p>Начислено ранее: <b id="cb-balance-before"></b></p>
                <div id="cb-fill">
                <form action="" method="POST">
                  <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">
                  <input type="text" class="form-control" minlength="1" maxlength="4" name="cb-value">
                  <button class="btn btn-success" type="submit" disabled>Зачислить</button>
                </form>
                </div>
                <div id="cb-info-preloader">
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-8">
            <div class="card">
              <div class="card-header card-header-icon" data-background-color="green">
                <i class="material-icons">directions_bus</i>
              </div>
              <h4 class="card-title">История начислений</h4>
              <div class="card-content">
                <div class="table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Дата</th>
                        <th>Сумма</th>
                        <th class="text-right">Кем пополнено</th>
                      </tr>
                    </thead>
                    <tbody id="cb-history-results">
                    </tbody>
                    <h3 id="cb-history-results-none">
                    </h3>
                  </table>
                </div>
                <div id="cb-history-preloader"></div>
              </div>
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
<script>
  var token = '{{ Session::token() }}';
  var url = '{{ route('ajax.check_cb_operations') }}';
</script>