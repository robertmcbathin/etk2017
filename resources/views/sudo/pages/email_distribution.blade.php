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
        <div class="row">
                <div id="ed-info"></div>
              </div>
              <div class="row">
                <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-icon" data-background-color="rose">
                                    <i class="material-icons">assignment</i>
                                </div>
                                <div class="card-content">
                                    <h4 class="card-title">Рассылки</h4>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th>Название</th>
                                                    <th>Описание</th>
                                                    <th>Тест</th>
                                                    <th class="text-right">Статус</th>
                                                    <th class="text-right">Действие</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                              @foreach ($distributions as $distribution)
                                                <tr>
                                                  <td class="text-center">{{ $distribution->id }}</td>
                                                  <td>{{ $distribution->title }}</td>
                                                  <td>{{ $distribution->text }}</td>
                                                  <td>
                                                    @if ($distribution->test_status == 0)
                                                      Не начато <button class="btn btn-simple" id="{{ $distribution->action_id }}">Отправить</button>
                                                    @endif
                                                  </td>
                                                </tr>
                                              @endforeach
                                                <tr>
                                                    <td class="text-center">1</td>
                                                    <td>Andrew Mike</td>
                                                    <td>Develop</td>
                                                    <td>2013</td>
                                                    <td class="text-right">€ 99,225</td>
                                                    <td class="td-actions text-right">
                                                        <button type="button" rel="tooltip" class="btn btn-info" data-original-title="" title="">
                                                            <i class="material-icons">person</i>
                                                        </button>
                                                        <button type="button" rel="tooltip" class="btn btn-success" data-original-title="" title="">
                                                            <i class="material-icons">edit</i>
                                                        </button>
                                                        <button type="button" rel="tooltip" class="btn btn-danger" data-original-title="" title="">
                                                            <i class="material-icons">close</i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">2</td>
                                                    <td>John Doe</td>
                                                    <td>Design</td>
                                                    <td>2012</td>
                                                    <td class="text-right">€ 89,241</td>
                                                    <td class="td-actions text-right">
                                                        <button type="button" rel="tooltip" class="btn btn-info btn-round" data-original-title="" title="">
                                                            <i class="material-icons">person</i>
                                                        </button>
                                                        <button type="button" rel="tooltip" class="btn btn-success btn-round" data-original-title="" title="">
                                                            <i class="material-icons">edit</i>
                                                        </button>
                                                        <button type="button" rel="tooltip" class="btn btn-danger btn-round" data-original-title="" title="">
                                                            <i class="material-icons">close</i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">3</td>
                                                    <td>Alex Mike</td>
                                                    <td>Design</td>
                                                    <td>2010</td>
                                                    <td class="text-right">€ 92,144</td>
                                                    <td class="td-actions text-right">
                                                        <button type="button" rel="tooltip" class="btn btn-info btn-simple" data-original-title="" title="">
                                                            <i class="material-icons">person</i>
                                                        </button>
                                                        <button type="button" rel="tooltip" class="btn btn-success btn-simple" data-original-title="" title="">
                                                            <i class="material-icons">edit</i>
                                                        </button>
                                                        <button type="button" rel="tooltip" class="btn btn-danger btn-simple" data-original-title="" title="">
                                                            <i class="material-icons">close</i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">4</td>
                                                    <td>Mike Monday</td>
                                                    <td>Marketing</td>
                                                    <td>2013</td>
                                                    <td class="text-right">€ 49,990</td>
                                                    <td class="td-actions text-right">
                                                        <button type="button" rel="tooltip" class="btn btn-info btn-round" data-original-title="" title="">
                                                            <i class="material-icons">person</i>
                                                        </button>
                                                        <button type="button" rel="tooltip" class="btn btn-success btn-round" data-original-title="" title="">
                                                            <i class="material-icons">edit</i>
                                                        </button>
                                                        <button type="button" rel="tooltip" class="btn btn-danger btn-round" data-original-title="" title="">
                                                            <i class="material-icons">close</i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">5</td>
                                                    <td>Paul Dickens</td>
                                                    <td>Communication</td>
                                                    <td>2015</td>
                                                    <td class="text-right">€ 69,201</td>
                                                    <td class="td-actions text-right">
                                                        <button type="button" rel="tooltip" class="btn btn-info" data-original-title="" title="">
                                                            <i class="material-icons">person</i>
                                                        </button>
                                                        <button type="button" rel="tooltip" class="btn btn-success" data-original-title="" title="">
                                                            <i class="material-icons">edit</i>
                                                        </button>
                                                        <button type="button" rel="tooltip" class="btn btn-danger" data-original-title="" title="">
                                                            <i class="material-icons">close</i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
              </div>



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

              <div class="col-md-3">
                <div class="card card-stats">
                  <div class="card-header" data-background-color="orange">
                  <i class="material-icons">email</i>
                  </div>
                  <div class="card-content">
                    <p class="category">Запуск онлайн-пополнения на сайте</p>
                    <h3 class="card-title">{{ $lk_email_count }} адресов</h3>
                  </div>
                  <div class="card-footer">
                    <div class="stats">
                      <button class="btn btn-simple" id="ed-send-online-test">Тестовая отправка</button>
                    </div>
                    <div class="stats pull-right">
                      <a href="{{ route('sudo.pages.email-distribution.lk-start') }}">Отправить</a>
                    </div>
                  </div>
                </div>                

              </div>


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
  <script>
    var token = '{{ Session::token() }}';
    var receivers = JSON.stringify('{{ $receivers }}');
    String.receivers.replace('i','vvvvvvvvvvvvv');
    receivers.replace(/&quot;/g,'"');
    var sendEmailsOnlineUrl = '{{ route('sudo.pages.email-distribution.online-payment.test') }}';
  </script>
  @endsection
