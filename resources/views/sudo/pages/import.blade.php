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
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="rose">
                        <i class="material-icons">archive</i>
                    </div>                
                    <h4 class="card-title">Импорт выгрузок Сбербанка -
                        <small class="category">Загрузить файл выгрузок (.csv). Последняя выгрузка: {{$last_import->created_at}}</small>
                    </h4>
                    <div class="card-content">
                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3">
                              <form action="{{ route('sudo.import.transactions.post')}}" method="POST" enctype="multipart/form-data">
                                  <input type="file" name="sb-transaction">
                                  {{csrf_field()}}
                                  <button type="submit" class="btn btn-fill btn-rose">Обработать</button>
                              </form>
                            </div>
                        </div>

                    </div>
                </div>
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
                         <div class="alert alert-success">
                                        <button type="button" aria-hidden="true" class="close">
                                            <i class="material-icons">close</i>
                                        </button>
                                        <span>
                                            Что-то пошло не так...</span>
                                    </div>
                     </div>
         @endif
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