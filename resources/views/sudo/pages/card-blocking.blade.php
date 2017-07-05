@section('title')
Блокировка карт
@endsection
@extends('sudo.layouts.master')
@section('content')
<div class="main-panel">
    @include('sudo.includes.top-nav')
    <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
          @if (Session::has('item-removed-success'))
          <div class="row">
             <div class="alert alert-success">
                <button type="button" aria-hidden="true" class="close">
                  <i class="material-icons">close</i>
              </button>
              <span>
                  {{Session::pull('item-removed-success')}}</span>
              </div>
          </div>
          @endif
          @if (Session::has('item-removed-fail'))
          <div class="row">
             <div class="alert alert-danger">
                <button type="button" aria-hidden="true" class="close">
                  <i class="material-icons">close</i>
              </button>
              <span>
                  {{Session::pull('item-removed-fail')}}</span>
              </div>
          </div>
          @endif
         @if (Session::has('file-creation-success'))
          <div class="row">
             <div class="alert alert-success">
                <button type="button" aria-hidden="true" class="close">
                  <i class="material-icons">close</i>
              </button>
              <span>
                  {{Session::pull('file-creation-success')}}</span>
              </div>
          </div>
          @endif
          @if (Session::has('file-creation-fail'))
          <div class="row">
             <div class="alert alert-danger">
                <button type="button" aria-hidden="true" class="close">
                  <i class="material-icons">close</i>
              </button>
              <span>
                  {{Session::pull('file-creation-fail')}}</span>
              </div>
          </div>
          @endif
                    <div class="col-md-8">
                    <div class="col-md-12">
                                        <div class="card">
                    <div class="card-header card-header-icon" data-background-color="rose">
                        <i class="material-icons">assignment</i>
                    </div>
                    <h4 class="card-title">Список карт на блокировку (Офисы)</h4>
                    <div class="card-content">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Номер карты</th>
                                        <th>Чип</th>
                                        <th>Тип операции</th>
                                        <th class="text-right">Кем создано</th>
                                        <th class="text-right">Когда создано</th>
                                        <th class="text-right">Действие</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($today_office_blocklist as $office_blocklist)
                                    <tr>
                                        <td class="text-center">{{ $office_blocklist->id }}</td>
                                        <td>{{ $office_blocklist->card_number }}</td>
                                        <td>{{ $office_blocklist->chip }}</td>
                                        <td>{{ $office_blocklist->operation_type }}</td>
                                        <td class="text-right">{{ $office_blocklist->created_by }}</td>
                                        <td class="text-right">{{ $office_blocklist->created_at }}</td>
                                        <td class="td-actions text-right">
                                            <form action="{{ route('sudo.remove-from-blocklist.post') }}" method="POST">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="chip" value="{{ $office_blocklist->chip }}">
                                                 <button type="submit" rel="tooltip" class="btn btn-danger">
                                                <i class="material-icons">delete</i>
                                            </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <form action="{{ route('sudo.make-statuscard.post') }}" method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="source" value="1">
                            <button type="submit" class="btn btn-fill btn-rose">Сформировать список</button>
                        </form>
                    </div>
                </div>
                    </div>
                    <div class="col-md-12">
                                        <div class="card">
                    <div class="card-header card-header-icon" data-background-color="rose">
                        <i class="material-icons">assignment</i>
                    </div>
                    <h4 class="card-title">Список карт на блокировку (Личный кабинет)</h4>
                    <div class="card-content">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Номер карты</th>
                                        <th>Чип</th>
                                        <th>Тип операции</th>
                                        <th class="text-right">Кем создано</th>
                                        <th class="text-right">Когда создано</th>
                                        <th class="text-right">Действие</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($today_profile_blocklist as $profile_blocklist)
                                    <tr>
                                        <td class="text-center">{{ $office_blocklist->id }}</td>
                                        <td>{{ $profile_blocklist->card_number }}</td>
                                        <td>{{ $profile_blocklist->chip }}</td>
                                        <td>{{ $profile_blocklist->operation_type }}</td>
                                        <td class="text-right">{{ $profile_blocklist->created_by }}</td>
                                        <td class="text-right">{{ $profile_blocklist->created_at }}</td>
                                        <td class="td-actions text-right">
                                            <form action="{{ route('sudo.remove-from-blocklist.post') }}" method="POST">
                                                {{ csrf_field() }}
                                                 <button type="submit" rel="tooltip" class="btn btn-danger" data-original-title="" title="">
                                                <i class="material-icons">delete</i>
                                            </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <form action="">
                            <button type="submit" class="btn btn-fill btn-rose">Сформировать список</button>
                        </form>
                    </div>
                </div>
                    </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="rose">
                        <i class="material-icons">assignment</i>
                    </div>
                    <h4 class="card-title">История создания файлов</h4>
                    <div class="card-content">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Дата</th>
                                        <th>Файл</th>
                                        <th>Количество записей</th>
                                        <th class="text-right">Кем создано</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($statuscard_lists as $statuscard_list)
                                    <tr>
                                        <td class="text-center">{{ $statuscard_list->id }}</td>
                                        <td>{{ $statuscard_list->created_at }}</td>
                                        <td><a href="{{ $statuscard_list->filename}}" download><i class="material-icons">description</i></a></td>
                                        <td>{{ $statuscard_list->status_count }}</td>
                                        <td class="text-right">{{ $statuscard_list->name }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
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