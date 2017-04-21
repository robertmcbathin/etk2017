@section('title')
Операции по картам
@endsection
@extends('sudo.layouts.master')
@section('content')
<div class="main-panel">
    @include('sudo.includes.top-nav')
    <div class="content">
        <div class="container-fluid">
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
                            <div class="col-sm-7">
                                <div class="form-group label-floating is-empty">
                                    <label class="control-label"></label>
                                    <input id="card_number" class="form-control" type="text" name="required" required="true" aria-required="true" placeholder="000 000"  minlength="6">
                                    <span class="material-input">Последние 6 цифр</span></div>
                                </div>
                                <label class="col-sm-3 label-on-right">
                                    <code>Последняя выгрузка: {{$last_import->created_at}} ({{$human_date}})</code>
                                </label>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-icon" data-background-color="rose">
                                    <i class="material-icons">assignment</i>
                                </div>
                                <h4 class="card-title">Результат</h4>
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
                                        </table>
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
  var url = '{{ route('ajax.check_card_operations') }}';
</script>