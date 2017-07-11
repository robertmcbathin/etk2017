@section('title')
Операции по картам
@endsection
@extends('sudo.layouts.master')
@section('content')
<div class="main-panel">
    @include('sudo.includes.top-nav')
    <div class="content">
        <div class="container-fluid">
          @if (Session::has('cancel-block-success'))
          <div class="row">
             <div class="alert alert-success">
                <button type="button" aria-hidden="true" class="close">
                  <i class="material-icons">close</i>
              </button>
              <span>
                  {{Session::pull('cancel-block-success')}}</span>
              </div>
          </div>
          @endif
          @if (Session::has('cancel-block-access-denied'))
          <div class="row">
             <div class="alert alert-danger">
                <button type="button" aria-hidden="true" class="close">
                  <i class="material-icons">close</i>
              </button>
              <span>
                  {{Session::pull('cancel-block-access-denied')}}</span>
              </div>
          </div>
          @endif
          @if (Session::has('add-to-blocklist-success'))
          <div class="row">
             <div class="alert alert-success">
                <button type="button" aria-hidden="true" class="close">
                  <i class="material-icons">close</i>
              </button>
              <span>
                  {{Session::pull('add-to-blocklist-success')}}</span>
              </div>
          </div>
          @endif
          @if (Session::has('add-to-blocklist-fail'))
          <div class="row">
             <div class="alert alert-danger">
                <button type="button" aria-hidden="true" class="close">
                  <i class="material-icons">close</i>
              </button>
              <span>
                  {{Session::pull('add-to-blocklist-fail')}}</span>
              </div>
          </div>
          @endif
          @if (Session::has('number-already-isset'))
          <div class="row">
             <div class="alert alert-danger">
                <button type="button" aria-hidden="true" class="close">
                  <i class="material-icons">close</i>
              </button>
              <span>
                  {{Session::pull('number-already-isset')}}</span>
              </div>
          </div>
          @endif
          <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="rose">
                        <i class="material-icons">credit_card</i>
                    </div>                
                    <h4 class="card-title">Операции по картам -
                        <small class="category">Введите номер карты</small>
                    </h4>
                    <div class="card-content">
                        <div class="row">
                            <label class="col-sm-2 label-on-left"></label>
                            <div class="col-sm-2">
                                <div class="form-group label-floating is-empty">
                                    <label class="control-label"></label>
                                    <input id="card_serie" class="form-control" type="text" name="required" required="true" aria-required="true" placeholder="00"  minlength="2" maxlength="2">
                                    <span class="material-input">Серия 2 цифры (по умолчанию 23)</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group label-floating is-empty">
                                    <label class="control-label"></label>
                                    <input id="card_number" class="form-control" type="text" name="required" required="true" aria-required="true" placeholder="000 000"  minlength="6" maxlength="6">
                                    <span class="material-input">Последние 6 цифр</span></div>
                                </div>
                                <label class="col-sm-2 label-on-right">
                                    <code>Последняя выгрузка: {{$last_import->created_at}}. Данные по балансу могут быть неактуальны</code>
                                </label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header card-header-icon" data-background-color="rose">
                                    <i class="material-icons">credit_card</i>
                                </div>
                                <h4 class="card-title">Данные по карте</h4>
                                <div class="card-content">
                                    <p>Баланс: <b id="current-balance"></b></p>
                                    <p>Состояние: <b id="current-state"></b></p>
                                    <p>Последняя операция по карте: <b id="current-last-operation"></b></p>
                                    <p>Данные о блокировке<b id="card-block-info"></b></p>
                                    <div id="block-action"></div>
                                    <div id="info-preloader">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header card-header-icon" data-background-color="rose">
                                    <i class="material-icons">assignment</i>
                                </div>
                                <h4 class="card-title">Пополнение (Сбербанк и НБД-банк)</h4>
                                <div class="card-content">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Номер карты</th>
                                                    <th>Транзакция</th>
                                                    <th>Терминал</th>
                                                    <th class="text-right">Сумма</th>
                                                    <th class="text-right">Дата</th>
                                                </tr>
                                            </thead>
                                            <tbody id="operations-results">

                                            </tbody>
                                            <h3 id="operations-results-none"></h3>
                                        </table>
                                    </div>
                                    <div id="refills-preloader"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="rose">
                            <i class="material-icons">directions_bus</i>
                        </div>
                        <h4 class="card-title">Поездки</h4>
                        <div class="card-content">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Дата</th>
                                            <th>Маршрут</th>
                                            <th class="text-right">Сумма</th>
                                            <th class="text-right">Остаток</th>
                                        </tr>
                                    </thead>
                                    <tbody id="trips-results">
                                    </tbody>
                                    <h3 id="trips-results-none">
                                    </h3>
                                </table>
                            </div>
                            <div id="trips-preloader"></div>
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
  var url = '{{ route('ajax.check_card_operations') }}';
</script>