@section('title')
Возмещение по пополнению
@endsection
@extends('sudo.layouts.master')
@section('content')
<div class="main-panel">
    @include('sudo.includes.top-nav')
    <div class="content">
        <div class="container-fluid">
<script>
  var token = '{{ Session::token() }}';
</script>
        @if (Session::has('success'))
        <div class="row">
          <div class="container">
            <div class="alert alert-success">
              <div class="container">
                <div class="alert-icon">
                  <i class="material-icons">check</i>
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true"><i class="material-icons">clear</i></span>
                </button>
                <strong>{{Session::pull('success')}}</strong>
              </div>
            </div>  
          </div>
        </div>
        @endif
        @if (Session::has('fail'))
        <div class="row">
          <div class="container">
            <div class="alert alert-danger">
              <div class="container">
                <div class="alert-icon">
                  <i class="material-icons">error_outline</i>
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true"><i class="material-icons">clear</i></span>
                </button>
                <strong>{{Session::pull('fail')}}</strong>
              </div>
            </div>  
          </div>
        </div>
        @endif
          <div class="row">
          @can('show-reports', App\User::class)
          <div class="col-md-12">
              <div class="card">
                                <div class="card-header card-header-icon" data-background-color="rose">
                                    <i class="material-icons">mail_outline</i>
                                </div>
                                <div class="card-content">
                                    <h4 class="card-title">Создать запрос на возмещение</h4>
                                    <form method="POST" action="{{ route('sudo.add-compensation.post') }}">
                                        <div class="form-group label-floating is-empty">
                                            <label class="control-label">Номер карты</label>
                                            <input type="text" name="card_number" placeholder="0123123456" minlength="10" maxlength="10" required class="form-control">
                                        <span class="material-input"></span></div>
                                        <div class="form-group label-floating is-empty">
                                            <label class="control-label">Сумма</label>
                                            <input type="text" name="value" class="form-control" required>
                                        <span class="material-input"></span></div>
                                        <div class="form-group label-floating is-empty">
                                            <label class="control-label">Комментарий</label>
                                            <input type="text" name="comment" class="form-control">
                                        <span class="material-input"></span></div>
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-fill btn-rose">Создать</button>
                                    </form>
                                </div>
                            </div>
          </div>
            @endcan
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="rose">
                        <i class="material-icons">credit_card</i>
                    </div>                
                    <h4 class="card-title">Возмещение по картам -
                        <small class="category">Введите номер карты</small>
                    </h4>
                    <div class="card-content">
                        <div class="row">
                            <label class="col-sm-2 label-on-left"></label>
                            <div class="col-sm-2">
                                <div class="form-group label-floating is-empty">
                                    <label class="control-label"></label>
                                    <input id="card_serie" class="form-control compensations-handler" type="text" name="required" required="true" aria-required="true" placeholder="00"  minlength="2" maxlength="2">
                                    <span class="material-input">Серия 2 цифры (по умолчанию 23)</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group label-floating is-empty">
                                    <label class="control-label"></label>
                                    <input id="card_number" class="form-control compensations-handler" type="text" name="required" required="true" aria-required="true" placeholder="000 000"  minlength="6" maxlength="6">
                                    <span class="material-input">Последние 6 цифр</span></div>
                                </div>
                                <label class="col-sm-2 label-on-right">
                                    <code>Последняя выгрузка: {{$last_import->created_at}}. Данные по балансу могут быть неактуальны</code>
                                </label>
                            </div>
                        </div>

                        <div class="col-md-12">
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
                                                    <th class="text-right">Возмещение</th>
                                                </tr>
                                            </thead>
                                            <tbody id="compensations-results">

                                            </tbody>
                                            <h3 id="compensations-results-none"></h3>
                                        </table>
                                    </div>
                                    <div id="refills-preloader"></div>
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
  var url = '{{ route('ajax.check_card_compensations') }}';
</script>