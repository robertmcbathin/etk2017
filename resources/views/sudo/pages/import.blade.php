@section('title')
Импорт файлов
@endsection
@extends('sudo.layouts.master')
@section('content')
<div class="main-panel">
  @include('sudo.includes.top-nav')
  <div class="content">
    <div class="container-fluid">
      <div class="col-md-12">
       @if (Session::has('import-trips-ok'))
      <div class="row">
       <div class="alert alert-success">
        <button type="button" aria-hidden="true" class="close">
          <i class="material-icons">close</i>
        </button>
        <span>
          {{Session::pull('import-trips-ok')}}</span>
        </div>
      </div>
      @endif
      @if (Session::has('import-trips-fail'))
      <div class="row">
       <div class="alert alert-danger">
        <button type="button" aria-hidden="true" class="close">
          <i class="material-icons">close</i>
        </button>
        <span>
          {{Session::pull('import-trips-fail')}}</span>
        </div>
      </div>
      @endif

      @if (Session::has('add-transactions-ok'))
      <div class="row">
       <div class="alert alert-success">
        <button type="button" aria-hidden="true" class="close">
          <i class="material-icons">close</i>
        </button>
        <span>
          {{Session::pull('add-transactions-ok')}}</span>
        </div>
      </div>
      @endif
      @if (Session::has('add-transactions-fail'))
      <div class="row">
       <div class="alert alert-danger">
        <button type="button" aria-hidden="true" class="close">
          <i class="material-icons">close</i>
        </button>
        <span>
          Что-то пошло не так...</span>
        </div>
      </div>
      @endif

      @if (Session::has('update-cards-ok'))
      <div class="row">
       <div class="alert alert-success">
        <button type="button" aria-hidden="true" class="close">
          <i class="material-icons">close</i>
        </button>
        <span>
          {{Session::pull('update-cards-ok')}}</span>
        </div>
      </div>
      @endif
      @if (Session::has('update-cards-fail'))
      <div class="row">
       <div class="alert alert-danger">
        <button type="button" aria-hidden="true" class="close">
          <i class="material-icons">close</i>
        </button>
        <span>
          {{Session::pull('update-cards-fail')}}</span>
        </div>
      </div>
      @endif
        <div class="row">
        <div class="col-md-12">
                    <div class="card">
            <div class="card-header card-header-icon" data-background-color="rose">
              <i class="material-icons">archive</i>
            </div>                
            <h4 class="card-title">Импорт выгрузок Сбербанка -
              <small class="category"> Последняя выгрузка: {{$last_import->created_at}} </small>
            </h4>
            <div class="card-content">
              <div class="row">
                <div class="col-sm-8">
                  <div class="table-responsive">
                    <table class="table table-shopping">
                      <thead>
                        <tr>
                          <th class="text-center">#</th>
                          <th class="text-left">Дата создания</th>
                          <th class="text-description">Количество транзакций</th>
                          <th class="text-center">Кем создано</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($sb_imports_list as $sb_import)
                        <tr>
                          <td>{{ $sb_import->id }}</td>
                          <td>{{ $sb_import->created_at }}</td>
                          <td>{{ $sb_import->transaction_count }}</td>
                          <td>{{ $sb_import->created_by }}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-sm-4">
                 <small class="category">Загрузить файл выгрузок Сбербанка(.csv) </small>
                 <form action="{{ route('sudo.import.sb-transactions.post')}}" method="POST" enctype="multipart/form-data">
                  <input type="file" name="sb-transaction">
                  {{csrf_field()}}
                  <button type="submit" class="btn btn-fill btn-rose">Обработать</button>
                </form>
                <small class="category">Загрузить файл выгрузок НБД-банка(.csv) </small>
                 <form action="{{ route('sudo.import.nbd-bank-transactions.post')}}" method="POST" enctype="multipart/form-data">
                  <input type="file" name="nbd-bank-transaction">
                  {{csrf_field()}}
                  <button type="submit" class="btn btn-fill btn-rose">Обработать</button>
                </form>
              </div>
            </div>

          </div>
        </div>
        </div>

      </div>

      <div class="row">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="rose">
            <i class="material-icons">credit_card</i>
          </div>                
          <h4 class="card-title">Обновление списка карт
            
          </h4>
          <div class="card-content">
            <div class="row">
              <div class="col-sm-8">
                <table class="table table-shopping">
                  <thead>
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-left">Дата создания</th>
                      <th class="text-description">Количество транзакций</th>
                      <th class="text-center">Кем создано</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($card_updates_list as $card_update)
                    <tr>
                      <td>{{ $card_update->id }}</td>
                      <td>{{ $card_update->created_at }}</td>
                      <td>{{ $card_update->transaction_count }}</td>
                      <td>{{ $card_update->created_by }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="col-sm-4">
              <small class="category">Загрузить файл обновленных карт (.csv) </small> 
                <form action="{{ route('sudo.update.cards.post')}}" method="POST" enctype="multipart/form-data">
                  <input type="file" name="update-cards">
                  {{csrf_field()}}
                  <button type="submit" class="btn btn-fill btn-rose">Обновить</button>
                </form>
              </div>
            </div>

          </div>
        </div>
      </div>

      <div class="row">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="rose">
            <i class="material-icons">directions_bus</i>
          </div>                
          <h4 class="card-title">Импорт файла поездок <small class="category"> Последняя транзакция: <b>{{ $last_trip_date }}</b> </small>
            
          </h4>
          <div class="card-content">
            <div class="row">
              <div class="col-sm-8">
               @if ($trip_imports_list)
                <table class="table table-shopping">
                  <thead>
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-left">Дата создания</th>
                      <th class="text-description">Количество транзакций</th>
                      <th class="text-center">Кем создано</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($trip_imports_list as $trip_import)
                    <tr>
                      <td>{{ $trip_import->id }}</td>
                      <td>{{ $trip_import->created_at }}</td>
                      <td>{{ $trip_import->transaction_count }}</td>
                      <td>{{ $trip_import->created_by }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                @else
                <p>Импортов не было</p>
                @endif
              </div>
              <div class="col-sm-4">
              <small class="category">Загрузить файл поездок (.csv) </small> 
                <form action="{{ route('sudo.import.trips.post')}}" method="POST" enctype="multipart/form-data">
                  <input type="file" name="new-trips">
                  {{csrf_field()}}
                  <button type="submit" class="btn btn-fill btn-rose">Загрузить</button>
                </form>
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